<?php
include 'database.php';
function alertMessage($msg){
        $Output='<div class="alert alert-danger">';
        $Output.=$msg;
        $Output.="</div>";
        echo $Output;

}

function logOut(){
    session_start();
    session_unset();
    session_destroy();
    header('Location: index.php');
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

//Categories records from database are extracted into dropdown
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


// ////////////// Next Functions Are in Progresss ///////////////////////// //
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





