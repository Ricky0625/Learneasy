<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="mycourse.css">
    <link rel="icon" href="Images/LE_Favicon.png">
    <script src="https://kit.fontawesome.com/8e94eefdff.js" crossorigin="anonymous"></script>
    <title>My Course</title>
</head>
<body> 
    <?php include ("teacher-nav.php"); ?>

    <div class="course-page">
    <!--My course title bar-->
    <div class="title-bar">
        <div class="title-content">
            <!--My Course Title and Course search bar-->
            <div class="left-container">
                <p>My Course</p>
                <!--Course Search Bar-->
                <form class="input-search">
                     <input type="text" name="search" placeholder="Search your course here....." class="input-course">
                     <button type="submit" class="btn-course">
                        <i class="fa fa-search"></i>
                     </button>
                </form>
            </div>
            <!--Create Course and Filter button-->
            <div class="right-container">
                <!--Create Course button-->
                <div class="create-course-btn">
                    <a href="Teacher-CreateCourse.php">Create Course</a>
                </div>
                <!--Filter button filtered by A-Z course name-->
                <div class="filter-btn">
                    <button>Filter</button>
                </div>
            </div>
        </div>
    </div>

    <!--Course Content - Course Card-->
    <div class="course-container">
         <!--Course Card Teacher Site (My course)-->
        <div class="course-card">
            <!--Cource Cover-->
            <div class="course-cover">
                <img src="Images/course-cover.png">
            </div>
            <!--Course Content-->
            <div class="course-content">
                <!--Course Title-->
                <div class="course-title">
                    <p>Python Programming</p>
                    <button class="course-category">IT</button>
                </div>
                <!--Details Information such as teacher name and published date-->
                <div class="course-details">
                    <h2>Joshua Tech</h2>
                    <h3>Published Date : 18/12/2020</h3>
                    <!--Edit and Delete button-->
                    <div class="course-btn">
                        <div class="edit-btn">
                            <button onclick="location.href='#'">Edit</button>
                        </div>
                        <div class="delete-btn">
                            <button onclick="location.href='#'">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

           <!--Course Card Teacher Site (My course)-->
           <div class="course-card">
            <!--Cource Cover-->
            <div class="course-cover">
                <img src="Images/course-cover.png">
            </div>
            <!--Course Content-->
            <div class="course-content">
                <!--Course Title-->
                <div class="course-title">
                    <p>Python Programming</p>
                    <button class="course-category">IT</button>
                </div>
                <!--Details Information such as teacher name and published date-->
                <div class="course-details">
                    <h2>Joshua Tech</h2>
                    <h3>Published Date : 18/12/2020</h3>
                    <!--Edit and Delete button-->
                    <div class="course-btn">
                        <div class="edit-btn">
                            <button onclick="location.href='#'">Edit</button>
                        </div>
                        <div class="delete-btn">
                            <button onclick="location.href='#'">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

           <!--Course Card Teacher Site (My course)-->
           <div class="course-card">
            <!--Cource Cover-->
            <div class="course-cover">
                <img src="Images/course-cover.png">
            </div>
            <!--Course Content-->
            <div class="course-content">
                <!--Course Title-->
                <div class="course-title">
                    <p>Python Programming</p>
                    <button class="course-category">IT</button>
                </div>
                <!--Details Information such as teacher name and published date-->
                <div class="course-details">
                    <h2>Joshua Tech</h2>
                    <h3>Published Date : 18/12/2020</h3>
                    <!--Edit and Delete button-->
                    <div class="course-btn">
                        <div class="edit-btn">
                            <button onclick="location.href='#'">Edit</button>
                        </div>
                        <div class="delete-btn">
                            <button onclick="location.href='#'">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <?php include ("footer#"); ?>
</body>
</html>