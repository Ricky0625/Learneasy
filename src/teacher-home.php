<?php
session_start();
if(!isset($_SESSION['logged_teacher'])){
    echo '<script>alert("You must log in to your account first.")</script>';
    echo '<script>location.href="Student-SignIn.php"</script>';
}
include("conn.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="course-card.css">
    <link rel="stylesheet" href="teacher-home.css">
    <link rel="icon" type="image/png" href="Images/Learneasy_favicon.png">
    <title>Learneasy - Teacher</title>
</head>
<body>
    <?php include("teacher-nav.php");?>
    <?php
    //echo the first name and last name of the user
    $logged_teac = $_SESSION['logged_teacher'];
    $sql = "SELECT * FROM teacher where teac_username = '$logged_teac' LIMIT 1";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
      
    while ($row = mysqli_fetch_array($result)){
    $teac_id = $row['teac_id'];
    $teac_fname = $row['teac_first_name'];
    $teac_lname = $row['teac_last_name'];
    //echo $_SESSION['logged_stud_id'];
    ?>
    <div class="welcome-banner">
        <span class="greeting-quote">Welcome Back, <span class="greeting-teacher-name"><?php echo $row['teac_first_name'];?> <?php echo $row['teac_last_name'];?></span>.</span>
    </div>
    <?php 
        }
    }
    ?>
    <div class="create-course-hero">
        <video src="Images/e-learning.mp4" autoplay loop></video>
        <div class="hero-title-button">
            <p>Start your online class right now.</p>
            <a href="verified-or-not.php">Create Course</a>
        </div>
    </div>
    <div class="my-course">
        <p class="mycourse-title">My Course</p>
        <div class="create-course-button">
            <a href="mycourse.php" class="view-more-mycourse">View More</a>
        </div>
        <section class="teacher-course-list">
            <?php
            $sql = "SELECT * ,(SELECT AVG(rate_course_value) FROM rating r WHERE (r.cour_id = c.cour_id)) AS avg_rating FROM course c WHERE teac_id = $teac_id LIMIT 8";
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) > 0){
      
                while ($row = mysqli_fetch_array($result)){
                    $cour_rating = round($row['avg_rating'],1);
                        if(is_null($cour_rating)){
                            $cour_rating = 0;
                        }
            ?>
            <a class="course-link" href="teacher-content.php?cid=<?php echo $row['cour_id']?>">
                <div class="course-card">
                    <img class="course-cover-pic" src="Images/<?php echo $row['cour_cover']?>" alt="Course cover picture">
                    <p class="course-name"><?php echo $row['cour_name']?></p>
                    <div class="teacher-star-flex">
                        <p class="course-teacher"><?php echo $teac_fname.' '.$teac_lname;?></p>
                        <div class="rating-and-value">
                            <img class="rating-star" src="Images/rating-star.png" alt="rating-star">
                            <p class="rating-value"><?php echo $cour_rating?></p>
                        </div>
                    </div>
                    <p class="course-tag"><?php echo $row['cour_category']?></p>
                </div>
            </a>
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
        </section>
    </div>
    <?php include("footer.php")?>
</body>
</html>