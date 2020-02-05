 
         
<div class="row">
    <div class="col col-md-12">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark" id="main-nav">
                  <form action="adminbar.php" method="POST">
                    <a class="btn m-2 <?php
                    $websiteURL = "http://" . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
                    if(strpos($websiteURL, "adminDashboard") !== false){
                       $active = "btn-light"; echo $active;} else {$active = "btn-dark"; echo $active;}?>" href="adminDashboard.php">News</a> 
                    <a class="btn m-2 <?php if(strpos($websiteURL, "adminincidents") !== false){
                        echo "btn-light";} else {$active = "btn-dark"; echo $active;} ?>" href="adminincidents.php" >Incidents</a> 
                    <a class="btn m-2 <?php
                    $websiteURL = "http://" . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
                    if(strpos($websiteURL, "allusers") !== false){
                       $active = "btn-light"; echo $active;} else {$active = "btn-dark"; echo $active;}?>" href="allusers.php" >Users</a> 
                    <a class="btn btn-dark m-2" href="#" >Troubleshooting</a> 
                    </form>
        </nav>
    </div>
</div>