<?php
session_start();
require("conn.php");

if(isset($_SESSION['logged_username'])){
    $stud_username = $_SESSION['logged_username'];
    //Find the id of the logged student
    $sql = "SELECT * FROM student WHERE stud_username = '$stud_username'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    $sid = $row['stud_id'];
}else {
    $sid = "";
}


header('Content-Type: text/html; charset=ISO-8859-1');

$cid = $_GET['cid'];
$sql = "SELECT * FROM course c, teacher t WHERE (c.teac_id = t.teac_id) AND cour_id = '$cid'";
//Find the name of the course and the category of it
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$page_name = $row['cour_name'];
$page_category = $row['cour_category'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="enroll-courses.css">
    <link rel="stylesheet" href="course-card.css">
    <link rel="stylesheet" href="confirmation.css">
    <link rel="icon" type="image/png" href="Images/Learneasy_favicon.png">
    <script src="https://kit.fontawesome.com/8e94eefdff.js" crossorigin="anonymous"></script>
    <title><?php echo $page_name; ?></title>
</head>
<body>
    <?php
    if(isset($_SESSION['logged_username'])){
        include("nav.php");
    }else{
        include("visitor-nav.php");
    }
    ?>
    <div class="enroll-course-page">
        <?php include("backBtn.php");?>
        <div class="enroll-course">
            <?php
            //Display the selected course detail
            $sql = "SELECT * FROM course c, teacher t WHERE (c.teac_id = t.teac_id) AND cour_id = '$cid' LIMIT 1";
            $result = mysqli_query($conn, $sql);
            
            if(mysqli_num_rows($result) > 0){
            
            while ($row = mysqli_fetch_array($result)){
            ?>
            <section class="en-course-left">
                <div class="en-course-info">
                    <p class="en-course-name"><?php echo $page_name?></p>
                    <img class="en-course-cover" src="Images/<?php echo $row['cour_cover'];?>" alt="Course Cover">
                </div>
                <div class="about-teacher">
                    <div class="en-flex-row">
                        <span class="en-section-title">About the teacher</span>
                        <button id="enroll-btn">Enroll Course</button>
                        <!-- The Modal -->
                        <div id="enroll-confirmation" class="modal">
                            <!-- Modal content -->
                            <div class="modal-content">
                                <div class="confirm-left">
                                    <p class="top-label">Great, You took the first step!</p>
                                    <p class="bottom-label">But before that, we need you to agree on our <a href="">learning guidelines</a>.</p>
                                    <form action="enrolment.php" method="POST">
                                        <input type="hidden" value="<?php echo $cid;?>" name="cid">
                                        <input type="hidden" value="<?php echo $sid;?>" name="sid">
                                        <div class="checkbox">
                                            <input type="checkbox" id="check" required>
                                            <label for="check" class="check-label">I, hereby agree to the learning guidelines.</label>
                                        </div>
                                        <div class="cancel-ok">
                                            <button type="button" class="close">Cancel</button>
                                            <input type="submit" class="confirm-enroll" value="OK" name="confirm-enroll">
                                        </div>
                                    </form>
                                </div>
                                <div class="confirm-right">
                                    <img src="Images/confirmation-img.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="en-teacher-info">
                        <div class="pic-and-name">
                            <img src="Images/<?php echo $row['teac_profile_picture']?>" alt="">
                            <a href="teacher-stud-profile.php?tid=<?php echo $row['teac_id']?>"><span class="en-teacher-name"><?php echo $row['teac_first_name']?> <?php echo $row['teac_last_name'];?></span></a>
                        </div>
                        <span class="en-teacher-bio"><?php echo nl2br($row['teac_bio']);?></span>
                    </div>
                </div>
                <div class="about-class">
                    <span class="en-section-title">About the Class</span>
                    <p class="en-course-des"><?php echo nl2br($row['cour_description']);?></p>
                </div>
      <div class="en-course-rating">
        <div class="en-sec-title-btn">
          <span class="en-section-title">How students rated this course</span>
        </div>
        <div class="rating-and-chart">
            <div class="en-rating-value">
                <div class="center-div">
                    <?php
                    //Display the total number of review
                    $avgsql = "SELECT AVG(rate_course_value) AS ratingavg FROM rating WHERE cour_id = '$cid'";
                    $avgresult = mysqli_query($conn, $avgsql);
                    $row = mysqli_fetch_assoc($avgresult);
                    $ratingavg = round($row['ratingavg'],1);
                    if($ratingavg >= 4.5){
                      $rating_sent = "Fantastic!";
                    }elseif ($ratingavg >= 4.0){
                      $rating_sent = "Awesome!";
                    }elseif($ratingavg >= 3.5){
                      $rating_sent = "Great!";
                    }elseif($ratingavg >= 3.0){
                      $rating_sent = "Good!";
                    }elseif($ratingavg >= 2.5){
                      $rating_sent = "Fine";
                    }elseif($ratingavg >= 2.0){
                      $rating_sent = "OK";
                    }elseif($ratingavg >=1.5){
                      $rating_sent = "Urghh";
                    }elseif($ratingavg >= 1.0){
                      $rating_sent = "Hmmm...";
                    }elseif($ratingavg >= 0.5){
                      $rating_sent = "No way...";
                    }else{
                      $rating_sent = "No reviews...";
                    }

                    ?>
                    <div class="en-star-value">
                        <i class="fas fa-star"></i><span><?php echo $ratingavg;?></span>
                    </div>
                    <p><?php echo $rating_sent;?></p>
                    <?php
                    //Display the total number of review
                    $ratingsql = "SELECT COUNT(*) totalreview FROM rating WHERE cour_id = '$cid'";
                    $ratingresult = mysqli_query($conn, $ratingsql);
                    $row = mysqli_fetch_assoc($ratingresult);
                    $totalreview = $row['totalreview'];
                    ?>
                    <span class="num-of-review">(Based on <?php echo $row['totalreview'];?> reviews)</span>
                </div>
            </div>
            <div class="rating-chart">
                <p class="chart-title">Review</p>
                <div class="chart-flex">
                    <?php
                    //Display the total number of review
                    $fivesql = "SELECT COUNT(*) totalfive FROM rating WHERE cour_id = '$cid' AND rate_course_value = 5";
                    $fiveresult = mysqli_query($conn, $fivesql);
                    $row = mysqli_fetch_assoc($fiveresult);
                    $totalfive = $row['totalfive'];
                    
                    if($totalfive > 0){
                      $widthorange = (((($totalfive/$totalreview)*100)/100)*22.786);
                      echo '<style type = "text/css">
                              .bar-5 {
                                width: '.$widthorange.'vw;
                              }
                              </style>';
                    }else{
                      echo '<style type = "text/css">
                              .bar-5 {
                                width: 0vw;
                              }
                              </style>';
                    }
                    ?>
                    <span class="rating-num">5</span>
                    <div class="chart-bar">
                        <div class="orange-bar bar-5"></div>
                        <div class="grey-bar"></div>
                    </div>
                    <span class="rating-count"><?php echo $totalfive;?></span>
                </div>
                <div class="chart-flex">
                    <?php
                    //Display the total number of review
                    $foursql = "SELECT COUNT(*) totalfour FROM rating WHERE cour_id = '$cid' AND rate_course_value = 4";
                    $fourresult = mysqli_query($conn, $foursql);
                    $row = mysqli_fetch_assoc($fourresult);
                    $totalfour = $row['totalfour'];
                    
                    if($totalfour > 0){
                      $widthorange = (((($totalfour/$totalreview)*100)/100)*22.786);
                      echo '<style type = "text/css">
                              .bar-4 {
                                width: '.$widthorange.'vw;
                              }
                              </style>';
                    }else{
                      echo '<style type = "text/css">
                              .bar-4 {
                                width: 0vw;
                              }
                              </style>';
                    }
                    ?>
                    <span class="rating-num">4</span>
                    <div class="chart-bar">
                        <div class="orange-bar bar-4"></div>
                        <div class="grey-bar"></div>
                    </div>
                    <span class="rating-count"><?php echo $totalfour;?></span>
                </div>
                <div class="chart-flex">
                    <?php
                    //Display the total number of review
                    $threesql = "SELECT COUNT(*) totalthree FROM rating WHERE cour_id = '$cid' AND rate_course_value = 3";
                    $threeresult = mysqli_query($conn, $threesql);
                    $row = mysqli_fetch_assoc($threeresult);
                    $totalthree = $row['totalthree'];
                    
                    if($totalthree > 0){
                      $widthorange = (((($totalthree/$totalreview)*100)/100)*22.786);
                      echo '<style type = "text/css">
                              .bar-3 {
                                width: '.$widthorange.'vw;
                              }
                              </style>';
                    }else{
                      echo '<style type = "text/css">
                              .bar-3 {
                                width: 0vw;
                              }
                              </style>';
                    }
                    ?>
                    <span class="rating-num">3</span>
                    <div class="chart-bar">
                        <div class="orange-bar bar-3"></div>
                        <div class="grey-bar"></div>
                    </div>
                    <span class="rating-count"><?php echo $totalthree;?></span>
                </div>
                <div class="chart-flex">
                    <?php
                    //Display the total number of review
                    $twosql = "SELECT COUNT(*) totaltwo FROM rating WHERE cour_id = '$cid' AND rate_course_value = 2";
                    $tworesult = mysqli_query($conn, $twosql);
                    $row = mysqli_fetch_assoc($tworesult);
                    $totaltwo = $row['totaltwo'];
                    
                    if($totaltwo > 0){
                      $widthorange = (((($totaltwo/$totalreview)*100)/100)*22.786);
                      echo '<style type = "text/css">
                              .bar-2 {
                                width: '.$widthorange.'vw;
                              }
                              </style>';
                    }else{
                      echo '<style type = "text/css">
                              .bar-2 {
                                width: 0vw;
                              }
                              </style>';
                    }
                    ?>
                    <span class="rating-num">2</span>
                    <div class="chart-bar">
                        <div class="orange-bar bar-2"></div>
                        <div class="grey-bar"></div>
                    </div>
                    <span class="rating-count"><?php echo $totaltwo?></span>
                </div>
                <div class="chart-flex">
                    <?php
                    //Display the total number of review
                    $onesql = "SELECT COUNT(*) totalone FROM rating WHERE cour_id = '$cid' AND rate_course_value = 1";
                    $oneresult = mysqli_query($conn, $onesql);
                    $row = mysqli_fetch_assoc($oneresult);
                    $totalone = $row['totalone'];
                    
                    
                    if($totalone > 0){
                      $widthorange = (((($totalone/$totalreview)*100)/100)*22.786);
                      echo '<style type = "text/css">
                              .bar-1 {
                                width: '.$widthorange.'vw;
                              }
                              </style>';
                    }elseif($totalone<=0){
                      echo '<style type = "text/css">
                              .bar-1 {
                                width: 0vw;
                              }
                              </style>';
                    }
                    ?>
                    <span class="rating-num">1</span>
                    <div class="chart-bar">
                        <div class="orange-bar bar-1"></div>
                        <div class="grey-bar"></div>
                    </div>
                    <span class="rating-count"><?php echo $totalone;?></span>
                </div>
            </div>
        </div>
        <div class="student-ratings">
      <?php
      $sql = "SELECT * FROM rating r, student s WHERE (r.stud_id = s.stud_id) AND (r.cour_id = $cid) ORDER BY rate_date DESC";
      #echo $sql;
      $result = mysqli_query($conn, $sql);

      if(mysqli_num_rows($result) > 0){
            
      while ($row = mysqli_fetch_array($result)){
        $rating_date = strtotime($row['rate_date']);
        $convert_rating_date = date('Y/m/d', $rating_date);
      ?>
      
        <div class="rating-border">
          <div class="pic-name-date-rate">
            <img class="who-profile-pic" src="Images/<?php echo $row['stud_profile_picture']?>" alt="">
            <div class="username-and-rating">
              <div class="username-date">
                <span class="who-post"><?php echo $row['stud_first_name']?> <?php echo $row['stud_last_name'];?></span>
                <span class="post-date"><?php echo $convert_rating_date;?></span>
              </div>
              <div class="student-rating-star">
                <span><?php echo $row['rate_course_value']?></span><i class="fas fa-star"></i>
              </div>
            </div>
          </div>
          <p class="rating-comment"><?php echo $row['rate_comment']?></p>
        </div>
      
      <?php
        }
      }else{
      ?>
      <div class="tab-empty-state">
        <img src="Images/tab-empty-state.png" alt="">
        <p>Nothing here...</p>
      </div>
      <?php
        }
      ?>
    </div>
      </div>
                <?php 
                    }
                }
                ?>
            </section> 
            <section class="related-course">
                 <p class="related-title">Related Courses</p>
                 <div class="related-list">
                    <?php
                    //Display the selected course detail
                    $sql = "SELECT * ,(SELECT AVG(rate_course_value) FROM rating r WHERE (r.cour_id = c.cour_id)) AS avg_rating FROM course c, teacher t WHERE (c.teac_id = t.teac_id) AND cour_category = '$page_category' AND NOT(cour_id = '$cid') ORDER BY RAND() LIMIT 2";
                    $result = mysqli_query($conn, $sql);
                
                    if(mysqli_num_rows($result) > 0){
                    
                    while ($row = mysqli_fetch_array($result)){
                      $cour_rating = round($row['avg_rating'],1);
                        if(is_null($cour_rating)){
                            $cour_rating = 0;
                        }
                    ?>
                    <a class="course-link" href="enroll-course.php?cid=<?php echo $row['cour_id']?>">
                        <input type="hidden" name="teac_id" value="<?php echo $row['teac_id'];?>">
                        <input type="hidden" value="<?php echo $row['cour_id']?>">
                        <div class="course-card">
                            <img class="course-cover-pic" src="Images/<?php echo $row['cour_cover'];?>" alt="Course cover picture">
                            <p class="course-name"><?php echo $row['cour_name'];?></p>
                            <div class="teacher-star-flex">
                                <p class="course-teacher"><?php echo $row['teac_first_name'];?> <?php echo $row['teac_last_name']?></p>
                                <div class="rating-and-value">
                                    <img class="rating-star" src="Images/rating-star.png" alt="rating-star">
                                    <p class="rating-value"><?php echo $cour_rating?></p>
                                </div>
                            </div>
                            <p class="course-tag"><?php echo $row['cour_category'];?></p>
                        </div>
                    </a>
                    <?php 
                        }
                    }
                    ?>
                </div>
            </section>
        </div>
    </div>
    <?php include("footer.php");?>

    <script>
    // Get the modal
    var modal = document.getElementById("enroll-confirmation");
    
    // Get the button that opens the modal
    var btn = document.getElementById("enroll-btn");
    
    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];
    
    // When the user clicks the button, open the modal 
    btn.onclick = function() {
      modal.style.display = "block";
    }
    
    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
      modal.style.display = "none";
    }
    
    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }
    </script>
</body>
</html>