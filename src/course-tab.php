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
    <?php
    //Display the total number of review
    
    ?>
    <div id="ratings" class="tabcontent">     
      <div class="en-course-rating">
        <div class="en-sec-title-btn">
          <span class="en-section-title">How students rated this course</span>
          <button id="give-rating-btn" type="button">Give Rating</button>
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
        <!-- The Modal -->
        <div id="rating-modal" class="rating-modal-overall">
            <!-- Modal content -->
            <div class="rating-modal-content">
                <div class="rating-modal-top-banner">
                    <div class="rating-modal-close-and-title">
                        <span class="close-rating-modal close-modal" title="Close"></span>
                        <p>Give Rating</p>
                    </div>
                </div>
                <form method = "POST" name="rating-modal-form" action = "insert-update-rating.php"  >
                    <!--To post the teacher id , student id and course id to rating php for record purpose-->
                    <input type="hidden" name="teac_id" value="<?php echo $tid ?>">
                    <input type="hidden" name="stud_id" value="<?php echo $uid;?>">
                    <input type="hidden" name="cour_id" value="<?php echo $cid;?>">
                    <!-- Teacher rating part -->
                    <div class="teacher-rating-section">
                        <div class="teacher-profile-pics">
                            <img id="teacher-modal-profile-pic" src="Images/<?php echo $teac_profile?>" alt="">
                        </div>
                        <!-- Words  for Teacher rating part -->
                        <div class="teacher-rating-words">
                            <h2>How was your experience with <?php echo $teac_first_name?> <?php echo $teac_last_name?>?</h2>
                            <p>Your feedback matters</p>
                        </div>
                        <!-- Rating Star -->
                        <div class="rating-star-icon">
                            <input type="radio" name ="rate_teacher_value" id="star1" value="5" required="choose 1"><label for ="star1"></label>
                            <input type="radio" name ="rate_teacher_value" id="star2" value="4" required><label for ="star2"></label>
                            <input type="radio" name ="rate_teacher_value" id="star3" value="3" required><label for ="star3"></label>
                            <input type="radio" name ="rate_teacher_value" id="star4" value="2" required><label for ="star4"></label>
                            <input type="radio" name ="rate_teacher_value" id="star5" value="1" required><label for ="star5"></label>
                        </div>
                    </div>
                    <hr class="rating-modal-seperateline">
                    <!-- Course rating part -->
                    <div class="course-rating-section">
                        <p class="course-rating-title">Course Rating</p>
                        <div class="course-rating-detail">
                            <p class="course-rating-name"><?php echo $cour_name; ?> </p>
                            <p class="course-rating-tag"><?php echo $course_cat; ?></p>
                            <p class="course-rating-pubs-date">Published Date : <?php echo $convert_create_date?></p>
                            <div class="rating-star-icon" id="course-rating-star">
                                <input type="radio" name ="rate_course_value" id="course-star1" value="5" required><label for ="course-star1"></label>
                                <input type="radio" name ="rate_course_value" id="course-star2" value="4" required><label for ="course-star2"></label>
                                <input type="radio" name ="rate_course_value" id="course-star3" value="3" required><label for ="course-star3"></label>
                                <input type="radio" name ="rate_course_value" id="course-star4" value="2" required><label for ="course-star4"></label>
                                <input type="radio" name ="rate_course_value" id="course-star5" value="1" required><label for ="course-star5"></label>
                            </div>
                        </div>
                    </div>
                    <!-- Comment box part -->
                    <div class="rating-comment-box">
                        <p class="rating-comment-box-title">Write a comment :</p>
                        <textarea name="rate_comment" id="" cols="30" rows="8" required></textarea>
                    </div>
                    <div class="submit-rating">
                        <button  title="Submit rating" id="submit" >Submit</button>
                    </div>
                </form>
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
          <form action="course-content.php?cid=<?php echo $cid?>" method="POST">
            <div class="qna-title-btn">
              <span class="qna-title">Q&A</span><input type="submit" value="Ask Question" id="post-question" name="post-question">
            </div>
            <textarea name="question-textfield" id="ask-question" cols="30" rows="10" placeholder="Ask your question here..." onfocus="hideBtn()" required></textarea>
          </form>
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
          $sql = "SELECT * FROM qna_question";
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
              <a class="link-to-course" href="check.php?qid=<?php echo $quizrow['quiz_id']?>&sid=<?php echo $uid?>">
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

  <script>
    const askquestionBtn = document.getElementById("post-question");
    const textarea = document.getElementById("ask-question")

    textarea.addEventListener("focus", function(){
        askquestionBtn.style.display = "block";
    });

    textarea.addEventListener("focusout", function(){
      if(textarea.value == ""){
        askquestionBtn.style.display = "none";
      }
      else{
        askquestionBtn.style.display = "block";
      }
        
    });

  </script>

    <script>
    // Get the modal
        var modal = document.getElementById("rating-modal");

    // Get the button that opens the modal
        var btn = document.getElementById("give-rating-btn");

    // Get the <span> element that close-modals the modal
        var span = document.getElementsByClassName("close-modal")[0];
        
    // When the user clicks the button, open the modal 
        btn.onclick = function () {
            modal.style.display = "block";
        }
    
    // When the user clicks on <span> (x), close-modal the modal
        span.onclick = function () {
            modal.style.display = "none";
        }
    
    // When the user clicks anywhere outside of the modal, close-modal it
        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>
</html>