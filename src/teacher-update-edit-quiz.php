<?php
include "conn.php";

$quiz_id = $_POST['quiz_id'];
$quiz_title = $_POST['quiz_title'];
$quiz_timer = $_POST['quiz_timer'];

$sql = "UPDATE quiz SET quiz_title ='$quiz_title', quiz_timer ='$quiz_timer' WHERE quiz_id = $quiz_id";

if (mysqli_query($conn, $sql)) {
    $quiz_id = $_POST['quiz_id'];
    echo '<script>alert("Successfully updated quiz")</script>';
    echo '<script> window.location.href="teacher-edit-quiz-question.php?qid='.$quiz_id.'"; </script>';

    }else{
    $quiz_id = $_POST['quiz_id'];
    echo '<script>alert("Failed to edit quiz")</script>';
    echo '<script> window.location.href="teacher-update-edit-quiz.php?qid='.$quiz_id.'"; </script>';
}
?>