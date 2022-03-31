<?php
$logged_user = $_SESSION['logged_username'];
$sql_user = "SELECT * FROM student WHERE stud_username = '$logged_user'";
$result = mysqli_query($conn, $sql_user);
$row = mysqli_fetch_array($result);
$uid = $row['stud_id'];
$user_profile = $row['stud_profile_picture'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="course-tab.css">
  <link rel="stylesheet" href="rating.css">
  <script src="https://kit.fontawesome.com/8e94eefdff.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <title>Document</title>
</head>
<body>
  <div class="course-tabs">
    <div class="tab">
      <button class="tablinks" onclick="openCity(event, 'about')" id="defaultOpen">About</button>
      <button class="tablinks" onclick="openCity(event, 'ratings')">Ratings</button>
      <button class="tablinks" onclick="openCity(event, 'qna')">Q&A</button>
      <button class="tablinks" onclick="openCity(event, 'resource-quiz')">Resources & Quiz</button>
      <button class="tablinks" onclick="openCity(event, 'stud-progress')">Student Progress</button>
      <button class="tablinks" onclick="openCity(event, 'course-stats')">Statistics</button>
    </div>

  <section style="margin-bottom: 120px;">
    <div id="about" class="tabcontent">
      <div class="flexbox-for-about">
        <div class="about-course">
          <p class="tab-titles">About the class</p>
          <p class="tab-paragraph"><?php echo $about;?></p>
          <p class="tab-titles">Reminder</p>
          <p class="tab-paragraph">
          <b>1. Make use of the resources given by the teachers</b><br>
          Learneasy allows teacher to upload their own course resources for their student to use as extra study materials. Make sure you can make big use of these resources to enhance your understanding of the course!<br><br>
          <b>2. Be friendly, be helpful</b><br>
          To let our students to have more interaction with teachers and other learners, there will be Q&A section for every course. Make sure you also make good use of the Q&A, do not offend teacher and other learner in the Q&A section. Try to give as much help for other learners if you can!<br><br>
          <b>3. Do not spread hate comments in Q&A sections.</b><br>
          Learneasy is a platform which provides student to learn, to achieve new goals, not a platform to spread hate comments. Be responsible to what you post or say on the platform.<br><br>
          </p>
        </div>
        <div class="about-teacher">
          <div class="profile-and-name">
            <img src="Images/<?php echo $teac_profile;?>" alt="Teacher Profile Picture" title="">
            <a href="teacher-stud-profile.php?tid=<?php echo $tid?>" id="teacher-name" target="_NEW"><?php echo $teac_first_name;?> <?php echo $teac_last_name;?></a>
          </div>
          <p id="teacher-bio"><?php echo $teac_bio;?></p>
        </div>
      </div>
    </div>
    
    <div id="ratings" class="tabcontent">     
      <div class="en-course-rating">
        <div class="en-sec-title-btn">
          <span class="en-section-title">Course Reviews</span>
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
      </div>
      <div class="student-ratings">
      <?php
      $sql = "SELECT * FROM rating r, student s WHERE (r.stud_id = s.stud_id) AND (r.cour_id = $cid) ORDER BY rate_date DESC";
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
        ?>
    <div id="qna" class="tabcontent">
      <section class="qna-tab">
      <?php
      $sql = "SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_NAME = 'qna' AND TABLE_SCHEMA = 'learneasy';";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_array($result);
      $qna_id = $row['AUTO_INCREMENT'];

      if(isset($_POST['post-question'])){
        $sql = "INSERT INTO qna(qna_id,cour_id) VALUES('$qna_id','$cid')";
        $qna_content =  $_POST['question-textfield'];
        if (mysqli_query($conn, $sql)){
          echo '<script type="text/javascript">location.href = "post-question.php?qna_id='.$qna_id.'&qna_content='.$qna_content.'&cid='.$cid.'";</script>';
        }else {
          echo '<script>alert("Oppss! Something wrong. Please try again.")</script>';
          header("location: course-content.php?cid=$cid");
      }
      }
      ?>
        <div class="question-form">
            <div class="qna-title-btn">
              <span class="qna-title">Q&A</span><input type="submit" value="Ask Question" id="post-question" name="post-question">
            </div>
        </div>
        <?php
        $num_of_qna_sql = "SELECT * FROM qna WHERE cour_id = '$cid'";
        $resultNum = mysqli_query($conn, $num_of_qna_sql);
        if($resultNum){
            
            $rowNum = mysqli_num_rows($resultNum);
    
            if($rowNum){
                $num_qna = $rowNum;
            }else{
                $num_qna = 0;
            }
            mysqli_free_result($resultNum);
        }
        ?>
        <p class="question-count"><?php echo $num_qna;?> Questions</p>
        <div class="question-list">
          <?php
          $sql = "SELECT * FROM qna_question z, qna q WHERE (z.qna_id = q.qna_id) AND (q.cour_id = $cid)";
          $result = mysqli_query($conn, $sql);
          if(mysqli_num_rows($result) > 0){
            while ($row = mysqli_fetch_array($result)){
              $ques_id = $row['ques_id'];

          //The number of reply of this question
          $sql = "SELECT COUNT(ans_id) AS max_reply FROM answer WHERE ques_id = '$ques_id'";
          $result = mysqli_query($conn, $sql);
          $row = mysqli_fetch_array($result);
          $max_reply = $row['max_reply'];
          if($max_reply == 0){
            $max_reply = 0;
          }

          //Display the selected course detail
          $sql = "SELECT * FROM qna_question z, qna q, student s WHERE (q.qna_id = z.qna_id) AND (z.stud_id = s.stud_id) AND (q.cour_id = '$cid') ORDER BY ques_id DESC";
          $result = mysqli_query($conn, $sql);
          if(mysqli_num_rows($result) > 0){
            
          while ($row = mysqli_fetch_array($result)){
            $ques_id = $row['ques_id'];
            $post_date = strtotime($row['ques_post_date']);
            $convert_post_date = date('Y/m/d', $post_date);
          ?>
          <div class="question-template">
            <p><?php echo $row['ques_content'];?></p>
            <div class="post-info">
              <div class="post-flex">
                <img src="Images/<?php echo $row['stud_profile_picture'];?>" alt="">
                <div class="post-flex owner-date">
                  <span class="post-owner"><?php echo $row['stud_first_name'].' '.$row['stud_last_name']?></span>
                  <span class="post-date"><?php echo $convert_post_date;?></span>
                </div>  
              </div>
              <div class="post-flex comment-link">
                <a href="discussion.php?qid=<?php echo $ques_id?>&cid=<?php echo $cid?>" title="Click to view all replies."><i class="fas fa-comment-alt"></i></span></a>
              </div>  
            </div>
          </div>
          <hr class="question-list-hr">
          <?php
            }
          }
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
      </section>
    </div>
    <div id="resource-quiz" class="tabcontent">
      <section class="resource-quiz-section">
        <div class="resource-list">
          <p class="res-quiz-title">Resources</p>
          <p class="res-quiz-sub">Click on the name of the file to download.</p>
          <hr class="resource-hr">
          <?php
          //Display the selected course detail
          $ressql = "SELECT * FROM resources WHERE cour_id = '$cid'";
          $resresult = mysqli_query($conn, $ressql);
          if(mysqli_num_rows($resresult) > 0){
          
          while ($resrow = mysqli_fetch_array($resresult)){
          ?>
          <div class="resource-template">
            <div class="resource-file">
              <i class="fas fa-paperclip"></i>
              <a href="Documents/<?php echo $resrow['res_file']?>" download=""><?php echo $resrow['res_title'];?></a>
            </div>
            <hr class="resource-hr">
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
        <div class="quiz-list">
          <p class="res-quiz-title">Quiz</p>
          <div class="quiz-card-list">
          <?php
            //Display the selected course detail
            $quizsql = "SELECT *,(SELECT COUNT(quques_id) FROM quiz_question y WHERE (y.quiz_id = x.quiz_id)) AS total_ques FROM quiz x, course z, teacher t WHERE (x.cour_id = z.cour_id) AND (z.teac_id = t.teac_id) AND (x.cour_id = '$cid')";//Need to connect to quiz_question, course and teacher
            $quizresult = mysqli_query($conn, $quizsql);
            if(mysqli_num_rows($quizresult) > 0){
            
            while ($quizrow = mysqli_fetch_array($quizresult)){
              
              
            ?>
            <div class="quiz-card">
              <a class="link-to-course" href="Teacher-quizform.php?qid=<?php echo $quizrow['quiz_id']?>">
                <div class="quiz-pic-qs">
                  <img src="Images/<?php echo $quizrow['cour_cover']?>" alt="">
                  <span class="quiz-ques-num"><?php echo $quizrow['total_ques']?> Qs</span>
                </div>
                <div class="quiz-name-owner">
                  <p class="quiz-name"><?php echo $quizrow['quiz_title']?></p>
                  <div class="quiz-owner-author">
                    <img class="quiz-owner" src="Images/<?php echo $quizrow['teac_profile_picture']?>" alt="">
                    <span class="quiz-author"><?php echo $quizrow['teac_first_name'].' '.$quizrow['teac_last_name']?></span>
                  </div>
                </div>
              </a>
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
      </section>
    </div>

    <div id="stud-progress" class="tabcontent">
      <div class="progress-title-viewall">
        <p>Student Progress</p>
        <button onclick="location.href='progress-list?cid=<?php echo $cid?>'">View All</button>
      </div>
      <?php
      $sql = "SELECT * FROM enrolment e, student s WHERE (e.stud_id = s.stud_id) AND (e.cour_id = $cid)";
      $progresult = mysqli_query($conn, $sql);
      if(mysqli_num_rows($progresult) > 0){
      
      while ($row = mysqli_fetch_array($progresult)){
        $enroll_date = strtotime($row['enro_start_date']);
        $convert_enroll_date = date('Y/m/d', $enroll_date);
        $current_prog = $row['enro_progress'];
        $enro_id = $row['enro_id'];

        if($current_prog > 0){
          $prog_percentage = round(($current_prog/$totalcont),2);
          $prog_width = $prog_percentage*290;
          echo '<style type = "text/css">
                  .prog-stud-orange-bar-'.$enro_id.' {
                    position: absolute;
                    height: 30px;
                    width: '.$prog_width.'px;
                    background-color: #FF6B58;
                    border-radius: 5px;
                    text-align: center;
                    font-family: Nunito;
                    font-style: normal;
                    font-weight: normal;
                    font-size: 12px;
                    line-height: 16px;
                    color: #FFFFFF;
                    vertical-align: middle;
                    box-sizing: border-box;
                    padding: 8px;
                  }
                  </style>';
        }elseif($current_prog == 0){
          $prog_percentage = 0;
          echo '<style type = "text/css">
                  .prog-stud-orange-bar-'.$enro_id.' {
                    display:none;
                  }
                  </style>';
        }
      ?>
      <div class="prog-stud-info">
        <img src="Images/<?php echo $row['stud_profile_picture']?>" alt="student profile picture">
        <div class="prog-name">
          <p class="prog-stud-fullname"><?php echo $row['stud_first_name']?> <?php echo $row['stud_last_name'];?></p>
          <p class="prog-stud-username">@<?php echo $row['stud_username']?></p>
        </div>
        <p class="prog-stud-date">Enrolled date: <?php echo $convert_enroll_date?></p>
        <div class="progress-bars">
          <div class="prog-stud-bar">
            <div class="prog-stud-orange-bar-<?php echo $enro_id;?>"><?php echo ($prog_percentage*100);?>%</div>
            <div class="prog-stud-grey-bar"></div>
          </div>
        </div>
      </div>
      <hr class="progress-seperator">
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

    <div id="course-stats" class="tabcontent">
      <div class="stats-list">
        <?php
        $sql = "SELECT COUNT(*) AS total_enroll FROM enrolment WHERE cour_id = $cid";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $total_enroll = $row['total_enroll'];
        ?>
        <div class="total-stud-enroll stats-box">
          <p class="stats-label">Student Enrolled</p>
          <hr>
          <p class="stats-value"><?php echo $total_enroll?></p>
        </div>
        <?php
        $sql = "SELECT COUNT(cont_id) AS total_cont FROM course c, content x WHERE (c.cour_id = x.cour_id) AND (c.cour_id = $cid)";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $total_cont = $row['total_cont'];

        $sql = "SELECT COUNT(enro_id) AS total_complete FROM course c, enrolment e WHERE (c.cour_id = e.cour_id) AND (c.cour_id = $cid) AND (e.enro_progress = $total_cont)";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $total_complete = $row['total_complete'];

        $sql = "SELECT COUNT(stud_id) AS total_quiz FROM quiz q, result r WHERE (q.quiz_id = r.quiz_id) AND (q.cour_id = $cid)";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $total_quiz = $row['total_quiz'];
        ?>
        <div class="total-stud-complete stats-box">
          <p class="stats-label">Student Completed</p>
          <hr>
          <p class="stats-value"><?php echo $total_complete;?></p>
        </div>
        <div class="total-stud-enroll stats-box">
          <p class="stats-label">Done Quiz</p>
          <hr>
          <p class="stats-value"><?php echo $total_quiz?></p>
        </div>
      </div>
    </div>
    </section>  
  </div>
  <script>
    function openCity(evt, cityName) {
      var i, tabcontent, tablinks;
      tabcontent = document.getElementsByClassName("tabcontent");
      for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
      }
      tablinks = document.getElementsByClassName("tablinks");
      for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
      }
      document.getElementById(cityName).style.display = "block";
      evt.currentTarget.className += " active";
    }
    
    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
  </script>
</body>
</html>