<?php
session_start();
require("conn.php");

if(isset($_SESSION['logged_username'])){
    $nav = "nav.php";
}
include($nav);

$logged_stud = $_SESSION['logged_username'];
$sql = "SELECT * FROM student WHERE stud_username = '$logged_stud' LIMIT 1";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$stud_id = $row['stud_id'];

$quiz_id = $_GET['qid'];
$quizquestion = "SELECT SUM(quques_score) AS mark FROM quiz_question WHERE quiz_id = $quiz_id";
$result = mysqli_query($conn, $quizquestion);    
if (mysqli_num_rows($result) > 0){
while($row = mysqli_fetch_array($result)){
$mark = $row['mark'];
}}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="quizformresult.css">
    <link rel="icon" href="Images/LE_Favicon.png">
    <script src="https://kit.fontawesome.com/ef13d33612.js" crossorigin="anonymous"></script>
<body>
    <title>Quiz Result</title>
</head>
<body> 
    <!--Quiz Title and Quiz Reminder and Quiz Marks-->
    <?php
    $sql = "SELECT * FROM quiz WHERE quiz_id = $quiz_id";
    $result = mysqli_query($conn, $sql);    
    $row = mysqli_fetch_array($result); 
    ?>
    <div class="quiz-form-container">
        <div class="quiz-title">
            <p><?php echo $row['quiz_title'] ?></p>
        </div>
        <div class="quiz-form-content">
            <!--Quiz Reminder-->
            <div class="quiz-reminder">
                <h2>View Your Score and Correct Answers!!!</h2>
            </div>
            <!--Quiz Marks-->
            <div class="quiz-marks">
                <p>Result :</p>
                <?php
                $quizresult = "SELECT SUM(res_marks) AS marks FROM result WHERE quiz_id = $quiz_id AND stud_id = $stud_id ORDER BY res_id DESC LIMIT 5";        
                $result = mysqli_query($conn, $quizresult);
                $row = mysqli_fetch_array($result);
                ?>
                <div class="display-marks">
                    <h2><?php echo $row['marks'] ?>/<?php echo $mark ?></h2>
                </div>
            </div>
        </div>

        <div class="right-quiz-container">
            <!--Quiz Timer-->
                <div class="timer">
                    <p>Time Remains</p>
                    <div class="time-set">
                        <h2>----</h2>
                    </div>
                </div>
            </div>
        </div>
    
        <!--Question 1-->
        <?php
        include "conn.php";
        $sql = "SELECT * FROM  quiz_question WHERE quiz_id = $quiz_id";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0);
        while($row = mysqli_fetch_array($result)){
            $quizanswer = $row['quques_correct_answer'];
                if($quizanswer === "1"){
                    $coranswer = $row['quques_choices_A'];
                }
                elseif($quizanswer === "2"){
                    $coranswer = $row['quques_choices_B'];
                }
                elseif($quizanswer === "3"){
                    $coranswer = $row['quques_choices_C'];
                }
                elseif($quizanswer === "4"){
                    $coranswer = $row['quques_choices_D'];
                }
        ?>                
        <form class="question-content">
            <div class="mcq-question">
                <h2><?php echo $row["quques_number"]; ?></h2>
                <h3><?php echo $row["quques_question"]; ?></h3>
                <h4><?php echo $row["quques_score"]; ?></h4>
            </div>

            <!--MCQ-Choices-->
            <div class="mcq-answer" id="mcq">
                <label class="mcq-choices">
                    <?php echo $coranswer ?><i class="fas fa-check"></i>
                </label>
            </div>
            <?php
                }
            ?>
            <div class="quiz-btn">
                <div class="back-btn">
                    <a href="Student-QuizHomepage.php" class="back-btn">Back</a>
                </div>
            </div>
        </form>
    <?php include ("footer.php"); ?>
</body>
</html>