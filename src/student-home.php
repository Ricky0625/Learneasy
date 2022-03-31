<?php
session_start();

if(!isset($_SESSION['logged_username'])){
    echo '<script>alert("You must log in to your account first.")</script>';
    echo '<script>location.href="Student-SignIn.php"</script>';
}
include("conn.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="in-progress-card.css">
    <link rel="stylesheet" href="student-home.css">
    <link rel="stylesheet" href="course-card.css">
    <link rel="stylesheet" href="confirmation.css">
    <link rel="icon" href="Images/LE_Favicon.png">
    <script src="https://kit.fontawesome.com/8e94eefdff.js" crossorigin="anonymous"></script>
    <title>Student Home</title>
</head>
<body>
    <?php include("nav.php")?>

    <?php
    //echo the first name and last name of the user
    $logged_stud = $_SESSION['logged_username'];
    $sql = "SELECT * FROM student where stud_username = '$logged_stud' LIMIT 1";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
      
    while ($row = mysqli_fetch_array($result)){
    $stud_id = $row['stud_id'];
    //echo $_SESSION['logged_stud_id'];
    ?>
    <div class="sh-greetings">
        <span class="sh-greetings-dummy">Welcome Back, </span><span class="student-name-sh"><?php echo $row['stud_first_name'];?> <?php echo $row['stud_last_name'];?>.</span>
    </div>
    <?php 
        }
    }
    ?>

    <div class="student-home-tab">
      <button class="tablinks" onclick="openCity(event, 'home')" id="defaultOpen">Home</button>
      <button class="tablinks" onclick="openCity(event, 'in-progress')">In Progress</button>
      <button class="tablinks" onclick="openCity(event, 'completed')">Completed</button>
    </div>
    
    <div id="home" class="tabcontent">
      <p class="home-tab-title">Courses</p>
      <div class="course-section">
        <div class="section-flex">  
            <p class="category-name-sh">Business</p>
            <a class="view-more-course" href="course-category.php?get_category=business">View More</a>
        </div>
        <div class="course-list-sh">
        <?php
        //echo the business course
        $sql = "SELECT *,(SELECT AVG(rate_course_value) FROM rating r WHERE (r.cour_id = c.cour_id)) AS avg_rating FROM course c, teacher t WHERE (c.teac_id = t.teac_id) AND (c.cour_category = 'business') ORDER BY RAND() LIMIT 4";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0){
        
        while ($row = mysqli_fetch_array($result)){
            $cour_rating = round($row['avg_rating'],1);
            if(is_null($cour_rating)){
                $cour_rating = 0;
            }
        ?>
            <a class="course-link" href="enrolled-or-not.php?cid=<?php echo $row['cour_id'];?>">
                <div class="course-card">
                    <input type="hidden" name="teac_id" value="<?php echo $row['teac_id'];?>">
                    <img class="course-cover-pic" src="Images/<?php echo $row['cour_cover'];?>" alt="Course cover picture">
                    <p class="course-name"><?php echo $row['cour_name'];?></p>
                    <div class="teacher-star-flex">
                        <p class="course-teacher"><?php echo $row['teac_first_name'];?> <?php echo $row['teac_last_name'];?></p>
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
      </div>
      <div class="course-section">
        <div class="section-flex">  
            <p class="category-name-sh">Design</p>
            <a class="view-more-course" href="course-category.php?get_category=design">View More</a>
        </div>
            <div class="course-list-sh">
            <?php
            //echo the design course
            $sql = "SELECT *,(SELECT AVG(rate_course_value) FROM rating r WHERE (r.cour_id = c.cour_id)) AS avg_rating FROM course c, teacher t WHERE (c.teac_id = t.teac_id) AND (c.cour_category = 'Design') ORDER BY RAND() LIMIT 4";
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) > 0){
            
            while ($row = mysqli_fetch_array($result)){
                $cour_rating = round($row['avg_rating'],1);
                if(is_null($cour_rating)){
                    $cour_rating = 0;
                }
            ?>
                <a class="course-link" href="enrolled-or-not.php?cid=<?php echo $row['cour_id'];?>">
                    <div class="course-card">
                        <input type="hidden" name="teac_id" value="<?php echo $row['teac_id'];?>">
                        <img class="course-cover-pic" src="Images/<?php echo $row['cour_cover'];?>" alt="Course cover picture">
                        <p class="course-name"><?php echo $row['cour_name'];?></p>
                        <div class="teacher-star-flex">
                            <p class="course-teacher"><?php echo $row['teac_first_name'];?> <?php echo $row['teac_last_name'];?></p>
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
      </div>
      <div class="course-section">
        <div class="section-flex">  
            <p class="category-name-sh">IT</p>
            <a class="view-more-course" href="course-category.php?get_category=it">View More</a>
        </div>
        <div class="course-list-sh">
            <?php
            //echo the design course
            $sql = "SELECT *,(SELECT AVG(rate_course_value) FROM rating r WHERE (r.cour_id = c.cour_id)) AS avg_rating FROM course c, teacher t WHERE (c.teac_id = t.teac_id) AND (c.cour_category = 'IT') ORDER BY RAND() LIMIT 4";
            
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) > 0){
            
            while ($row = mysqli_fetch_array($result)){
                $cour_rating = round($row['avg_rating'],1);
                if(is_null($cour_rating)){
                    $cour_rating = 0;
                }
            ?>
            <a class="course-link" href="enrolled-or-not.php?cid=<?php echo $row['cour_id'];?>">
                <div class="course-card">
                    <input type="hidden" name="teac_id" value="<?php echo $row['teac_id'];?>">
                    <img class="course-cover-pic" src="Images/<?php echo $row['cour_cover'];?>" alt="Course cover picture">
                    <p class="course-name"><?php echo $row['cour_name'];?></p>
                    <div class="teacher-star-flex">
                        <p class="course-teacher"><?php echo $row['teac_first_name'];?> <?php echo $row['teac_last_name'];?></p>
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
      </div>
    </div>
    
    <!--In progress courses-->
    <div id="in-progress" class="tabcontent" style="padding: 36px 120px;">
      <div class="in-progress-list">
        <?php
        $in_progress_sql = "SELECT * FROM enrolment LEFT JOIN course ON (course.cour_id = enrolment.cour_id) LEFT JOIN teacher ON (course.teac_id = teacher.teac_id) WHERE enrolment.stud_id = '$stud_id' AND enrolment.enro_progress < (SELECT COUNT(cont_id) AS count_cont_num FROM content x, course y WHERE (x.cour_id = y.cour_id) AND (x.cour_id = enrolment.cour_id))";
        $result = mysqli_query($conn, $in_progress_sql);
        if(mysqli_num_rows($result) > 0){
            $modal_index = 0;
        while($row = mysqli_fetch_array($result)){
            $start_date = strtotime($row['enro_start_date']);
            $convert_start_date = date('Y/m/d', $start_date);
        ?>
        <div class="enrolled-card">
            <img src="Images/<?php echo $row['cour_cover'];?>" alt="">
            <div class="enrolled-course-info">
                <a href="enrolled-or-not.php?cid=<?php echo $row['cour_id'];?>"><p class="enrolled-course-name"><?php echo $row['cour_name']; ?></p></a><br><br>
                <p class="enrolled-course-teacher"><?php echo $row['teac_first_name'].' '.$row['teac_last_name']?></p>
                <p class="enrolled-date">Enrolled Date: <?php echo $convert_start_date;?></p>
                <!--<p class="enrolled-date">Completed Date: -</p>-->
                <div class="en-tags-unenroll">
                    <span class="in-progress-tag">In Progress</span>
                    <button class="unenroll-btn" data-modal="unenroll-confirmation-<?php echo $modal_index;?>">Unenroll</button>
                </div>
            </div>
        </div>
        <!-- The Modal -->
        <div id="unenroll-confirmation-<?php echo $modal_index;?>" class="modal">
                <!-- Modal content -->
                <div class="modal-content">
                    <div class="confirm-left">
                        <p class="top-label">:(</p>
                        <p class="bottom-label">Are you sure you want to unenroll this course?</p>
                        <form action="enrolment.php" method="POST">
                            <input type="hidden" value="<?php echo $row['enro_id'];?>" name="enro_id">
                            <p class="unenroll-course-name">"<?php echo $row['cour_name']?>"</p>
                            <div class="cancel-ok">
                                <input type="submit" class="confirm-enroll" value="Yes" name="confirm-unenroll">
                                <button type="button" class="close" style="margin-left: 12px" data-modal="unenroll-confirmation-<?php echo $modal_index;?>">No</button>
                            </div>
                        </form>
                    </div>
                    <div class="confirm-right">
                        <img src="Images/unenroll-confirmation.png" alt="Unenroll">
                    </div>
                </div>
            </div>
        <?php
            $modal_index++;
            }
        }
        else{//Empty State
        ?>
        <div class="in-progress-empty">
            <img src="Images/in-progress-empty.png" alt="No In Progress Courses">
            <p class="empty-top-p">So empty in here</p>
            <p class="empty-bel-p">I wonder what this button does...</p>
            <button type="button" onclick="location.href='course-category.php?get_category=all'"><i class="fas fa-search"></i></button>
        </div>
        <?php
        }
        ?>
      </div>
    </div>

    <div id="completed" class="tabcontent" style="padding: 36px 120px;">
      <div class="completed-list">
        <?php
        $complete_sql = "SELECT * FROM enrolment LEFT JOIN course ON (course.cour_id = enrolment.cour_id) LEFT JOIN teacher ON (course.teac_id = teacher.teac_id) WHERE enrolment.stud_id = '$stud_id' AND enrolment.enro_progress = (SELECT COUNT(cont_id) FROM content x, course y WHERE (x.cour_id = y.cour_id) AND (x.cour_id = enrolment.cour_id))";
        
        $result = mysqli_query($conn, $complete_sql);
        if(mysqli_num_rows($result) > 0){
            $modal_index = 0;
        while($row = mysqli_fetch_array($result)){
            $start_date = strtotime($row['enro_start_date']);
            $convert_start_date = date('Y/m/d', $start_date);
        ?>
        <div class="enrolled-card">
            <img src="Images/<?php echo $row['cour_cover']?>" alt="">
            <div class="enrolled-course-info">
                <a href="enrolled-or-not.php?cid=<?php echo $row['cour_id'];?>"><p class="enrolled-course-name"><?php echo $row['cour_name']?></p></a>
                <p class="enrolled-course-teacher"><?php echo $row['teac_first_name'].' '.$row['teac_last_name']?></p>
                <p class="enrolled-date">Enrolled Date: <?php echo $row['enro_start_date']?></p>
                <p class="enrolled-date">Completed Date: <?php echo $row['enro_end_date']?></p>
                <div class="en-tags-unenroll">
                    <span class="completed-tag">Completed</span>
                    <button class="certificate-btn" onclick="location.href='certificate.php?cid=<?php echo $row['cour_id']?>'">Get Certificate</button>
                </div>
            </div>
        </div>
        <?php
            }
        }
        else{//Empty State
        ?>
        <div class="in-progress-empty">
            <img src="Images/in-progress-empty.png" alt="No In Progress Courses">
            <p class="empty-top-p"></p>
            <p class="empty-bel-p">No completed course...</p>
        </div>
        <?php
        }
        ?>
      </div>
    </div>
    <?php include("footer.php")?>
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
    var btn = document.getElementsByClassName("unenroll-btn");
    var span = document.getElementsByClassName("close");

    for (var i = 0; i < btn.length; i++) {
        var thisBtn = btn[i];
        thisBtn.addEventListener("click", function(){
            var modal = document.getElementById(this.dataset.modal);
            modal.style.display = "block";
        }, false);
    }

    for (var i = 0; i < span.length; i++) {
        var thisSpan = span[i];
        thisSpan.addEventListener("click", function(){
            var modal = document.getElementById(this.dataset.modal);
            modal.style.display = "none";
        }, false);
    }

    </script>
</body>
</html>