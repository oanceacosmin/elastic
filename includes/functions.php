<?php
include 'database.php';
function alertMessage($msg){
        $Output='<div class="alert alert-danger">';
        $Output.=$msg;
        $Output.="</div>";
        echo $Output;

}

function alertBackToMainPage(){
        echo "<script type='text/javascript'>alert('Please log in first.'); window.location.href = 'index.php';</script>";
         
}

function successMessage($msg){
        $Output='<div class="alert alert-success">';
        $Output.= $msg;
        $Output.="</div>";
        echo $Output;
    }

//Function for getting curent time
function getCurrentTime(){
    //Set timezone
   date_default_timezone_set("Europe/London");
   return date('H:i d.m.Y');
}

function createNewsPost($postAuthor, $postTitle, $postDate, $postType, $postDesc, $postContent){
    
        //SQL query
    $query = "INSERT INTO newspost (postAuthor, postTitle, postDate, postType, postDesc, postContent) VALUES ('$postAuthor', '$postTitle', '$postDate', '$postType', '$postDesc', '$postContent')";
    
    mysqli_query($conn, $query);
    mysqli_close($conn);
}


//Log in Function
function logging(){
    //Open Database Connection
    include 'database.php';
    //Store in variables user input from text boxes
    $username = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    //Check if fields are empty and display alert if true
    if(empty($username) || empty($password)){
        $_SESSION["ErrorMessage"]="All fields must be filled out";
        //close database connection
        mysqli_close($conn);
        exit();
    }else{
        //Create variable with SQL query according to user input
        $sql = "SELECT * FROM userdetails WHERE email='$username'";
        //execute query on connection using query above
        $result = mysqli_query($conn, $sql);
        //store number of rows
        $rescheck = mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);
        //check if there are no results
        if ($rescheck == 0){
            $alert = "Email not found.";
            alertMessage($alert);
            mysqli_close($conn);
        //if there is one result, execute code between curly brackets
        } elseif ($rescheck == 1){
           $dbPass = $row['password'];
            if ($password == $dbPass) {
         //Retrieve and store all information from database to current session
                    $_SESSION['userID'] = $row['userID'];
                    $_SESSION['userEmail'] = $row['email'];
                    $_SESSION['fullName'] = $row['fullName'];
                    $_SESSION['homeAddress'] = $row['homeAddress'];
                    $_SESSION['postCode'] = $row['postCode'];
                    $_SESSION['telephone'] = $row['telephone'];
                    $_SESSION['userType'] = $row['userType'];
                    $_SESSION['department'] = $row['department'];
                    $_SESSION['useravatar'] = $row['avatar'];
                    header("Location: dashboard.php");
                    mysqli_close($conn);
                } 
            // If password is wrong, alert will be shown
            elseif(!password_verify($password, $dbPass)){
                $alert = "Incorrect Password!!";
                alertMessage($alert);
                mysqli_close($conn);
            } else{
                header("Location: index.php?passworderror");
                mysqli_close($conn);
            }}
    
            else{
                header("Location: index.php?SQLerror");
                mysqli_close($conn);
            }}}



//Function for checking if user is logged in or not
function isLoggedIn()
{
	if (isset($_SESSION['userID'])) {
		return true;
	}else{
		return false;
	}
}


function getAllNews(){
    //establish connection with database
    include 'database.php';
    //create user query
    
    
}

function getLatestNews(){
    
}





function getSelectCategories(){
                include 'database.php';
                $query = "SELECT * FROM newsCat ORDER BY newsCat asc";
                $result = mysqli_query($conn, $query);
                if(!$result){
                    
                    $msg = "No Result";
                        alertMessage();}
                while($row=mysqli_fetch_assoc($result)){
                    $categoryName=$row["newsCat"]; 
                    $Output = '<option value="'.$categoryName.'">';
                    $Output.= $categoryName;
                    $Output.= '</option>';
                    echo $Output;}
                    mysqli_close($conn);
}






//Function for showing all attractions in dropdown select options
function showAllAttractions(){
    //Database Connection
    global $conn;
    //Store query
    $query = "SELECT * FROM attractionss";
    //Execute Query
    $result = mysqli_query($conn, $query);
    if(!$result){
        die('Query FAILED' . mysqli_error());}
    //
    while($row = mysqli_fetch_assoc($result)){
        $attID = $row['attractionID'];
        $attName = $row['attractionName'];
        echo "<option value = '$attID'>$attName</option>";}}



