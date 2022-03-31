<?php
session_start();
include("conn.php");

if(isset($_POST['add-answer'])){
    $qid = $_GET['qid'];
    $cid = $_GET['cid'];

    $user_id = $_POST['user-id'];
    $reply = $_POST['answer-reply'];
    $new_reply = str_replace(array("'", "\""), "&lsquo;", htmlspecialchars($reply));

    if(isset($_SESSION['logged_username'])){
        $sid = $user_id;
    }else{
        $tid = $user_id;
    }

    if(isset($sid)){
        $sql = "INSERT INTO answer(ans_id, ans_content, ans_date, ques_id, stud_id, teac_id) VALUES(NULL, '$new_reply', now(), '$qid', '$sid', NULL)";
        
        if (mysqli_query($conn, $sql)){
            echo '<script>alert("Answer Added!")</script>';
            echo '<script type="text/javascript">location.href = "discussion?qid='.$qid.'&cid='.$cid.'";</script>';
        }else {
            echo '<script>alert("Oppss! Something wrong. Please try again.")</script>';
            echo '<script type="text/javascript">location.href = "discussion.php?qid='.$qid.'&cid='.$cid.'";</script>';
        }
    }else{
        $sql = "INSERT INTO answer(ans_id, ans_content, ans_date, ques_id, stud_id, teac_id) VALUES(NULL, '$new_reply', now(), '$qid', NULL, '$tid')";
        
        if (mysqli_query($conn, $sql)){
            echo '<script>alert("Answer Added!")</script>';
            echo '<script type="text/javascript">location.href = "discussion?qid='.$qid.'&cid='.$cid.'";</script>';
        }else {
            echo '<script>alert("Oppss! Something wrong. Please try again.")</script>';
            echo '<script type="text/javascript">location.href = "discussion.php?qid='.$qid.'&cid='.$cid.'";</script>';
        }
    }
    
    
}
?>