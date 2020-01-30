    <?php session_start();
include './includes/functions.php';
if (!isLoggedIn()) {
    alertBackToMainPage();
    //wrongUser();
   
} elseif ($_SESSION['userType'] == 'admin' || 'employee'){
   
}
?>
              
              
        <?php include("header.php");?>
        <?php include("troubleshootingbar.php");?>
              
<body id="home" data-spy="scroll" data-target="#main-nav" class="main-body" background= "img/Background-website-01.jpg">
              
    <div class="row" ><!-- Content Starts -->
        <div class="col col-lg-7 offset-lg-2 col-md-11 offset-md-1 col-sm-12 col-xs-12" style="margin-top:30px;" id="content">
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
                            <div class="row">
                                <div class="col col-sm12 col-lg-6">
                                <div class="form-group">
                                 <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="dropdownCheck2">
                                    <label class="form-check-label" for="dropdownCheck2">
                                      Remember me
                                    </label>
                                  </div>
                                </div>
                                </div>
                                <div class="col col-sm-12 col-lg-6">
                                    <label class="form-check-label" for="dropdownCheck2">Department</label>
                                  <div class="form-group">
                                    <div class="btn-group">
                                      <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Right-aligned menu</button>
                                      <div class="dropdown-menu dropdown-menu-right">
                                        <button class="dropdown-item" type="button">Action</button>
                                        <button class="dropdown-item" type="button">Another action</button>
                                        <button class="dropdown-item" type="button">Something else here</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            </div>
                <div class="form-group">
                  <label for="bio">Bio</label>
                  <textarea class="form-control" name="editor1">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid unde at fugiat explicabo temporibus, tempora animi sunt iusto quod beatae optio veritatis velit natus odit error! Possimus esse quisquam quibusdam eveniet autem! Minus dolore quisquam nemo similique doloribus perspiciatis tempore.</textarea>
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
          <img src="img/avatar.png" alt="" class="d-block img-fluid mb-3">
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
           
                 
            <!-- Retrieve all posts from logged user-->
           <tr> <?php 
            include 'database.php';
            $email = $_SESSION["userEmail"];
            $sql = "SELECT * FROM newsposts WHERE postEmail='$email'"; 
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
            include 'database.php';
            $email = $_SESSION["userEmail"];
            $sql = "SELECT * FROM incposts WHERE incEmail='$email'"; 
            $result = mysqli_query($conn, $sql);
              
            
            if (mysqli_num_rows($result) == 0){
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
                     
                 
                while($row = mysqli_fetch_assoc($result)){
                    $name =  $row['postEmail'];
                    $date =  $row['postDate'];
                    $cat =  $row['postCat'];
                    $title =  $row['postTitle'];
                    echo "<tr>
                     <th>$name</th>
                     <th>$date</th>
                     <th>$cat</th>
                     <th>$title</th>
                     <th><button class='btn btn-primary btn-block'>Edit Post</button></th>
                     <th><button class='btn btn-danger btn-block'>Delete Post</button></th>
                     
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
            
        <div class="col col-lg-3 col-md-11 offset-md-1 col-xs-12 ml-auto" style="margin-top:30px; text-align: left;">
          <div class="row">
              <div class="col-lg-12 col-md-6 col-sm-12 col-xs-12"  style="padding:10px;">
                 <div class="card">
                <div class="card-header bg-dark">
                    <a href="allNews.php" class="rightSideContent text-light"><h3>News Feed</h3></a> 
                    </div>
            <div class="card">   
            <div class="card-body bg-light">
            <div class="row">  
            <div class="col col-md-12"> 
             <h4><a href="#">Charity event - Hosting Clothing Sales</a></h4>
            <h6>BY: <a href="#">Username222 </a>ON: 10.12.2019</h6>
               <p>Welcome to my event, I am looking forward to have your support in etc etcelcome to my event, I am looking forward to have your support i....</p>
            </div></div></div>
              </div>
            <div class="card">   
            <div class="card-body bg-light">
            <div class="row">  
            <div class="col col-md-12"> 
             <h4><a href="#">Charity event - Hosting Clothing Sales</a></h4>
            <h6>BY: <a href="#">Username222 </a>ON: 10.12.2019</h6>
               <p>Welcome to my event, I am looking forward to have your support in etc etcelcome to my event, I am looking forward to have your support in ...</p>
            </div></div></div>
              </div>

                  </div>
              </div>
              <div class="col-lg-12 col-md-6 col-sm-12 col-xs-12" style="padding:10px;">
                 <div class="card">
                      <div class="card-header bg-dark">
                <a href="#" class="rightSideContent text-light" data-target="incidents"><h3>Incidents</h3></a> 
                       </div>
                      <div class="card-body bg-light">
                            <h4>This is a post name retrieved from database.</h4>
                           <p>Content </p> 
                            <p> Username</p>
                    </div>
                </div>
              </div>
          </div>
        </div>
        </div> <!-- First row ends -->
        
    <?php include("footer.php");?>
    </body>
</html>      