//Function for extracting available times from database table
function showAllTimes(){
   include 'database.php';
    $query = "SELECT * FROM availabletimes";
    $result = mysqli_query($conn, $query);
    if(!$result){
        die('Query FAILED' . mysqli_error());}
    while($row = mysqli_fetch_assoc($result)){
        $time = $row['times'];
        echo "<option value = '$time'>$time</option>";
    }}



function showCurrentUserDetails(){
    include 'database.php';
    $userID = $_SESSION['userID'];
    $query = "SELECT * FROM userdetails WHERE userID='$userID'";
    $result = mysqli_query($conn, $query);
    if(!$result){
        die('Query FAILED' . mysqli_error());
     mysqli_close($conn);}
    while($row = mysqli_fetch_assoc($result)){
       // $date = date_create($row['bookingDate']);
                echo '<tr><td>'.$row["userID"].'</td>                              <td>'.$row["username"].'</td> 
                  <td>'.$row['firstName'].' '.$row['lastName'].'</td> 
                  <td>'.$row['homeAddress'].', '.$row['homeCity'].', '.$row['postCode'].'</td> 
                  <td>'.$row['emailAddress'].'</td><td>'.$row['telephoneNumber'].'</td> 
                  <td>'.$row['userType'].'</td> 
                  <td><button type="submit" name="updateDetails" id="form1" value="'.$userID.'">Update Account</button></td>
              </tr>';
    
    }
     mysqli_close($conn);
}



function updateBookingDate($date, $ticketID){
     include 'database.php';
    $sql = "UPDATE ticketbookings SET Date='$date' WHERE ticketID='$ticketID'";
                $result = mysqli_query($conn, $sql);
                if($result){
                    echo '<p>New Booking Date: '.$date.' </p>';
                }elseif(!$result){
                    echo '<p>Unsuccessful </p>';
                }
    mysqli_close($conn);
    
}



function updateBookingsNumber($tickets, $ticketID){
    include 'database.php';
    $sql = "UPDATE ticketbookings SET numberOfTickets='$tickets' WHERE ticketID='$ticketID'";
    $result = mysqli_query($conn, $sql);
    if($result){
        echo '<p>New Booking Date: '.$date.' </p>';
    }elseif(!$result){
        echo '<p>Unsuccessful </p>';}
    mysqli_close($conn);
    
}


function updateHomeAddress($newAddress, $userID){
    include 'database.php';
    $query = "UPDATE userdetails SET homeAddress='$newAddress' WHERE userID='$userID'";
    $result = mysqli_query($conn, $query);
    if(!$result){
        echo '<p>Unsuccessfull change to: </p>';
        echo $newAddress;
        echo $userID;
        mysqli_close($conn);
    } else {
         echo '<p>Successfully changed home address to: '.$newAddress.' </p>';
        $_SESSION['homeAddress'] = $newAddress;
        mysqli_close($conn);
    }}


function updateHomeCity($newCity, $userID){
     include 'database.php';
    $query = "UPDATE userdetails SET homeCity='$newCity' WHERE userID='$userID'";
    $result = mysqli_query($conn, $query);
    if(!$result){
        echo '<p>Unsuccessfull change to: </p>';
        echo $newCity;
        echo $userID;
        mysqli_close($conn);
    } else {
         echo '<p>Successfully changed home city to: '.$newCity.' </p>';
        $_SESSION['homeCity'] = $newCity;
        mysqli_close($conn);
    } 
}


//
function updatePostCode($newPostCode, $userID){
     include 'database.php';
    $query = "UPDATE userdetails SET postCode='$newPostCode' WHERE userID='$userID'";
    $result = mysqli_query($conn, $query);
    if(!$result){
        echo '<p>Unsuccessfull change to: </p>';
        echo $newPostCode;
        mysqli_close($conn);
    } else {
         echo '<p>Successfully changed postcode to: '.$newPostCode.' </p>';
        $_SESSION['postCode'] = $newPostCode;
        mysqli_close($conn);
    } 
}


//
function updateTelephone($newTelephone, $userID){
     include 'database.php';
    $query = "UPDATE userdetails SET telephoneNumber ='$newTelephone' WHERE userID='$userID'";
    $result = mysqli_query($conn, $query);
    if(!$result){
        echo '<p>Unsuccessfull changed to: </p>';
        echo $newTelephone;
        mysqli_close($conn);
    } else {
         echo '<p>Successfully changed telephone number to: '.$newTelephone.' </p>';
        $_SESSION['tel'] = $newTelephone;
        mysqli_close($conn);
    } 
}

function connectDB(){
$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "websecurity";


$conn= mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName) or die($conn);
}


