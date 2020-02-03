<?php session_start();
include('includes/functions.php');
// Check if user is logged in - check usertype against database! 
//if (!isLoggedIn()) {
//    alertBackToMainPage();}?>
    <?php include("header.php");?>
    <?php include("troubleshootingbar.php");?>
    

   <!--- Top Navigation Bar -->

    <?php  //Create a navbar with buttons for admin action categories -- Posts, Users, 

?>
    
    
	<!--- Dashboard -->
    <div class="row" >
            <div class="col col-lg-7 offset-lg-2 col-md-10 offset-md-1 col-sm-12 col-xs-12" style="margin-top:30px;" id="content">
            

                <div class="card" id="dashcontent" ><!--- Dashboard content-->
                   <div class="card-header bg-dark text-light"> <!--- Card header -->
                       
                       
                     <!--- Dashboard Title-->

                  
    <?php  $websiteURL = "http://" . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];                      ?>      

    <?php include('adminbar.php');?>
                  
                  
                  
                   </div> <!--- End card header -->
    <div class="row" style="margin-top: 15px">
        <div class="col-md-12">
          <div class="card">
               <form name="newsTable" method="POST" action="allusers.php">
            <div class="card-header">
                 <div class="row">
                    <div class="col col-lg-10 col-md-8 col-sm-8">
                          <h4>All users</h4>
                    </div>
                    <div class="col col-lg-2 col-md-4 col-sm-4 ">
                      <a href="allusers.php?createuser" class="btn btn-primary text-light btn-block" name="createuser">
                        <i class="fas fa-plus"></i> Create new user
                      </a>
                    </div>
                 </div>
            </div>
            <div class="card-body">
             <div class="table-responsive">
             
            <table class="table table-striped table-hover">
                
            
            <?php 
                    if(isset($_GET['createuser'])){
                        echo '<div class="alert alert-success" role="alert"> User privileges changed to admin.</div>
                        <button class="btn btn-dark"  onclick="history.go(-1);">Finish</button>';
                        exit();
                    }
                    if(isset($_GET['setadmin'])){
                        include 'database.php';
                        $postfromurl = $_GET['setadmin'];
                        $setsql = "UPDATE userdetails SET userType = 'admin' WHERE userID = '$postfromurl'";
                        $result2 = mysqli_query($conn, $setsql);
                        mysqli_close($conn);
                        //Check if result successful
                        echo '<div class="alert alert-success" role="alert"> User privileges changed to admin.</div>
                        <button class="btn btn-dark"  onclick="history.go(-1);">Finish</button>';
                        exit(); }
                    if(isset($_GET['removeadmin'])){
                        $postfromurl2 = $_GET['removeadmin'];
                      include 'database.php';
                      $unsetsql = "UPDATE userdetails SET userType = 'normal' WHERE userID = '$postfromurl2'";
                      $result3 = mysqli_query($conn, $unsetsql);
                      
                      echo '<div class="alert alert-success" role="alert"> Admin privileges removed.</div><button class="btn btn-dark" onclick="history.go(-1);">Finish</button>';
                      mysqli_close($conn);
                      exit();
                      }
                    if(isset($_GET['deleteuser'])){
                        $postfromurl3 = $_GET['deleteuser'];
                        $deletesql = "DELETE FROM userdetails WHERE userID = '$postfromurl3'";
                        include 'database.php';
                        $delete = mysqli_query($conn, $deletesql);
                        echo '<div class="alert alert-success" role="alert"> User successfully deleted.</div><button class="btn btn-dark" onclick="history.go(-1);">Finish</button>';
                      mysqli_close($conn);
                      exit();
                        
                    }
                ?>
            
            
            <!-- Retrieve all posts from logged user-->
           <?php 
            include 'database.php';
            $email = $_SESSION["userEmail"];
            //After setting the limit of retrieved posts to 5, user must choose page or result from 6 to 10
            $sql = "SELECT * FROM userdetails LIMIT 15"; 
            $result = mysqli_query($conn, $sql);
            $rescheck = mysqli_num_rows($result);   
            
            if ($rescheck == 0){
                $alert = "There are no active posts.";
                alertMessage($alert);
                mysqli_close($conn);
        //if there is at least one result from db, show below.
             } else {            ?> 
               <tr>
                     <th>Name</th>
                     <th>Email</th>
                    
                     <th>Postal code</th>
                     <th>Telephone</th>
                     <th>Department</th>
                     <th>User type</th>
                    <th></th><th></th>
                </tr>
                 
                 
             <?php  while($row = mysqli_fetch_assoc($result)){
                    $userId =  $row['userID'];
                    $name = $row['fullName'];
                    $email =  $row['email'];
                    $homeaddress =  $row['homeAddress'];
                    $postcode =  $row['postCode'];
                    $telephone =  $row['telephone'];
                    $department =  $row['department'];
                    $usertype =  $row['userType'];
                    //Remove html code from echo, set a max of char for each ?> 
                  <tr>
                     <td><?php echo $name;?></td>
                     <td><?php echo $email;?></td>
                     <td><?php echo $postcode;?></td>
                     <td><?php echo $telephone;?></td>
                     <td><?php echo $department;?></td>
                     <td><?php echo $usertype;?></td>
                     <?php  
                  if(strpos($usertype, 'admin') !== false ){ 
                      
                        ?> <td><a href="allusers.php?removeadmin=<?php echo $userId;?>" class="btn btn-warning btn-block" name="removeadmin"><?php echo "Remove admin";?></a></td>   <?php 

                        ?> <?php   
               
                   } elseif(strpos($usertype, 'normal') !== false){
                      include 'database.php';
                      ?> <td><a href="allusers.php?setadmin=<?php echo $userId;?>" class="btn btn-success btn-block" name="setadmin" ><?php echo "Make admin";?></a>  
                     </td>
                       <?php
                    } else {
                      
                      }
                      
                      ?>
                     
                     
                     <td><a href="allusers.php?deleteuser=<?php echo $userId;?>" class="btn btn-danger btn-block" name="deleteuser" ><?php echo "Delete User";?></a></td>
                     
                 </tr> <?php
                    
                }
            } 
                    
               ?> 
                
             </table>
             
             </div>
            </div>
            </form>
        </div> <!-- Edit profile Card End -->
        <br>
        </div> <!-- Column end -->
       

    </div>
                </div> <!--- End dashboard content card-->
            </div> 

    <?php //include("sidebar.php");?>

    </div>

	
	<div style="margin-top:200px;"></div>

<?php include("footer.php");?>

   
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T"
        crossorigin="anonymous"></script>
       

  
  <script>
    var dropdown = document.getElementsByClassName("dropdown-btn");
      var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var dropdownContent = this.nextElementSibling;
    if (dropdownContent.style.display === "block") {
      dropdownContent.style.display = "none";
    } else {
      dropdownContent.style.display = "block";
    }
  });
}</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>



    

    
    
    <?php   ?>
    
</body>

</html>






