<?php session_start();
include('includes/functions.php');
// Check if user is logged in - check usertype against database! 
if (!isLoggedIn()) {
    alertBackToMainPage();}?>
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
            <div class="card-header">
              <h4>News Posts</h4>
            </div>
            <div class="card-body">
             <div class="table-responsive">
             
            <table class="table table-striped table-hover">
            <form name="newsTable" method="POST" action="adminDashboard.php">
            
            <?php
                    if(isset($_GET['approve'])){
                        include 'database.php';
                        $postfromurl = $_GET['approve'];
                        $approvesql = "UPDATE newsposts SET approved = 'Yes' WHERE postID = '$postfromurl'";
                        $result2 = mysqli_query($conn, $approvesql);
                        mysqli_close($conn);
                        //Check if result successful
                        echo '<div class="alert alert-success" role="alert"> Post approved.</div>
                        <button class="btn btn-dark"  onclick="history.go(-1);">Finish</button>';
                        exit(); }
                      if(isset($_GET['unapprove'])){
                        $postfromurl2 = $_GET['unapprove'];
                      include 'database.php';
                      $unapprovesql = "UPDATE newsposts SET approved = 'No' WHERE postID = '$postfromurl2'";
                      $result3 = mysqli_query($conn, $unapprovesql);
                      mysqli_close($conn);
                      echo '<div class="alert alert-warning" role="alert"> Post unapproved.</div><button class="btn btn-dark" onclick="history.go(-1);">Finish</button>';
                      exit();
                      }                
                ?>
            
            
            <!-- Retrieve all posts from logged user-->
           <?php 
            include 'database.php';
            $email = $_SESSION["userEmail"];
            //After setting the limit of retrieved posts to 5, user must choose page or result from 6 to 10
            $sql = "SELECT * FROM newsposts ORDER BY postDate DESC LIMIT 15"; 
            $result = mysqli_query($conn, $sql);
            $rescheck = mysqli_num_rows($result);    
            
            if ($rescheck == 0){
                $alert = "There are no active posts.";
                alertMessage($alert);
                mysqli_close($conn);
        //if there is at least one result from db, show below.
             } else {            ?> 
               <tr>
                     <th>Author</th>
                     <th>Date</th>
                     <th>Category</th>
                     <th>Post Title</th>
                     <th></th>
                     <th></th>
                     <th></th>
                 </tr>  
                 
                 
             <?php  while($row = mysqli_fetch_assoc($result)){
                    $postId =  $row['postID'];
                    $approved = $row['approved'];
                    $name =  $row['postEmail'];
                    $date =  $row['postDate'];
                    $cat =  $row['postCat'];
                    $title =  $row['postTitle'];
                    //Remove html code from echo, set a max of char for each ?> 
                  <tr>
                     <td><?php echo $name;?></td>
                     <td><?php echo $date;?></td>
                     <td><?php echo $cat;?></td>
                     <td><?php echo $title;?></td>
                     <?php  
                  if(strpos($approved, 'No') !== false or $approved == null){ 
                      
                        ?> <td><a href="adminDashboard.php?approve=<?php echo $postId;?>" class="btn btn-warning btn-block" name="approve"><?php echo "Approve";?></a></td>   <?php 

                        ?> <?php   
               
                   } elseif(strpos($approved, 'Yes') !== false){
                      include 'database.php';
                      ?> <td><a href="adminDashboard.php?unapprove=<?php echo $postId;?>" class="btn btn-success btn-block" name="unapprove" ><?php echo "Undo";?></a>  
                     </td>
                       <?php
                    } else {
                      }
                      
                      ?>
                     
                     <td><a href="showPost.php?id=<?php echo $postId;?>" class="btn btn-primary btn-block"><?php echo "View Post";?></a></td>
                     <td><button class='btn btn-danger btn-block'>Delete Post</button></td>
                     
                 </tr> <?php
                    
                }
            } 
                    
               ?> 
                </form>
             </table>
             
             </div>
            </div>
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






