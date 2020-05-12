

<?php session_start(); //Start session and check if user is logged in
include 'includes/functions.php';
if (!isLoggedIn()) {
    alertBackToMainPage();
    //wrongUser();
   
} elseif ($_SESSION['userType'] == 'admin' || 'employee'){
   
}
?>

    
   <?php include("header.php");?>
    <?php include("troubleshootingbar.php");?>

	<!--- Dashboard -->
           
<div class="row">
    <div class="col col-lg-8 offset-lg-2 col-md-10 offset-md-1 col-sm-10 offset-sm-1 col-xs-12" style="margin-top:30px;" id="content">
        <div class="card" id="dashcontents" >

    <div class="row" id="addPost">
     <div class="col"> 
            <?php   //Populate Dashboard with data for post with id from URL
                    include('database.php');
                        $approved = "Yes";
                        $postIdFromUrl = $_GET['id'];
                        $userType = $_SESSION['userType'];                        
                        if($userType == 'normal'){
                        $sql = "SELECT * FROM newsposts WHERE postID='$postIdFromUrl' AND approved = '$approved'";
                        } else{
                         $sql = "SELECT * FROM newsposts WHERE postID='$postIdFromUrl'";        } 
                        $result = mysqli_query($conn, $sql);
                    //Check if any result and display error
                    if(!$result or mysqli_num_rows($result) == 0){
                        $alert = "Post cannot be found.";
                        alertMessage($alert);
                        echo '<button class="btn btn-dark" onclick="history.go(-1);">Finish</button>';
                        mysqli_close($conn);
                        exit();
                    } else{ //Store results from DB and display in card
                    while($row = mysqli_fetch_assoc($result)){
                    $postID = $row['postID'];
                    $name =  $row['postEmail'];
                    $cat =  $row['postCat'];
                    $dbdate = $row['postDate'];
                    $time = strtotime($dbdate);
                    $title =  $row['postTitle'];  
                    $content =  $row['postContent'];
                    $altImagePath =  "./Uploads/eportal.jpg";
                    $date = date('H:i d.m.Y', $time);
                    $imageName = $row['image']; ?>
                    <script>
                         function callfun(obj){
                                var noimg = "<?php echo $altImagePath;?>";
                                obj.src=noimg;}
                    </script>
                    <div class="card">
                        <div class="card-body bg-light">
                            <div class="row align-items-start "> 
                                <div class="col col-md-6 ml-auto">
                                    <h4 class="card-title"><?php echo htmlentities($title); ?></h4><hr>
                                    <div class="row ">
                                        <div class="col-md-5 col-sm-12">
                                           <small class="text-muted">By: <a href="#"> <?php echo $name; ?> </a></small> 
                                        </div>  
                                        <div class="col-md-5 col-sm-12 ml-auto">
                                         <small class="text-muted">Posted: <?php echo $date; ?> </small> 
                                        </div>        
                                   </div>
                                  
                                </div>
                                <div class="col col-md-6 mr-auto">
                                    <img src="./Uploads/<?php echo $imageName; ?>"  alt="" onerror="this.onerror=null; callfun(this);" class="img-fluid thumbnail">
                                </div>
                           </div>
                           <hr>
                            <div class="row"> 
                                <div class="col col-md-8 offset-md-2">
                                    <p class="card-text">
                                    <?php echo htmlentities($content); ?></p>
                                </div>
                           </div>
                           <br><hr>
                        </div>
                    </div>
             <?php      
                    }}
                ?>
                </div>
            </div>
        </div>
     </div>  
