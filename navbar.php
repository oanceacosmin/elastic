//NOT IN USE

    <nav class="navbar sticky-top navbar-expand-md navbar-dark bg-dark" id="main-nav">
    <div class="container">
      <a href="dashboard.php" class="navbar-brand">
        <img src="img/logo.png" width="45" height="45" alt="">
        <h3 class="d-inline align-middle">ePortal</h3>
      </a>
      <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
         
        <ul class="navbar-nav ml-auto">
         <form class="form-inline" action="/action_page.php">
            <input class="form-control mr-sm-2" type="text" placeholder="Search">
            <button class="btn btn-primary" type="submit">Search</button>
          </form>

           <div class="dropdown">
              <button type="button" class="btn dropdown-toggle m-2 bg-dark btn-dark" data-toggle="dropdown">Account</button>
            <ul class="dropdown-menu">
               <?php 
                   ?>
                <li><a class="dropdown-item" href="#" data-target="accdetails">Account Details</a></li>
                
                <li><a class="dropdown-item" href="#" data-target="logout">Log Out</a></li>
                
                
            <?php 
                require_once 'includes/functions.php';
                if(isset($_POST['logOut'])){
                logOut();
            }
?>            
            </ul>
            
            </div>
            <form action="dashboard.php" method="POST">
                    <button type="submit" class="" name="logOut" >LogOutttt</button></form>
        </ul>
      </div>
    </div>
  </nav>