//ADMIN - For checking create booking input and execute if correct
function checkCreateBooking($tickets, $chosenUser, $chosenDate, $chosenAttraction){
    include 'database.php';
   //check in database for typed user email
    $query = "SELECT emailAddress FROM userdetails WHERE emailAddress ='$chosenUser'";
    $result = mysqli_query($conn, $query);
    $resultCheck = mysqli_num_rows($result);
    //if there are results, insert new bookingg
    if($resultCheck != 0){
    $query2 = "INSERT INTO ticketbookings (emailAddress, attractionID, Date, numberOfTickets) VALUES ('$chosenUser', '$chosenAttraction', '$chosenDate', '$tickets')";
    $result = mysqli_query($conn, $query2);
    echo "Booked '$tickets' for '$chosenUser' on '$chosenDate' <br> Completed!!";
    mysqli_close($conn);
        exit();
    //if no results email address not found error
    }elseif($resultCheck == 0){
        $msg = "Email address not found";             
        echo "<script type='text/javascript'>alert('$msg')</script>";
        createAdminBookingsForm();
        mysqli_close($conn);
        exit();
    //if other error
    }else{
        $msg = "Unknown error!";             
        echo "<script type='text/javascript'>alert('$msg')</script>";
        createAdminBookingsForm();
        mysqli_close($conn);
        exit();
    }}
    


//
function verifyUser($user){
    $query = "SELECT * FROM userdetails WHERE email='$user'";
    $result = mysqli_query($conn, $query);
}

function insertUserBookingIntoDB(){
    include 'database.php';
    global $chosenUser;
    global $chosenDate;
    global $chosenAttraction;
    global $tickets;
        //SQL query
        $query = "INSERT INTO ticketbookings (emailAddress, attractionID, Date, numberOfTickets) VALUES ('$chosenUser', '$chosenAttraction', '$chosenDate', '$tickets')";
        mysqli_query($conn, $query);
        echo "Booked ". $tickets . " on date ". $chosenDate ." for user: ". $chosenUser;
        echo "<br>";
        echo "Booking Completed!!";
        mysqli_close($conn);
}
    


//ADMIN - Function for showing all users 
function showAllUsers(){
    include 'database.php';
    //set query
    $query = "SELECT * FROM userdetails";
    //execute query
    $result = mysqli_query($conn, $query);
    //check if any result
    if(!$result){
        die('Query FAILED: ' . mysqli_error());
        exit();}
    echo '<h1>All Users</h1><tr><th><h1>User ID</h1></th><th><h1>Username</h1></th><th>Full Name</th>
                <th>Full Address</th><th><h1>Email</h1></th><th><h1>Telephone</h1></th>
               <th><h1>User Type</h1></th><th><h1>Action</h1></th></tr>';
    //store each result in associative array
    while($row = mysqli_fetch_assoc($result)){
                    echo '<tr> 
                  <td>'.$row["userID"].'</td><td>'.$row["username"].'</td> 
                  <td>'.$row['firstName'].' '.$row['lastName'].'</td> 
                  <td>'.$row['homeAddress'].', '.$row['homeCity'].', '.$row['postCode'].'</td> 
                  <td>'.$row['emailAddress'].'</td><td>'.$row['telephoneNumber'].'</td> 
                  <td>'.$row['userType'].'</td> 
                  <td><button type="submit" name="deleteAcc" value="'.$row["userID"].'">Delete Account</button></td>
              </tr>';
              }
    echo '<tr><th><h1>User ID</h1></th><th><h1>Username</h1></th><th>Full Name</th>
    <th>Full Address</th><th><h1>Email</h1></th>
    <th><h1>Telephone</h1></th><th><h1>User Type</h1></th><th><h1>Action</h1></th></tr>';
        //close database connection
    mysqli_close($conn);}



