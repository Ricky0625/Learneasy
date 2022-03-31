<?php
include ("conn.php");

/*get the quiz_id*/
$quiz_id = $_POST['quiz_id'];
$stud_id = $_POST['stud_id'];

/*get the questions number*/
$ques1 = $_POST['quques_number1'];
$ques2 = $_POST['quques_number2'];
$ques3 = $_POST['quques_number3'];
$ques4 = $_POST['quques_number4'];
$ques5 = $_POST['quques_number5'];

/*get the choices value*/
$A1 = $_POST['1A'];
$B1 = $_POST['1B'];
$C1 = $_POST['1C'];
$D1 = $_POST['1D'];

$A2 = $_POST['2A'];
$B2 = $_POST['2B'];
$C2 = $_POST['2C'];
$D2 = $_POST['2D'];

$A3 = $_POST['3A'];
$B3 = $_POST['3B'];
$C3 = $_POST['3C'];
$D3 = $_POST['3D'];

$A4 = $_POST['4A'];
$B4 = $_POST['4B'];
$C4 = $_POST['4C'];
$D4 = $_POST['4D'];

$A5 = $_POST['5A'];
$B5 = $_POST['5B'];
$C5 = $_POST['5C'];
$D5 = $_POST['5D'];

$checkanswer = "SELECT * FROM quiz_question WHERE quiz_id = $quiz_id";
$result = mysqli_query($conn, $checkanswer);
if (mysqli_num_rows($result) > 0){
while($row = mysqli_fetch_array($result)){
$quques_number = $row['quques_number'];
$quques_answer = $row['quques_correct_answer'];
$quques_score = $row['quques_score'];

    if($quques_number === $ques1){
        if ($A1 === $quques_answer){
            $score1 = $quques_score;
        } elseif ($B1 === $quques_answer)  {
            $score1 = $quques_score;
        } elseif ($C1 === $quques_answer)  {
            $score1 = $quques_score;
        } elseif ($D1 === $quques_answer)  {
            $score1 = $quques_score;
        } else {
            $score1 = '0';
        }
    }
    elseif($quques_number === $ques2){
        if ($A2 === $quques_answer){
            $score2 = $quques_score;
        } elseif ($B2 === $quques_answer)  {
            $score2 = $quques_score;
        } elseif ($C2 === $quques_answer)  {
            $score2 = $quques_score;
        } elseif ($D2 === $quques_answer)  {
            $score2 = $quques_score;
        } else {
            $score2 = '0';
        }
    }
    elseif($quques_number === $ques3){
        if ($A3 === $quques_answer){
            $score3 = $quques_score;
        } elseif ($B3 === $quques_answer)  {
            $score3 = $quques_score;
        } elseif ($C3 === $quques_answer)  {
            $score3 = $quques_score;
        } elseif ($D3 === $quques_answer)  {
            $score3 = $quques_score;
        } else {
            $score3 = '0';
        }
    }
    elseif($quques_number === $ques4){
        if ($A4 === $quques_answer){
            $score4 = $quques_score;
        } elseif ($B4 === $quques_answer)  {
            $score4 = $quques_score;
        } elseif ($C4 === $quques_answer)  {
            $score4 = $quques_score;
        } elseif ($D4 === $quques_answer)  {
            $score4 = $quques_score;
        } else {
            $score4 = '0';
        }
    }
    elseif($quques_number === $ques5){
        if ($A5 === $quques_answer){
            $score5 = $quques_score;
        } elseif ($B5 === $quques_answer)  {
            $score5 = $quques_score;
        } elseif ($C5 === $quques_answer)  {
            $score5 = $quques_score;
        } elseif ($D5 === $quques_answer)  {
            $score5 = $quques_score;
        } else {
            $score5 = '0';
        }
    }
} 
$totalscore = $score1 + $score2 + $score3 + $score4 + $score5;
$saveresult = "INSERT INTO result(res_id,res_marks,quiz_id,stud_id)VALUES(NULL, '$totalscore', '$quiz_id', '$stud_id')";
if (mysqli_query($conn, $saveresult)){
    $quiz_id = $_POST['quiz_id'];
    echo '<script>alert("Quiz Completed! View your result?")</script>';
    echo '<script> window.location.href="Student-Result.php?qid='.$quiz_id.'"; </script>';
}else {
    echo '<script>alert("Oppss! Something wrong. Please try again.")</script>';
    echo '<script> window.location.href="Student-Homepage.php?"; </script>';
}
}

?>