<?php
session_start();
header('Content-Type: text/html; charset=ISO-8859-1');
include "conn.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin-viewcourses.css">
    <link rel="icon" type="image/png" href="Images/Learneasy_favicon.png">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <title>Course Report</title>
</head>
<body>
    <?php include("admin-nav.php")?>

    <?php

    $cour_id = $_GET['cour_id'];

        $sql = "SELECT * FROM course c, teacher t WHERE (c.teac_id = t.teac_id) AND (c.cour_id = $cour_id)";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0){

        while ($row = mysqli_fetch_array($result)){
    ?>
    <div class="course-page-container">
        <div class="backbtn">
            <button onclick="goBack()"><i class="fas fa-caret-left"></i>Back</button>
        </div>
        <p class="course-page-title">Courses</p>

        <div class="details-container">
            <div class="display-out-all-from-database">
                <div class="top-box">
                    <div class="img-box">
                        <img class="course-cover-pic" src="Images/<?php echo $row["cour_cover"];?>" alt="Course cover picture">
                    </div>
                    <div class="course-info">
                        <h2>Course Name : <b><?php echo $row["cour_name"]; ?></b></h2>
                        <h2>Course Category : <b><?php echo $row["cour_category"]; ?></b></h2>
                        <h2>Course Created By : <b><?php echo $row["teac_first_name"]; ?>&nbsp;<?php echo $row["teac_last_name"]; ?></b></h2>
                    </div>
                </div>
                    <hr class="seperateline">
                <div class="bottom-box">
                    <h2>Course Description :</h2>
                        <div class="des-info">
                            <h2><?php echo $row["cour_description"]; ?></h2>
                        </div>
                    <h4>Course Created Date : <b><?php echo $row["cour_date"]; ?></b></h2>
                </div>

                <div class="button-class">
                    <a href="admin-course-content.php?cid=<?php echo $row['cour_id']?>"><button class="viewbtn" >View Course</button></a>
                    <a onclick="return confirm('Are you sure you want to delete?')" href="admin-deletecourse.php?cid=<?php echo $row['cour_id']?>"><button class="deletebtn" >Delete Course</button></a>
                    <button class="reportbtn" onclick="document.getElementById('course-stats').style.display='block'">Report</button>
                </div>
            </div>
        </div>
    </div>
    <?php
        }
      }
      ?>
      
    <div id="course-stats" class="modal">
        <div class="modal-content animate">
            <div class="container">
                <div class="stats-info-box">
                    <p>Course Statistics</p>
                    <div class="report">
                        <?php 
                            $enroll = "SELECT COUNT(*) AS totalenrollstudent FROM enrolment WHERE cour_id = $cour_id";
                            $result = mysqli_query($conn, $enroll);
                            $row = mysqli_fetch_assoc($result);
                        ?>
                        <div class="left-enroll-total">
                            <p>Total Students</p>
                            <hr class="lines">
                            <h2><?php echo $row['totalenrollstudent']; ?></h2>
                        </div>
                        <div class="right-list-student">
                            <table class="list">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Username</th>
                                        <th>Enrollment Start Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    include("conn.php");
                                    $sql= "SELECT * FROM enrolment e, student s WHERE (e.cour_id = $cour_id) AND (e.stud_id = s.stud_id)";
                                    $result = mysqli_query($conn, $sql);
                                    if(mysqli_num_rows($result) >0){

                                    while ($row = mysqli_fetch_array($result)){
                                    ?>
                                    <tr>
                                        <td><?php echo $row["stud_id"]; ?></td>
                                        <td><?php echo $row["stud_username"]; ?></td>
                                        <td><?php echo $row["enro_start_date"]; ?></td>
                                    </tr>
                                <?php
                                    }
                                }
                            ?>
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Get the modal
        var modal = document.getElementById('course-stats');

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>

    <script>
        //back button
        function goBack() {
        window.history.back();
        }
    </script>
</body>
</html>