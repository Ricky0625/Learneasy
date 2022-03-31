<?php
include ("conn.php");
$quiz_id = $_GET['qid'];
$stud_id = $_GET['sid'];

$checkquiz = "SELECT * FROM quiz q, result r WHERE (q.quiz_id = r.quiz_id) AND (q.quiz_id = $quiz_id) AND (r.stud_id = $stud_id)";
$result = mysqli_query($conn, $checkquiz);    
if (mysqli_num_rows($result) > 0){
while($row = mysqli_fetch_array($result)){
    $delete = "DELETE FROM result WHERE quiz_id = $quiz_id AND stud_id = $stud_id";
    if (mysqli_query($conn, $delete)){
        $quiz_id = $row['quiz_id'];
        $stud_id = $row['stud_id'];
        echo '<script> window.location.href="Student-QuizForm.php?qid='.$quiz_id.' &sid='.$stud_id.'"; </script>';
    }
}} else {
    $quiz_id = $quiz_id;
    $stud_id = $stud_id;
    echo '<script> window.location.href="Student-QuizForm.php?qid='.$quiz_id.' &sid='.$stud_id.'"; </script>';
}




?>