//ADMIN - Function for displaying all ticket bookings
function displayAllTickets(){
   include 'database.php';
    //SQL statement to retrieve all details from ticket bookings table, userdetails and attractions table
     $sql = "SELECT * FROM ticketbookings tb INNER JOIN userdetails ud ON ud.emailAddress = tb.emailAddress INNER JOIN attractionss at ON tb.attractionID = at.attractionID ORDER BY Date ASC";
    //Execute query on connection
    $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0){
            echo '<h1>Current Bookings</h1><tr><th><h1>Booking ID</h1></th>
                <th><h1>Attraction Name</h1></th><th>Username</th>
                <th>Date/Time</th><th><h1>Location</h1></th>
               <th><h1>Number of Tickets</h1></th><th><h1>Action</h1></th></tr>';
            //Retrieve each result and display
            while ($row = mysqli_fetch_assoc($result)) {
                $date = date_create($row['Date']);
                $id = $row["ticketID"];
                echo '<tr><td>'.$id.'</td><td>'.$row["attractionName"].'</td> 
                  <td>'.$row['username'].'</td> <td>'.date_format($date, 'd-m-Y H:i').'</td> 
                  <td>'.$row['locationN'].'</td> <td>'.$row['numberOfTickets'].'</td> 
                  <td><button type="submit" name="updateBooking" value="'.$id.'">Update</button>
                  <button type="submit" name="deleteBooking" value="'.$id.'">Delete</button></td></tr>';}
                 echo '<tr><th><h1>Booking ID</h1></th><th><h1>Attraction Name</h1></th><th>Username</th>
                <th>Date/Time</th><th><h1>Location</h1></th><th><h1>Number of Tickets</h1></th><th><h1>Action</h1></th></tr>';
            } else {
                echo "<p>No Results</p>";
            mysqli_close($conn);
            } 
    mysqli_close($conn);
}


//USER - Display all current bookings
function displayTickets(){
     include 'database.php';
    //set query
     $sql = "SELECT * FROM ticketbookings tb INNER JOIN userdetails ud ON ud.emailAddress = tb.emailAddress INNER JOIN attractionss at ON tb.attractionID = at.attractionID WHERE tb.emailAddress='".$_SESSION['email']."'";
    //execute query
     $result = mysqli_query($conn, $sql);
    //check numbers of rows retrieved
     if (mysqli_num_rows($result) > 0){
            echo '<h1>Current Bookings</h1><tr>
                <th><h1>Booking ID</h1></th>
                <th><h1>Attraction Name</h1></th>
                <th>Number of Tickets</th>
                <th>Date and Time</th>
                <th><h1>Location</h1></th>
               <th><h1>Action</h1></th></tr>';
            //retrieve results in associative array
            while ($row = mysqli_fetch_assoc($result)) {
            $date = date_create($row['Date']);
                    echo '<tr> 
                  <td>'.$row["ticketID"].'</td> 
                  <td>'.$row["attractionName"].'</td> 
                  <td>'.$row['numberOfTickets'].'</td> 
                  <td>'.date_format ($date, 'd-m-Y H:i').'</td> 
                  <td>'.$row['locationN'].'</td> 
                  <td><button type="submit" name="updateBooking" value='.$row['ticketID'].'>Update</button></td> 
              </tr>';
                $ticketIDD = $row['ticketID'];}  
            echo '<tr><th><h1>Booking ID</h1></th>
                <th><h1>Attraction Name</h1></th>
                <th>Number of Tickets</th>
                <th>Date and Time</th>
                <th><h1>Location</h1></th>
               <th><h1>Action</h1></th></tr>';
                //close database connection
                mysqli_close($conn);
     } else {echo "<tr>No Results</tr>";}}



//ADMIN - Delete booking function
function deleteBooking($bookingID){
    include 'database.php';
    $sql = "DELETE FROM ticketbookings where ticketID =".$bookingID;
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    echo "<p>Booking Deleted Successfully.</p>";
}



//ADMIN - Update booking function --------- !!!!!!!!!!!!!!!
function updateBooking($bookingID){
    include 'database.php';
   $userID = $_SESSION['userID'];
                
                $sql = "SELECT * FROM ticketbookings tb INNER JOIN attractionss at ON tb.attractionID = at.attractionID WHERE tb.ticketID='".mysqli_real_escape_string($conn, $bookingID)."'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $today = date('Y-m-d');
                echo '<h1>Update Booking</h1>
                <form name="bookingUpdate" id="form1" method="POST"><table id="table1"><tr><th>Booking ID</th><th>Attraction Name</th><th>Choose Adults</th><th>Choose Kids</th><th>Choose New Date</th><th>Choose New Time</th><th></th></tr>';
                $dbDate = $row['Date'];
                $ticketID = $row['ticketID'];
                $attractionName = $row['attractionName'];
                $time = $row['ticketID'];
                echo '<tr><th><p>'.$ticketID.'</p></th><th>'.$attractionName.'</th><th>';
                echo '<select name="numberOfAdultTickets" id="openinghours">';
                echo '<option value="">Select Number of Adults</option>';
                echo '<option value="1">1 Adult</option><option value="2">2 Adults</option><option value="3">3 Adults</option><option value="4">4 Adults</option><option value="5">5 Adults</option><option value="6">6 Adults</option><option value="7">7 Adults</option><option value="8">8 Adults</option>';
                echo '</select></th><th><select name="numberOfKidsTickets" id="openinghours"><option value="">Select number of Kids</option>';
                echo '<option value="1">1 Kid</option><option value="2">2 Kids</option><option value="3">3 Kids</option><option value="4">4 Kids</option><option value="5">5 Kids</option><option value="6">6 Kids</option><option value="7">7 Kids</option><option value="8">8 Kids</option>';
                echo '</select></th>
                <th><input type="date" name="currentDate"  id="openinghours" value='.$dbDate.' min="'.$today.'"></th>
                <th><select name="times" id="openinghours"><option value="">Select Time</option>';
                showAllTimes();
                echo '</select></th><th><button type="submit" name="updateBook" value="'.$ticketID.'">Update Booking</button></th></tr></table></form>';
            }



