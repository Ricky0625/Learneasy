<?php
session_start();
include "conn.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin-homepage.css">
    <link rel="icon" type="image/png" href="Images/Learneasy_favicon.png">
    <title>Admin Homepage</title>
</head>
<body>
   <?php include("admin-nav.php")?>

   <div class="homepage-container">
   <!--Welcome Messages and Display Admin Name-->
   <p class="admin-display-name">Welcome Back,
        <b><?php echo $_SESSION['adm_username']; ?></b>
   </p>

    <div class="statistics-box">
        <div class="first-row-stat-box">
            <?php 
                $student = "SELECT COUNT(*) AS totalstudents FROM student";
                $result = mysqli_query($conn, $student);
                $row = mysqli_fetch_assoc($result);
            ?>
            <div class="student-stat">
                <p>Total Students</p>
                <hr class="lines">
                <h2><?php echo $row['totalstudents']; ?></h2>
            </div>
            <?php 
                $teacher = "SELECT COUNT(*) AS totalteacher FROM teacher";
                $result = mysqli_query($conn, $teacher);
                $row = mysqli_fetch_assoc($result);
            ?>
            <div class="teacher-stat">
                <p>Total Teachers</p>
                <hr class="lines">
                <h2><?php echo $row['totalteacher']; ?></h2>
            </div>
            <?php 
                $student = "SELECT COUNT(*) AS student FROM student";
                $result = mysqli_query($conn, $student);
                $rowstudent = mysqli_fetch_assoc($result);
                $teacher = "SELECT COUNT(*) AS teacher FROM teacher";
                $result = mysqli_query($conn, $teacher);
                $rowteacher = mysqli_fetch_assoc($result);
                $totaluser = $rowstudent['student'] + $rowteacher['teacher'];
            ?>
            <div class="user-stat">
                <p>Total Users</p>
                <hr class="lines">
                <h2><?php echo $totaluser; ?></h2>
            </div>
        </div>
        <div class ="second-row-stat-box">
            <?php 
                $course = "SELECT COUNT(*) AS totalcourse FROM course";
                $result = mysqli_query($conn, $course);
                $row = mysqli_fetch_assoc($result);
            ?>
            <div class="course-stat">
                <p>Total Courses</p>
                <hr class="lines">
                <h2><?php echo $row['totalcourse']; ?></h2>
            </div>
            <?php 
                $quiz = "SELECT COUNT(*) AS totalquiz FROM quiz";
                $result = mysqli_query($conn, $quiz);
                $row = mysqli_fetch_assoc($result);
            ?>
            <div class="quizzes-stat">
                <p>Total Quizzes</p>
                <hr class="lines">
                <h2><?php echo $row['totalquiz']; ?></h2>
            </div>   
        </div>
    </div>

    <div class="category-course">
        <p>Courses by Category:</p>
            <?php 
                $business = "SELECT COUNT(*) AS business FROM course WHERE cour_category = 'business'";
                $result = mysqli_query($conn, $business);
                $row = mysqli_fetch_assoc($result);
            ?>
        <div class="business-cat">
            <h2>Business Courses: <b><?php echo $row['business']; ?> courses</b></h2>
        </div>
            <?php 
                $design = "SELECT COUNT(*) AS design FROM course WHERE cour_category = 'design'";
                $result = mysqli_query($conn, $design);
                $row = mysqli_fetch_assoc($result);
            ?>
        <div class="design-cat">
            <h2>Design Courses: <b><?php echo $row['design']; ?> courses</b></h2>
        </div>
            <?php 
                $IT = "SELECT COUNT(*) AS IT FROM course WHERE cour_category = 'IT'";
                $result = mysqli_query($conn, $IT);
                $row = mysqli_fetch_assoc($result);
            ?>
        <div class="IT-cat">
            <h2>IT Courses: <b><?php echo $row['IT']; ?> courses</b></h2>
        </div>
    </div>
   </div>

   <div class="admin-footer">
        <div class="foo-des">
            <p>Design and Develop by Win Yip, Ming En and Ricky - SDP Assignment</p>
        </div>
    </div>
</body>
</html> 