</div><br>
               <div class="row"> <!-- Comments section -->
               <div class="col col-md-6 offset-md-3 col-sm-8 offset-sm-2 bg-light">
                <div class="card">
                  <div class="card-header bg-dark text-white"> 
                      <h4 class="card-title">Comments section:</h4>
                  </div>
                  <span class="border border-dark">
                   <div class="card-body bg-light">
                    <div class="row"> 
                        <div class="col col-md-10 offset-md-1">
                        <?php 
                            include('database.php');
                            $comments = "SELECT * FROM newscomments WHERE newsPostID =".$postIdFromUrl." ORDER BY commDate asc";
                            $postNumber = 1;
                            $commresult = mysqli_query($conn, $comments);
                            while($row = mysqli_fetch_assoc($commresult)){
                                ?> 
                                <div class="row">
                                <div class="col col-md-3 text-center"><?php
                                $name = $row['author'];
                                $content = $row['content'];
                                $commdate = $row['commDate'];
                                $commtime = strtotime($commdate);
                                $finaldate = date('H:i d.m.Y', $commtime);
                                $getUserDet = "SELECT * FROM userdetails WHERE email ='$name'";
                                $commuser = mysqli_query($conn, $getUserDet);
                                $commuserrow = mysqli_fetch_assoc($commuser);
                                $authorName = $commuserrow['fullName'];
                                $userImage = "./userAvatars/".$commuserrow['avatar'];
                                $userAltImage = "./userAvatars/avatar.png";
                                ?>
                                
                    <script>
                         function callfun(obj){
                                var noimg = "<?php echo $userAltImage;?>";
                                obj.src=noimg;}
                    </script>
                            <img src="<?php echo $userImage; ?>"  alt="" onerror="this.onerror=null; callfun(this);" class="img-thumbnail" style="image-orientation:from-image;">  
                            </div>
                                <div class="col col-md-9">
                                  <div class="row">
                                      <div class="col col-md-8">
                                           <h5>
                                  <?php echo  $authorName;?>
                                            </h5>
                                       </div>
                                        <div class="col col-md-4">
                                            <h6><?php echo elapsedTimeString($finaldate);?></h6>
                                        </div>
                                  </div>
                                    <div class="row">
                                       <div class="col col-md-12 align-items-end">
                                        <br><p><?php echo $content;?></p>
                                        </div>      
                                    </div>
                                </div>
                            </div><hr>
                            
                            <?php     
                            $postNumber = $postNumber + 1;}
                            ?>       
                                <form action="showPost.php?id=<?php echo $postID;?>" method="POST">
                               <fieldset>
                            <!-- Category and image select row ends-->
                        <div class="form-group"> <!-- Post content row -->
                            <label for="postArea"><span class="FieldInfo">Add a comment</span></label>
                            
                            <textarea class="form-control" name="Post" id="postArea" required></textarea><br>
                            <input class="btn btn-success btn-block" type="submit" name="submitComment" value="Submit">
                        </div>  <!-- Post content row ends -->
                        <br>
      
                            </fieldset> </form>
                            <?php //Submit Comment
                            if(isset($_POST['submitComment'])){
                                $author = $_SESSION['userEmail'];
                                $content = mysqli_real_escape_string($conn, $_POST['Post']);
                                $commsql = "INSERT INTO newscomments (newsPostID, author, content, commDate) VALUES ('$postIdFromUrl', '$author', '$content', CURRENT_TIMESTAMP)";
                                $executesql = mysqli_query($conn, $commsql);
                                if($executesql){
                                $msg = "Post successfully added.";
                                successMessage($msg);
                                echo '<button class="btn btn-dark" onclick="window.location.href=window.location.href">Refresh</button>';
                                 exit();
                            }}
                            ?>
                        </div>
                    </div>
                    </div>                   
                  </span> 

 
                </div>
                </div>
            </div>
	
	

<?php include("footer.php");

function elapsedTimeString($start, $end = null, $limit = null, $filter = true, $suffix = 'ago', $format = 'Y-m-d', $separator = ' ', $minimum = 1)
{
    $dates = (object) array(
        'start' => new DateTime($start ? : 'now'),
        'end' => new DateTime($end ? : 'now'),
        'intervals' => array('y' => 'year', 'm' => 'month', 'd' => 'day', 'h' => 'hour', 'i' => 'minute', 's' => 'second'),
        'periods' => array()
    );
    $elapsed = (object) array(
        'interval' => $dates->start->diff($dates->end),
        'unknown' => 'unknown'
    );
    if ($elapsed->interval->invert === 1) {
        return trim('0 seconds ' . $suffix);
    }
    if (false === empty($limit)) {
        $dates->limit = new DateTime($limit);
        if (date_create()->add($elapsed->interval) > $dates->limit) {
            return $dates->start->format($format) ? : $elapsed->unknown;
        }
    }
    if (true === is_array($filter)) {
        $dates->intervals = array_intersect($dates->intervals, $filter);
        $filter = false;
    }
    foreach ($dates->intervals as $period => $name) {
        $value = $elapsed->interval->$period;
        if ($value >= $minimum) {
            $dates->periods[] = vsprintf('%1$s %2$s%3$s', array($value, $name, ($value !== 1 ? 's' : '')));
            if (true === $filter) {
                break;
            }
        }
    }
    if (false === empty($dates->periods)) {
        return trim(vsprintf('%1$s %2$s', array(implode($separator, $dates->periods), $suffix)));
    }

    return $dates->start->format($format) ? : $elapsed->unknown;
}
?>

   
   
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






