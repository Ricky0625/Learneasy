<?php
include "conn.php";

$cour_id = $_POST['cour_id'];
$qt = $_POST['quiz_title'];
$sql = 'INSERT INTO quiz(quiz_title, quiz_timer, quiz_create_date, cour_id) VALUES ("'.$_POST['quiz_title'].'","'.$_POST['quiz_timer'].'","'.$_POST['quiz_create_date'].'","'.$_POST['cour_id'].'")';
if (mysqli_query($conn, $sql)) {
    $cour_id = $_POST['cour_id'];
    echo '<script>alert("Successfully added your quiz")</script>';
    echo '<script> window.location.href="quizquestion.php?cid='.$cour_id.'&qt='.$qt.'";</script>';
    }else{
    $cour_id = $_POST['cour_id'];
    echo '<script>alert("Failed to add your quiz")</script>';
    echo '<script> window.location.href="createquiz.php?cid='.$cour_id.'";</script>';
    }

?>