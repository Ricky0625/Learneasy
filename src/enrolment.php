<?php
session_start();
include("conn.php");

if(isset($_POST['confirm-enroll'])){
    if($_POST['sid'] === ""){
        echo '<script>alert("Opps, please log in first before you enroll courses.");</script>';
        echo '<script type="text/javascript">location.href = "Student-SignIn.php";</script>';
    }else{
        $cid = $_POST['cid'];
        $sid =  $_POST['sid'];
        $enrolment_sql = "INSERT INTO enrolment(enro_id, enro_start_date, cour_id, stud_id) VALUES(NULL, now(), '$cid', '$sid')";
        if (mysqli_query($conn, $enrolment_sql)){
            echo '<script>alert("Successfully enroll the course!");</script>';
            echo '<script type="text/javascript">location.href = "student-home.php";</script>';
        }else {
            echo '<script>alert("Oppss! Something wrong. Please try again.")</script>';
            header("location: enroll-course.php?cid=$cid");
        }
    }   
}

if(isset($_POST['confirm-unenroll'])){
    $enro_id = $_POST['enro_id'];

    $sql = "SELECT COUNT(prog_id) AS progress_count FROM progress WHERE (enro_id = $enro_id)";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $progress = $row['progress_count'];
    
    if($progress == 0){
        $unenrolment_sql = "DELETE FROM enrolment WHERE enro_id = $enro_id";
        if (mysqli_query($conn, $unenrolment_sql)){
            echo '<script>alert("The course has been removed from your list.");</script>';
            echo '<script type="text/javascript">location.href = "student-home.php";</script>';
        }else {
            echo '<script>alert("Oppss! Something wrong. Please try again.")</script>';
            echo '<script type="text/javascript">location.href = "student-home.php";</script>';
        }
    }else{
        $unenrolment_sql = "DELETE enrolment, progress FROM enrolment INNER JOIN progress WHERE (enrolment.enro_id = progress.enro_id) AND (enrolment.enro_id = $enro_id)";
        if (mysqli_query($conn, $unenrolment_sql)){
            echo '<script>alert("The course has been removed from your list.");</script>';
            echo '<script type="text/javascript">location.href = "student-home.php";</script>';
        }else {
            echo '<script>alert("Oppss! Something wrong. Please try again.")</script>';
            echo '<script type="text/javascript">location.href = "student-home.php";</script>';
        }
    }
}
?>