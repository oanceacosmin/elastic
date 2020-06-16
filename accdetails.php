    <?php session_start();
include './includes/functions.php';
if (!isLoggedIn()) {
    alertBackToMainPage();
} elseif ($_SESSION['userType'] == 'admin' || 'employee'){
}
include("header.php");
include("troubleshootingbar.php");?>
              
              
    <div class="row" ><!-- Content Starts -->
        <div class="col col-xl-8 offset-xl-2 col-lg-10 offset-lg-1 col-md-10 offset-md-1 col-sm-12 col-xs-12" style="margin-top:30px;" id="content">
              <!-- Card header -->
              
          <div class="card" id="dashcontent" >
            <div class="card-header bg-dark text-white">
               <h2>Account Details </h2>
            </div><!-- Card header end -->
            
            <div class="card-body">
               <div class="row" style="margin-top: 15px">
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header">
                              <h4>Edit Profile</h4>
                            </div>
                        <div class="card-body">
                          <form action="accdetails.php" method="post"> <!-- FORM -->
                           <div class="row">
                             <div class="col">
                                 <div class="form-group">
                                        <!-- Content-->
                                 </div>
                             </div>
                             <div class="col">
                                  <div class="form-group">
                                         <!-- Content-->
                                  </div>
                             </div>
                            </div>
                            <div class="row">
                              <div class="col col-sm12 col-lg-6">
                               <div class="form-group">
                                <label for="name">Full Name</label>
                                <input type="text" class="form-control" value="<?php echo $_SESSION["fullName"];?>">
                              </div>
                              </div>
                             <div class="col col-sm-12 col-lg-6">
                                <div class="form-group">
                              <label for="email">Email</label>
                              <input type="email" class="form-control" value="<?php echo $_SESSION["userEmail"];?>" readonly>
                              </div>
                             </div>
                            </div>
                            <div class="row">
                              <div class="col col-sm12 col-lg-6">
                               <div class="form-group">
                                <label for="homeAddress">Home Address</label>
                                <input type="text" class="form-control" value="<?php echo $_SESSION["homeAddress"];?>">
                              </div>
                              </div>
                             <div class="col col-sm-12 col-lg-6">
                                <div class="form-group">
                              <label for="postCode">Postcode</label>
                              <input type="text" class="form-control" value="<?php echo $_SESSION["postCode"];?>">
                              </div>
                             </div>
                            </div> 
                            <div class="row">
                              <div class="col col-sm12 col-lg-6">
                               <div class="form-group">
                                <label for="department">Department</label>
                                <input type="text" class="form-control" value="<?php echo $_SESSION["department"];?>" readonly>
                              </div>
                              </div>
                             <div class="col col-sm-12 col-lg-6">
                                <div class="form-group">
                              <label for="telephone">Telephone</label>
                              <input type="text" class="form-control" value="<?php echo $_SESSION["telephone"];?>">
                              </div>
                             </div>
                            </div>                            

                <div class="form-group">
                  <label for="bio">Bio</label>
                  <textarea class="form-control" name="editor1" style="height:150px;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid unde at fugiat explicabo temporibus, tempora animi sunt iusto quod beatae optio veritatis velit natus odit error! Possimus esse quisquam quibusdam eveniet autem! Minus dolore quisquam nemo similique doloribus perspiciatis tempore.</textarea>
                </div>
            <!--    <button class="btn btn-primary btn-block">Save Details</button>  ---->
                
                            <div class="row">
                     <div class="col-md-4">
          <a href="#" class="btn btn-primary btn-block">
            <i class="fas fa-save"></i> Save Details
          </a>
        </div>
                <div class="col-md-4">
          <a href="#" class="btn btn-success btn-block">
            <i class="fas fa-lock"></i> Change Password
          </a>
        </div>
        <div class="col-md-4">
          <a href="#" class="btn btn-danger btn-block">
            <i class="fas fa-trash"></i> Delete Account
          </a>
        </div>
      </div> 
         
              </form>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <h3>Your Avatar</h3>
          <img src="userAvatars/<?php echo $_SESSION["useravatar"]; ?>" alt="userAvatars/avatar.png" class="d-block img-fluid mb-3">
          <button class="btn btn-primary btn-block">Edit Image</button>
          <button class="btn btn-danger btn-block">Delete Image</button>
        </div>
      </div>
     </div>
     </div>
     <div class="card" id="dashcontent" >
         <div class="card-header bg-dark text-white">
                   <h2>Posts </h2>
         </div>
          <div class="card-body">
     
        <div class="row" style="margin-top: 15px">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4>News Posts</h4>
            </div>
            <div class="card-body">
             <div class="table-responsive">
            <table class="table table-striped table-hover">
           
                 
            <!-- Retrieve all news posts from logged user-->
           <tr> <?php 
            include 'database.php';
            $email = $_SESSION["userEmail"];
            $sql = "SELECT * FROM newsposts WHERE postEmail='$email' ORDER BY postDate DESC LIMIT 5"; 
            $result = mysqli_query($conn, $sql);
            $rescheck = mysqli_num_rows($result);    
            
            if ($rescheck == 0){
                $alert = "You have no active posts.";
                alertMessage($alert);
                mysqli_close($conn);
            //if there is not 0, create content
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
                }} 
                    
               ?> </tr>

             </table>
             </div>
              <form>
               <div class="row">
                <div class="col">
                <div class="form-group">
                      <!-- Content-->
                </div>
                </div>
                <div class="col">
                <div class="form-group">
                     <!-- Content-->
                </div>
                </div>
                </div>



            <!--    <button class="btn btn-primary btn-block">Save Details</button>  ---->

         
              </form>
            </div>
        </div> <!-- Edit profile Card End -->
        <br>
        </div> <!-- Column end -->
       
        <div class="col col-md-12">
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
            $sql = "SELECT * FROM incidposts WHERE incEmail='$email' ORDER BY incDate DESC LIMIT 5"; 
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
        </div>                          
             </div>                                                  
            </div><!-- Content ends, Sidebar to be added after this -->
 
        </div> <!-- First row ends -->
        
    <?php include("footer.php");?>
    </body>
</html>      