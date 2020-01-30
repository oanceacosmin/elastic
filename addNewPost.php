    <?php session_start();
// Check if user is logged in
include './includes/functions.php';
if (!isLoggedIn()) {
    alertBackToMainPage();


?>

        <?php include("header.php");   ?>
        <?php include("troubleshootingbar.php");?>  

<!-- Body Starts -->
<body id="home" data-spy="scroll" data-target="#main-nav" class="main-body" background= "img/Background-website-01.jpg">
    <div class="row" >
        <div class="col col-lg-7 offset-lg-2 col-md-11 offset-md-1 col-sm-12 col-xs-12" style="margin-top:30px;" id="content">
              
          <!-- Card Start -->   
          <div class="card" id="dashcontent" >
               <!-- Card header -->
                <div class="card-header bg-dark text-light">
                           <h2>Add New Post </h2>
                </div><!-- Card header end -->
                <!-- Card Body -->
                <div class="card-body">
                    <form action="addNewPost.php" method="POST" enctype="multipart/form-data">
                        <fieldset>
                           <div class="row"><!-- Title and author row -->
                               <div class="col">
                                    <div class="form-group">
                                        <label for="Title"><span class="FieldInfo">Title</span></label>
                                        <input class="form-control" type="text" name="Title" placeholder="Title" required>
                                    </div>
                               </div>
                               <div class="col">
                                    <div class="form-group">
                                      <label for="email">Author</label>
                                        <div class="input-group-prepend">
                                            <input type="email" class="form-control" name="email" value="<?php echo $_SESSION["userEmail"];?>" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>       <!-- Title and author row ends-->
                            <div class="row"> <!-- Description and post type row -->
                               <div class="col">
                                    <div class="form-group">
                                        <label for="Description"><span class="FieldInfo">Description/Keywords:</span></label>
                                        <input class="form-control" type="text" name="postDescription" placeholder="Description" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="postType"><span class="FieldInfo">Post Type: </span></label>
                                        <input type="text" name="postType" class="form-control" value="News" readonly>
                                    </div>
                                </div>
                            </div>         <!-- Description and post type row ends -->
                            <div class="row"> <!-- Category and image select row -->
                                <div class="col">                
                                    <div class="form-group">
                                        <label for="Categories"><span class="FieldInfo">Category</span></label>
                                        <select class="form-control"  name="category">
                                            <?php require_once "./includes/functions.php";
                                            getSelectCategories(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">       
                                    <div class="form-group">
                                        <label for="selectimage"><span class="FieldInfo">Select Image:</span></label>
                                        <input type="File" class="form-control" name="image" required>
                                    </div>
                                </div>
                            </div>          <!-- Category and image select row ends-->
                        <div class="form-group"> <!-- Post content row -->
                            <label for="postArea"><span class="FieldInfo">Post:</span></label>
                            
                            <textarea class="form-control" name="Post" id="postArea" required></textarea><br>
                            <input class="btn btn-success btn-block" type="submit" name="submitPost" value="Submit">
                        </div>  <!-- Post content row ends -->
                        <br>
             <?php 
                //
              
                if(isset($_POST["submitPost"])){
                    
                    $title = mysqli_real_escape_string($conn, $_POST["Title"]);
                    $desc = mysqli_real_escape_string($conn, $_POST["postDescription"]);
                    $postType = mysqli_real_escape_string($conn, $_POST["postType"]);
                    $authorID = $_SESSION["userEmail"];
                    $category = mysqli_real_escape_string($conn, $_POST["category"]);
                    $image = $_FILES["image"]["name"];
                    $tempName = $_FILES["image"]["tmp_name"]; 
                    $post = mysqli_real_escape_string($conn, $_POST["Post"]);
                    //Create current date and store in specified format     

                    
                    $msg = "Your details are stored as below";
                    //successMessage($msg);

                    if(strlen($title)<5){
                        //$_SESSION["ErrorMessage"]="Title can't be empty";
                        //echo "<p>Error</p>";
                       // Redirect_to("addNewPost.php");
                    $msg = "You need a longer title.";
                    alertMessage($msg);
                    echo "<p> " . $postType . $authorID . "</p>";    
                    
                        //exit();
                    } else{
                        include("./includes/database.php");
                         date_default_timezone_set("Europe/London");
                        $currentTime = date('H:i d.m.Y');
                        $sql = "INSERT INTO newsposts(postEmail, postTitle, postDate, postCat, postDesc, postContent, image) VALUES ('$authorID', '$title' ,CURRENT_TIMESTAMP ,'$category', '$desc', '$post', '$image')";
                        
                        
                        $location = "Uploads/";
                        move_uploaded_file($tempName, $location . $image);
                    
                        $execute = mysqli_query($conn, $sql);
                        if($execute){
                            $msg = "Post successfully added.";
                            successMessage($msg);
                        } else{
                            $msg = "Unknown Error";
                            alertMessage($msg);
                        }
                        
                    }
                    
                    

                }
        ?>        
                    </fieldset>
                </form> <!-- Form end -->
            </div><!-- Card body end -->
        </div><!-- Card body end -->
     </div><!-- Col7 offset from dashboard container end -->
            
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
        </div> <!-- Col on the right end -->
    </div><br><br><br><br>
         <!-- First row ends -->
        
    <?php include("footer.php");?>
    </body> <!-- Body Ends -->
</html>      