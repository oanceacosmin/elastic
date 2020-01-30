

<?php session_start();
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
        
                
            <?php   //Populate Dashboard with news results
                    include('database.php');
                    if(isset($_GET['searchButton'])){
                        $search = $_GET['Search'];
                        $sql = "SELECT * FROM newsposts WHERE postTitle LIKE '%$search%' or postDesc LIKE '%$search%' ";
                    } else {
                        $postIdFromUrl = $_GET['id'];
                        $sql = "SELECT * FROM newsposts WHERE postID='$postIdFromUrl' ORDER BY postDate DESC LIMIT 8";
                    }
                    
                    $result = mysqli_query($conn, $sql);

                    if(mysqli_num_rows($result) == 0){
                        $alert = "There are no active posts.";
                        alertMessage($alert);
                        mysqli_close($conn);
                    } else{ 

                    
                    
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
                            <div class="row align-items-center "> 
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
                                <div class="col col-md-12 ml-auto">
                                    
                                    <p class="card-text">
                                    <?php echo htmlentities($content); ?></p>
                                </div> 
                           </div>
                        </div>
                    </div>
                    
                        
             <?php      
                    }
                }
                
                
                
                ?>
            
 




                </div>
            </div>
        </div>
     </div>  
</div>


	
	<div style="margin-top:100px;"></div>

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


<script>//Script that retrieves 
    $(document).ready(function(){
            //Set trigger and container var
        var trigger = $('.dropdown .dropdown-menu .dropdown-item'),
        container = $('#dashcontent');
    
            //Trigger when click
        trigger.on('click', function(){
            //set variable to be reused, set target from data attribute
             var $this = $(this),
              target = $this.data('target');
            //load target page into container
            container.load('dashboardContent/' + target + '.php');
            
            //Stop link behaviour
            return false;
        });
     }); 
    
    </script>

<script>//Script that retrieves content from sidebar menu
    $(document).ready(function(){
            //Set trigger and container var
        var trigger = $('#mySidebar .sidebarItem'),
        container = $('#dashcontent');
    
            //Trigger when click
        trigger.on('click', function(){
            //set variable to be reused, set target from data attribute
          var $this = $(this),
              target = $this.data('target');
            //load target page into container
            container.load('dashboardContent/' + target + '.php');
            
            //Stop link behaviour
            return false;
        });
     }); 
    
    </script>
    
    <script>//Script that retrieves content from sidebar menu
    $(document).ready(function(){
            //Set trigger and container var
        var trigger = $('.card .card-header .rightSideContent'),
        container = $('#dashcontent');
    
            //Trigger when click
        trigger.on('click', function(){
            //set variable to be reused, set target from data attribute
          var $this = $(this),
              target = $this.data('target');
            //load target page into container
            container.load('dashboardContent/' + target + '.php');
            
            //Stop link behaviour
            return false;
        });
     }); 
    </script>
    
    <script>//Script that retrieves posts
    $(document).ready(function(){
            //Set trigger and container var
        var trigger = $(''),
        container = $('#dashcontent');
    
            //Trigger when click
        trigger.on('click', function(){
            //set variable to be reused, set target from data attribute
          var $this = $(this),
              target = $this.data('target');
            //load target page into container
            container.load('dashboardContent/' + target + '.php');
            
            //Stop link behaviour
            return false;
        });
     }); 
    </script>

    
    
    <?php   ?>
    
</body>

</html>






