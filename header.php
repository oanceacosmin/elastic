<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Private Employee Portal">
        <meta name="keywords" content="Employee Portal">
        <meta name="author" content="C. D. Oancea">
        <title>Employee Portal</title>
        <!--- Bootstrap Stylesheet -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB"
        crossorigin="anonymous">
       <!--- Dashboard Jquery -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp"
        crossorigin="anonymous">
      
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="./css/style.css">
</head>
    <body id="home" data-spy="scroll" data-target="#main-nav" class="" background= "img/Background-website-01.jpg">
    
    <nav class="navbar sticky-top navbar-expand-md navbar-dark bg-dark" id="main-nav">
        <div class="container">
             <div class="navbar-header">
                  <a href="dashboard.php" class="navbar-brand">
                    <img src="img/logo.png" width="45" height="45" alt="">
                    <h3 class="d-inline align-middle">ePortal</h3>
                  </a></div>
          <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav ml-auto">
               <li><a class="btn btn-dark m-2" href="adminDashboard.php">Admin</a></li>
                <li><a class="btn btn-dark m-2" href="dashboard.php">Dashboard</a></li>
                  <li><a class="btn btn-dark m-2" href="accdetails.php" >Account</a></li>
                  <li><form action="dashboard.php" method="POST">
                        <button type="submit" class="btn btn-dark m-2" name="logOut" >Log Out</button></form></li>
                    <?php 
                        require_once 'includes/functions.php';
                        if(isset($_POST['logOut'])){
                        logOut();}  ?>            

                </ul>
                <form class="form-inline m-2" action="allNews.php" method="GET">
                <input class="form-control mr-sm-2" type="text" name="Search" placeholder="Search">
                <button class="btn btn-primary" type="submit" name="searchButton">Search</button>
              </form>

          </div>
    </div>
  </nav>