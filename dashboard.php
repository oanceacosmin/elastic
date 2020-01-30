<?php session_start();
include('includes/functions.php');
// Check if user is logged in
if (!isLoggedIn()) {
    alertBackToMainPage();}?>
    <?php include("header.php");?>
    <?php include("troubleshootingbar.php");?>
    
    
<body id="home" data-spy="scroll" data-target="#main-nav" class="main-body" background= "img/Background-website-01.jpg">
   <!--- Top Navigation Bar -->

    <?php ?>
    
    
	<!--- Dashboard -->
    <div class="row" >
            <div class="col col-lg-7 offset-lg-2 col-md-10 offset-md-1 col-sm-12 col-xs-12" style="margin-top:30px;" id="content">
            

                <div class="card" id="dashcontent" ><!--- Dashboard content-->
                   <div class="card-header bg-dark text-light"> <!--- Card header -->
                       <h2>Dashboard </h2><!--- Dashboard Title-->

                   </div> <!--- End card header -->
                    <div class="card-body bg-light" style="min-height:500px; "> <!--- Card body/ Dashboard-->
                      <img src="img/dash.jpg" alt="" class="img-fluid " style="max-width:100%; height:auto;">
                      <div class="row"> <!--- Start row -->
                          <div class="col col-md-10 offset-md-1" style="text-align:start;">
                         
                         <br>
                         <h1>Welcome!</h1>
                         <h3 class="">We are ePortal, and we are here to help you with your workplace connection. Get started by clicking the link below.</h3>
                         <button class="btn btn-primary btn-block">Get Started</button>
                         </div>
                          
                      </div><!--- End row -->
                      
    
                    </div> <!---  End card body-->
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
    <script></script>
    
    
    <?php   ?>
    
</body>

</html>






