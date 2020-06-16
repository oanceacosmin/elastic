<?php session_start();
// Check if user is logged in
include './includes/functions.php';
if (!isLoggedIn()) {
    alertBackToMainPage();
}
include("header.php"); 
include("troubleshootingbar.php");?>  
<!-- Form Starts -->
    <div class="row" >
        <div class="col col-lg-8 offset-lg-2 col-md-10 offset-md-1 col-sm-12 col-xs-12" style="margin-top:30px;" id="content">
          <!-- Card Start -->   
          <div class="card" id="dashcontent" >
               <!-- Card header -->
                <div class="card-header bg-dark text-light">
                    <div class="row">
                        <div class="col col-lg-11">       
                               <h2>Add New Post </h2>
                         </div>  
                         <div class="col col-lg-1">       
                               <button class="btn btn-dark" onclick="history.go(-1);"><h4>&mapstoleft;</h4></button>
                         </div>   
                     </div>   
                </div><!-- Card header end -->
                <div class="card-body">  <!-- Card Body -->
                  <form action="addNewPost.php" method="POST" enctype="multipart/form-data">
            <?php  if(isset($_POST["submitPost"])){
                        $title = mysqli_real_escape_string($conn, $_POST["Title"]);
                        $desc = mysqli_real_escape_string($conn, $_POST["postDescription"]);
                        $postType = mysqli_real_escape_string($conn, $_POST["postType"]);
                        $authorID = $_SESSION["userEmail"];
                        $category = mysqli_real_escape_string($conn, $_POST["category"]);
                        $image = $_FILES["image"]["name"];
                        $tempName = $_FILES["image"]["tmp_name"]; 
                        $post = mysqli_real_escape_string($conn, $_POST["Post"]);    
                        $approved = "No";
                        if(strlen($title)<5){
                        $msg = "You need a longer title.";
                        alertMessage($msg);
                        exit();
                        }else{
                            //include("./includes/database.php");
                            date_default_timezone_set("Europe/London");
                            $currentTime = date('H:i d.m.Y');
                            $sql = "INSERT INTO newsposts(postEmail, postTitle, postDate, postCat, postDesc, postContent, image, approved) VALUES ('$authorID', '$title' , CURRENT_TIMESTAMP ,'$category', '$desc', '$post', '$image', '$approved')";
                            $location = "Uploads/";
                            move_uploaded_file($tempName, $location . $image);
                            $execute = mysqli_query($conn, $sql);
                            if($execute){
                                $msg = "Post successfully added.";
                                successMessage($msg);
                                echo '<button class="btn btn-dark" onclick="history.go(-1);">Finish</button>';
                                exit();
                            } else{
                                $msg = "Something went wrong.";
                                alertMessage($msg);
                                exit();
                            }}} ?>  
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
                                        <input type="File" class="form-control" name="image">
                                    </div>
                                </div>
                            </div>          <!-- Category and image select row ends-->
                        <div class="form-group"> <!-- Post content row -->
                            <label for="postArea"><span class="FieldInfo">Post:</span></label>
                            
                            <textarea class="form-control" name="Post" id="postArea" required></textarea><br>
                            <input class="btn btn-success btn-block" type="submit" name="submitPost" value="Submit">
                        </div>  <!-- Post content row ends -->
                        <br>
      
                    </fieldset>
                </form> <!-- Form end -->
            </div><!-- Card body end -->
        </div><!-- Card body end -->
     </div><!-- Col7 offset from dashboard container end -->
    </div><br><br><br><br>
         <!-- First row ends -->
        
    <?php include("footer.php");?>
    </body> <!-- Body Ends -->
</html>      
