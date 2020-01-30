      <div class="col col-lg-3 col-md-12 col-xs-12 ml-auto" style="margin-top:30px; text-align: left;">
          <div class="row">
              <div class="col-lg-12 col-md-6 col-sm-12 col-xs-12"  style="padding:10px;">
                <div class="card">
                <div class="card-header bg-dark">
                    <a href="allNews.php" class="rightSideContent text-light"><h3>Latest News</h3></a> 
                </div>

                           <?php $sql = "SELECT * FROM newsposts ORDER BY postDate DESC LIMIT 4"; 
                            include('database.php');
                            $result = mysqli_query($conn, $sql);
                            if(mysqli_num_rows($result) == 0){
                    $alert = "There are no active posts.";
                    alertMessage($alert);
                    echo '<div class="alert alert-primary" role="alert">
            Query execution time: 
' . $time * 1000 . " Milliseconds</div>";
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
                    $imageName = $row['image']; 
                           
                                
                            ?>  
                <div class="card">   
                    <div class="card-body bg-light">
                        <div class="row">    
                            <div class="col col-md-12"> 
                <h4><a href="showPost.php?id=<?php echo $postID;?>"><?php
                    echo $title;?></a></h4>
                <h6>By: <a href="#"><?php echo $name; ?></a> On: <?php echo $date;?></h6>
                   <p><?php   
                        if(strlen($content)>250){
                            $content=substr($content, 0, 250) . "...";}
                                
                                        echo htmlentities($content);  ?></p>
                            </div>
                        </div>
                     </div>
                  </div>
       
<?php }}?>
                </div>
              </div>
              <div class="col-lg-12 col-md-6 col-sm-12 col-xs-12" style="padding:10px;">
                 <div class="card">
                      <div class="card-header bg-dark">
                <a href="incidents.php" class="rightSideContent text-light" data-target="incidents">                       <h3>Incidents</h3></a> 
                       </div>
                      <div class="card-body bg-light">
                            <h4>This is a post name retrieved from database.</h4>
                           <p>Content </p> 
                            <p> Username</p>
                    </div>
                </div>
              </div>
          </div>
        </div>