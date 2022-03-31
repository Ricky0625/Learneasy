<?php
session_start();
require("conn.php");

//Get the selected course id
$selected_cid = $_GET['cid'];

//Get the logged user's username
if(isset($_SESSION['logged_username'])){
    $logged_username =  $_SESSION['logged_username'];
    //User the logged user's username to find his/her id
    $finduid_sql = "SELECT stud_id FROM student WHERE stud_username = '$logged_username' LIMIT 1";
    $result = mysqli_query($conn, $finduid_sql);
    $row = mysqli_fetch_array($result);
    $target_uid = $row['stud_id'];

    //Use the course id and user id to find the user already enroll in the selected course or not
    $checkenroll_sql ="SELECT * FROM enrolment WHERE cour_id = '$selected_cid' AND stud_id = '$target_uid' LIMIT 1";
    $result = mysqli_query($conn, $checkenroll_sql);
    if(mysqli_num_rows($result) > 0){
        echo '<script type="text/javascript">location.href = "course-content.php?cid='."$selected_cid".'";</script>';
    }else {
        echo '<script type="text/javascript">location.href = "enroll-course.php?cid='."$selected_cid".'";</script>';
    }
}else{
    echo '<script type="text/javascript">location.href = "enroll-course.php?cid='."$selected_cid".'";</script>';
}
?>