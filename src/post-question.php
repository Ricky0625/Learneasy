<?php
session_start();
include("conn.php");

$stud_username = $_SESSION['logged_username'];

$sql = "SELECT * FROM student WHERE stud_username = '$stud_username'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$uid = $row['stud_id'];

$qna_id = $_GET['qna_id'];
$qna_content = $_GET['qna_content'];
$cid = $_GET['cid'];

$sql_question = "INSERT INTO qna_question(ques_id,ques_content,ques_post_date,stud_id,qna_id) VALUES(NULL,'$qna_content',now(),'$uid','$qna_id')";
if (mysqli_query($conn, $sql_question)){
    echo '<script>alert("Successfully post the question.")</script>';
    echo '<script type="text/javascript">location.href = "course-content.php?cid='.$cid.'";</script>';
  }else {
    echo '<script>alert("Oppss! Something wrong. Please try again.")</script>';
  }
?>