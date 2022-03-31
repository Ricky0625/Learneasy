<?php
include "conn.php";

$quiz_id = $_GET['qid'];

$deletequiz = "DELETE FROM quiz WHERE quiz_id = $quiz_id";

if(mysqli_query($conn, $deletequiz)){
    $deletequestion = "DELETE FROM quiz_question WHERE quiz_id = $quiz_id";
    if(mysqli_query($conn, $deletequestion)){
        echo '<script>alert("Quiz Has Been Deleted.")</script>';
	    echo '<script>window.location.href="mycourse.php"</script>';
    } else {
        $quiz_id = $_GET['quiz_id'];
        echo '<script>alert("Failed to delete quiz")</script>';
	    echo '<script>window.location.href="mycourse.php?qid= '.$quiz_id.'"</script>';
    }
}
?>