<!DOCTYPE html>
<?php 
session_start();
include('./includes/functions.php');
/*
if (!isLoggedIn()) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
    //wrongUser();
    header("Location: index.php");
} elseif ($_SESSION['userType'] == 'employee' || 'admin'){
    header("Location: dashboard.php");
}  */

?>

<html lang="en">
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Private Employee Portal">
        <meta name="keywords" content="Employee Portal">
        <meta name="author" content="C. D. Oancea">
        <title>Employee Portal</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB"
        crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp"
    crossorigin="anonymous">
        <link rel="stylesheet" href="css/style.css">
 
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB"
    crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css" />
</head>
<body >
   
                                                       <!-- Top Header start-->
    <header id="main-header" class="py-2 bg-dark p-0 text-white">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          
          <h1>
            <a href="index.php" class=""><img src="img/logo.png" width="50" height="50" alt=""></a>  ePortal</h1> 
            
        </div>
      </div>
    </div>
    </header>                                        <!-- Top Header end-->

    
    <div class="container"> 
      <div class="row" style="min-height:500px;">
        <div class="col-md-6 mx-auto">
          <div class="card" style="margin-top: 200px; margin-bottom:200px; ">
            <div class="card-header">
              <h4>Account Login</h4>
            </div>
            <div class="card-body" >
              <form action="index.php" method="post"><!-- Login form start-->
               
                <div class="form-group">
                 <?php if (isset($_POST['Login'])){
                    logging();}?>
                  <label for="email">Corporate Email</label>
                  <input type="email" class="form-control" name="email" pattern=".+@eportal.com" required>
                </div>
                
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" name="password" class="form-control" required>
                </div>
                 
                <div class="form-check" style="">
                <input type="checkbox" class="loginInputCheck" id="dropdownCheck2">
                <label class="form-check-label" for="dropdownCheck2">
                  Remember me</label>
              </div>
                <input type="submit" value="Login" name="Login" class="btn btn-primary btn-block">
                
	
              </form>                               <!-- Login form end -->
            </div>
          </div>
        </div>
      </div>
    </div>

         
                                                    <!-- Footer start -->
  <footer id="main-footer"  class="bg-dark text-white mt-3 p-3" >
    <div class="container" >
      <div class="row">
        <div class="col text-center">
          <p class="lead">
            Copyright &copy;
            <span id="year"></span>
            ePortal
          </p>
          <button class="btn btn-primary" data-toggle="modal" data-target="#contactModal">Contact Us</button>
        </div>
      </div>
    </div>
  </footer>                                        <!-- Footer end -->
	
  <div class="modal fade text-dark" id="contactModal"> <!-- Modal for contact us form start-->
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Contact Us</h5>
          <button class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" class="form-control">
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control">
            </div>
            <div class="form-group">
              <label for="message">Message</label>
              <textarea class="form-control"></textarea>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary btn-block">Submit</button>
        </div>
      </div>
    </div>
  </div>                                             <!-- Modal for contact us form end-->


  <script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
    crossorigin="anonymous"></script>
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T"
    crossorigin="anonymous"></script>
</body>
</html>







