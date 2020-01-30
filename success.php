 <div class="card-header bg-dark text-light">
    <div class="row">
        <div class="col col-md-6">
               <h2>Success </h2>
        </div>
        <div class="col col-md-3 offset-md-3 mr-auto">
          <a href="#" class="btn btn-primary btn-block" data-toggle="modal" data-target="#addPost">
            <i class="fas fa-plus"></i> Success
          </a>
        </div>
    </div>
    
</div>


<div class="card-body">
                <?php 

if(isset($_POST["submitPost"])){
    $title = mysqli_real_escape_string($conn, $_POST["Title"]);
    $desc = mysqli_real_escape_string($conn, $_POST["postDescription"]);
    $authorID = $_SESSION["userID"];
    $category = mysqli_real_escape_string($conn, $_POST["category"]);
    $post = mysqli_real_escape_string($conn, $_POST["Post"]);
    
        
    date_default_timezone_set("Europe/London");
    //Create current date and store in specified format
    $currentTime = date("H:i d/m/Y");
    $msg = "Your details are stored as below";
    successMessage($msg);
    
    echo "<h2>Title: ". $title . "</h2>";
    echo "<h2>Title: ". $desc . "</h2>";
    echo "<h2>Title: ". $post . "</h2>";
    
}?>
    
</div>