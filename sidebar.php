<!-- Sidebar start -->
         <div class="col col-lg-3 col-md-12 col-xs-12 ml-auto" style="margin-top:30px; text-align: left;">
          <div class="row">
<!-- News Start--><div class="col-lg-12 col-md-6 col-sm-12 col-xs-12"  style="padding:10px;">
                <div class="card">
                <div class="card-header bg-dark">
                    <a href="allNews.php" class="rightSideContent text-light"><h3>Latest News</h3></a> 
                </div>
            <?php   $approved = "Yes";
                    $sql = "SELECT * FROM newsposts WHERE approved = '$approved' ORDER BY postDate DESC LIMIT 3";
/* Set time and calculate time between start and end of query execution*/                   
                    function microtime_float(){
                        list($usec, $sec) = explode(" ", microtime());
                        return ((float)$usec + (float)$sec);}
                    $time_start = microtime_float();
                    $result = mysqli_query($conn, $sql);
                    $time_end = microtime_float();
                    $time = $time_end - $time_start;
                    $time = $time * 1000;
                    $time = round($time, 3);
/* Check if at least 1 result is retrieved */
                    if(!$result or mysqli_num_rows($result) == 0){
                        $alert = "There are no active posts.";
                        alertMessage($alert);
                        echo '<div class="alert alert-primary" role="alert">
                                Query execution time: 
                                ' . $time . " Milliseconds</div>";
/* If at least 1 result, store result in associative array and display each in while loop*/
                    } else{
                        echo '<div class="alert alert-primary" role="alert"> Query took: ' . $time . " Seconds</div>";
                        while($row = mysqli_fetch_assoc($result)){ /* Store data from each row */
                        $postID = $row['postID'];
                        $name =  $row['postEmail'];
                        $cat =  $row['postCat'];
                        $dbdate = $row['postDate'];
                        $time = strtotime($dbdate);
                        $title =  $row['postTitle'];  
                        $content =  $row['postContent'];
                        $altImagePath =  "./Uploads/eportal.jpg";
                        $date = date('H:i d.m.Y', $time);
                        $imageName = $row['image'];?>
 <!--Post start --><div class="card">  
                    <div class="card-body bg-light">
                      <div class="row">    
                        <div class="col col-md-12"> 
                            <h4><a href="showPost.php?id=<?php echo $postID;?>"><?php echo $title;?></a></h4>
                            <h6>By: <a href="#"><?php echo $name; ?></a> On: <?php echo $date;?></h6>
 <!--Limit to 250 char-->   <p><?php if(strlen($content)>250){ $content=substr($content, 0, 250) . "...";}
                                echo htmlentities($content);  ?></p>
                        </div>
                      </div>
                     </div>
 <!--Post end --></div>
       
<?php }}?> <!-- While loop and Else End-->
                </div>
              </div> <!-- News End-->
              <!-- Incidents Start -->
              <div class="col-lg-12 col-md-6 col-sm-12 col-xs-12" style="padding:10px;">
                <div class="card">
                <div class="card-header bg-dark">
                    <a href="allincidents.php" class="rightSideContent text-light"><h3>Latest Incidents</h3></a> 
                </div>
             <?php $approved = "Yes";
                    $sqlInc = "SELECT * FROM incidposts WHERE approved = '$approved' ORDER BY incDate DESC LIMIT 3"; 
                    $time_start = microtime_float();
                    $resultInc = mysqli_query($conn, $sqlInc);
                    $time_end = microtime_float();
                    $time = $time_end - $time_start;
                    $time = $time * 1000;
                    $time = round($time, 3);
                    echo '<div class="alert alert-primary" role="alert"> Query took: ' . $time . " Seconds</div>";
                    if(!$resultInc or mysqli_num_rows($resultInc) == 0){
                        $alert = "There are no active posts.";
                        alertMessage($alert);
                    } else{
                    while($row = mysqli_fetch_assoc($resultInc)){
                    $postID = $row['incID'];
                    $name =  $row['incEmail'];
                   // $cat =  $row['postCat'];
                    $dbdate = $row['incDate'];
                    $time = strtotime($dbdate);
                    $title =  $row['incTitle'];  
                    $content =  $row['incContent'];
                    $altImagePath =  "./Uploads/eportal.jpg";
                    $date = date('H:i d.m.Y', $time);
                    //$imageName = $row['image']; 
                            ?>
                <div class="card">  
                    <div class="card-body bg-light">
                        <div class="row">    
                            <div class="col col-md-12"> 
                <h4><a href="showincident.php?id=<?php echo $postID;?>"><?php
                    echo $title;?></a></h4>
                <h6>By: <a href="#"><?php echo $name; ?></a> On: <?php echo $date;?></h6>
                   <p><?php
                        if(strlen($content)>150){
                            $content=substr($content, 0, 150) . "...";}
                        echo htmlentities($content);  ?></p>
                            </div>
                        </div>
                     </div>
                  </div>
       
<?php }}?> <!-- While loop and Else End-->
                </div>
              </div><!-- Incidents End-->
          </div>
        </div>