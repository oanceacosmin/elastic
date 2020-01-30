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

                  
                  
<nav class="navbar navbar-expand-md navbar-dark bg-dark" id="main-nav">
        
       
  
          
          <form action="dashboard.php" method="POST">
            <button type="submit" class="btn btn-dark m-2" name="logOut" >News</button>
            <a class="btn btn-dark m-2" href="accdetails.php" >HREF TO php page</a> 
            <button type="submit" class="btn btn-dark m-2" name="logOut" >Incidents</button>
            <button type="submit" class="btn btn-dark m-2" name="logOut" >Users</button>   
            <button type="submit" class="btn btn-dark m-2" name="logOut" >Contact</button>
                  
                </form>
         
        
       
   
   
  </nav>
                  
                  
                  
                  
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
           
                 
            <!-- Retrieve all posts from logged user-->
           <tr> <?php 
            include 'database.php';
            $email = $_SESSION["userEmail"];
            //After setting the limit of retrieved posts to 5, user must choose page or result from 6 to 10
            $sql = "SELECT * FROM newsposts ORDER BY postDate DESC LIMIT 5"; 
            $result = mysqli_query($conn, $sql);
            $rescheck = mysqli_num_rows($result);    
            
            if ($rescheck == 0){
                $alert = "You have no active posts.";
                alertMessage($alert);
                mysqli_close($conn);
        //if there is one result, execute code between curly brackets
             } else{ 
                echo "<tr>
                     <th>Author</th>
                     <th>Date</th>
                     <th>Category</th>
                     <th>Post Title</th>
                     <th></th>
                     <th></th>
                 </tr>";
                
                while($row = mysqli_fetch_assoc($result)){
                    $name =  $row['postEmail'];
                    $date =  $row['postDate'];
                    $cat =  $row['postCat'];
                    $title =  $row['postTitle'];
                    echo "<tr>
                     <td>$name</td>
                     <td>$date</td>
                     <td>$cat</td>
                     <td>$title</td>
                     <td><button class='btn btn-primary btn-block'>Edit Post</button></td>
                     <td><button class='btn btn-danger btn-block'>Delete Post</button></td>
                     
                 </tr>";
                    
                }
            } 
                    
               ?> </tr>

             </table>
             </div>
            </div>
        </div> <!-- Edit profile Card End -->
        <br>
        </div> <!-- Column end -->
       
        <div class="col col-md-12"> <!-- Incident post start - add modal for editing posts? -->
          <div class="card">
            <div class="card-header">
              <h4>Incidents Posts</h4>
            </div>
        <div class="card-body">
            <table class="table table-striped table-hover">
           
                 
            <!-- Retrieve all incidents posts from logged user-->
           <tr> <?php 
            include('database.php');
            $email = $_SESSION["userEmail"];
            $sql = "SELECT * FROM incidposts ORDER BY incDate DESC LIMIT 8";
            $result = mysqli_query($conn, $sql);
              
            
            if (!mysqli_num_rows($result)){
                $alert = "You have no active posts.";
                alertMessage($alert);
                mysqli_close($conn);
        //if there is one result, execute code between curly brackets
             } else{ 
                //Print table row and header
                echo "<tr>
                     <th>Author</th>
                     <th>Date</th>
                     <th>Category</th>
                     <th>Post Title</th>
                     <th></th><th></th></tr>";
                     
                // Print content retrieved from database
                while($row = mysqli_fetch_assoc($result)){
                    $name =  $row['incEmail'];
                    $date =  $row['incDate'];
                    $desc =  $row['incDesc'];
                    $title =  $row['incTitle'];
                   
                if(strlen($title)>70){
                    $title=substr($title, 0, 70) . "...";}
                if(strlen($desc)>70){
                    $desc=substr($desc, 0, 70) . "...";}
                        
                    echo "<tr>
                     <td>$name</td>
                     <td>$date</td>
                     <td>$desc</td>
                     <td>$title</td>
                     <td><button class='btn btn-primary btn-block'>Edit Post</button></td>
                     <td><button class='btn btn-danger btn-block'>Delete Post</button></td>
                     
                 </tr>";
                    
                }
            } 
                    
               ?> </tr>

             </table>
            </div>
         

        </div> <!-- Edit profile Card End -->
      </div>
    </div>
                </div> <!--- End dashboard content card-->
            </div> 

    <?php include("sidebar.php");?>

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