function deleteUser($userID){
    include 'database.php';
    //Retrieve email address from user id seelected
    $sql = "SELECT emailAddress, userType FROM userdetails WHERE userID ='".$userID."'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $userEmail = $row['emailAddress'];
    $userType = $row['userType'];
    //If usertype is admin, show message and exit without deleting anything
    if($userType == "Admin"){
        echo "<p>Account with privileges, cannot be deleted!!</p>";
        mysqli_close($conn);
        exit();
    }
    //Select ticket bookings with user email
    $sql2 = "SELECT ticketID FROM ticketbookings WHERE emailAddress ='".$userEmail."'";
    $result2 = mysqli_query($conn, $sql2);
    //If any bookings were found, delete bookings and delete account
    if (mysqli_num_rows($result2) > 0){
        $sql2 = "DELETE FROM ticketbookings WHERE emailAddress='".$userEmail."'";
        $result2 = mysqli_query($conn, $sql2);
        $sql3 = "DELETE FROM userdetails where userID='".$userID."'";
        $result3 = mysqli_query($conn, $sql3);
        mysqli_close($conn);
        echo "<p>Account Deleted Successfully and all bookings removed.</p>";
        exit();
    //If no bookings were found, delete account
    } elseif (mysqli_num_rows($result) == 0){
        $sql4 = "DELETE FROM userdetails WHERE userID='".$userID."'";
        $result4 = mysqli_query($conn, $sql4);
        echo "<p>Account Deleted Successfully and no records were found!!</p>";
        mysqli_close($conn);
        exit();
    } else{
        echo "<p>Error!!</p>";
        mysqli_close($conn);
        exit();
    }
}





function showUsersInSelect(){
    global $conn;
    $query = "SELECT * FROM userdetails";
    $result = mysqli_query($conn, $query);
    if(!$result){
        die('Query FAILED' . mysqli_error());}
    while($row = mysqli_fetch_assoc($result)){
        $userID = $row['emailAddress'];
        echo "<option value = '$userID'>$userID</option>";}
}

//Function for showing all user id's in select - NOT USED
function showAllData(){
    global $conn;
    //Store query in variable
    $query = "SELECT * FROM userdetails";
    //Execute query
    $result = mysqli_query($conn, $query);
    //Store number of retrieved rows
    $resCheck = mysqli_num_rows($result);
    //
    if(!$result){
        die('Query FAILED' . mysqli_error());}
    //Go through each row and store the result in associative array
    while($row = mysqli_fetch_assoc($result)){
        $id = $row['userID'];
        echo "<option value = '$id'>$id</option>";}}

function openWin() {
  header("http://localhost/phpWebsite/registerPage.php");  
    
}
function alertBox() {
    $msg = "Unavailable";
    echo "<script type='text/javascript'>alert('Unavailable');</script>";
    exit();
}function emptyLogIn() {
    $msg = "Please type your credentials!!";
    echo "<script type='text/javascript'>alert('$msg');</script>";
}
function wrongUser() {
    $msg = "You are not authorised on this page!! Please Log In First!!";
    echo "<script type='text/javascript'>alert('$msg');</script>";
        
}





function logOut(){
    session_start();
    session_unset();
    session_destroy();
    header('Location: index.php');
}


/*function showUserType(){
    //change to get user type from database
    global $conn;
    $query = "SELECT * FROM userdetails";
    $result = mysqli_query($conn, $query);
    if(!$result){
        die('Query FAILED' . mysqli_error());}
    
    else{
        while($row = mysqli_fetch_assoc($result)){
        $id = $row['userType'];
        echo "<option value = '$id'>$id</option>";}}}
*/
