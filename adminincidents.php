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

                  
         

    <?php include('adminbar.php');?>
                  
                  
                  
                   </div> <!--- End card header -->
   
        
            

        
             
      
      
       <div class="row" style="margin-top: 15px">
         <!-- Column end -->

        <div class="col col-md-12"> <!-- Incident post start - add modal for editing posts? -->
          <div class="card">
            <div class="card-header">
              <h4>Incidents Posts</h4>
                      
                
            </div>
            <div class="card-body">
            <table class="table table-striped table-hover">
               <form name="incTable" method="POST" action="adminincidents.php">
                 
            <!-- Retrieve all incidents posts from logged user-->
            
                        <?php
                    if(isset($_GET['approve'])){
                        include 'database.php';
                        $idfromurl = $_GET['approve'];
                        $approvesql = "UPDATE incidposts SET approved = 'Yes' WHERE incID = '$idfromurl'";
                        $result2 = mysqli_query($conn, $approvesql);
                        mysqli_close($conn);
                        //Check if result successful
                        echo '<div class="alert alert-success" role="alert"> Post approved.</div>
                        <button class="btn btn-dark"  onclick="history.go(-1);">Finish</button>';
                        exit(); }
                   
                    if(isset($_POST['delete'])){
                        $id=$_POST['delete'];
                        $deletesql = "DELETE FROM incidposts WHERE incID = '$id'";
                        include 'database.php';
                        $delete = mysqli_query($conn, $deletesql);
                        echo '<div class="alert alert-success" role="alert"> Post successfully deleted.</div><button class="btn btn-dark" onclick="history.go(-1);">Finish</button>';
                        mysqli_close($conn);
                        exit();
                        }
                   
                      if(isset($_GET['unapprove'])){
                        $idfromurl2 = $_GET['unapprove'];
                      include 'database.php';
                      $unapprovesql = "UPDATE incidposts SET approved = 'No' WHERE incID = '$idfromurl2'";
                      $result3 = mysqli_query($conn, $unapprovesql);
                      mysqli_close($conn);
                      echo '<div class="alert alert-warning" role="alert"> Post unapproved.</div><button class="btn btn-dark" onclick="history.go(-1);">Finish</button>';
                      exit();
                      }                
                ?>
           <?php 
            include('database.php');
            $email = $_SESSION["userEmail"];
            $sql = "SELECT * FROM incidposts ORDER BY incDate DESC LIMIT 8";
            $result = mysqli_query($conn, $sql);
              
            //Another if statement to check if post is approved!!
            if (!mysqli_num_rows($result)){
                $alert = "You have no active posts.";
                alertMessage($alert);
                mysqli_close($conn);
        //if there is one result, execute code between curly brackets
             } else{ 
                //Print table row and header
               ?>  <tr>
                     <th>Author</th>
                     <th>Date</th>
                     <th>Description</th>
                     <th>Post Title</th>
                     <th></th>
                     <th></th>
                     <th></th>
                     </tr> <?php
                     
                // Print content retrieved from database
                while($row = mysqli_fetch_assoc($result)){
                    $incId = $row['incID'];
                    $name =  $row['incEmail'];
                    $date =  $row['incDate'];
                    $desc =  $row['incDesc'];
                    $title =  $row['incTitle'];
                   $approved = $row['approved'];
                   
                if(strlen($title)>70){
                    $title=substr($title, 0, 70) . "...";}
                if(strlen($desc)>70){
                    $desc=substr($desc, 0, 70) . "...";}
                        
                ?>  <tr>
                     <td><?php echo $name;?></td>
                     <td><?php echo $date;?></td>
                     <td><?php echo $desc;?></td>
                     <td><?php echo $title;?></td>
                     <?php 
                    if(strpos($approved, 'No') !== false or $approved == null){ 
                      
                        ?> <td><a href="adminincidents.php?approve=<?php echo $incId;?>" class="btn btn-warning btn-block" name="approve"><?php echo "Approve";?></a></td>   <?php 

               
                   } elseif(strpos($approved, 'Yes') !== false){
                      include 'database.php';
                      ?> <td><a href="adminincidents.php?unapprove=<?php echo $incId;?>" class="btn btn-success btn-block" name="unapprove"><?php echo "Undo";?></a>
                      
                     </td>
                       <?php
                    } else {
                        
                      }
                ?>
                     
                     <td><a href="showincident.php?id=<?php echo $incId;?>" class="btn btn-primary btn-block">View Post</a></td>
                     <td><button class='btn btn-danger btn-block' type="submit" name="delete" value="<?php echo $incId;?>">Delete Post</button></td>
                     
                 </tr> <?php        }
            } ?> 
                    </form> 
                 </table>
                </div>
         

        </div> <!-- Edit profile Card End -->
    </div>
            
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






