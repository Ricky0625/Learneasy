<?php
session_start();
require("conn.php");

if(isset($_SESSION['logged_teacher'])){
    $nav = "teacher-nav.php";
}
include($nav);

$username = $_SESSION['logged_teacher'];

//Get teac id
$sql = "SELECT * FROM teacher WHERE teac_username = '$username'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$teac_id = $row['teac_id'];

$quiz_id = $_GET['qid'];
$quizsql = "SELECT * FROM quiz WHERE quiz_id = $quiz_id";
$result = mysqli_query($conn, $quizsql);
$row = mysqli_fetch_array($result);
$cour_id = $row['cour_id'];

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
    <link rel="stylesheet" href="quizforms.css">
    <link rel="icon" href="Images/LE_Favicon.png">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<body>
    <title>Teacher View Question</title>
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
                <h2>Reminder :</h2>
                <h3>Please read and answer all the questions in the time set.
                    Do not refer to any courses or get the answer from the
                    internet while attending the quiz. The timer will start 
                    counting when you attending the first question and will
                    stop when you done and click the “Submit” button.</h3>
            </div>
            <!--Quiz Marks-->
            <div class="quiz-marks">
                <p>Result :</p>
                <div class="display-marks">
                    <h2>0/<?php echo $mark ?></h2>
                </div>
            </div>
        </div>

        <div class="right-quiz-container">
            <!--Quiz Timer-->
                <div class=timer>
                    <p>Time Remains</p>
                    <div class="time-set">
                        <h2><?php echo $row['quiz_timer']?> mins</h2>
                    </div>
                </div>
                <div class="back-to-top-btn">
                    <button onclick="topFunction()" id="bTt-btn">
                        <img src="Images/back-to-top-quiz.png">
                    </button>
                </div>
            </div>
        </div>
    
         <!--Question 1-->
         <?php
        include "conn.php";
        $sql = "SELECT * FROM quiz_question WHERE quiz_id = '$quiz_id'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
        ?>                
        <form class="question-content" method ="POST" action ="answer.php" id="submit">
            <input type="hidden" name="quiz_id" value="<?php echo $row['quiz_id'] ?>">
            <input type="hidden" name="teac_id" value="<?php echo $teac_id?>">
            <input type="hidden" name="question[<?php echo $row["quques_number"]; ?>]" value="<?php echo $row['quques_number'] ?>">
            <div class="mcq-question">
                <h2><?php echo $row["quques_number"]; ?></h2>
                <h3><?php echo $row["quques_question"]; ?></h3>
                <h4><?php echo $row["quques_score"]; ?></h4>
            </div>

            <!--MCQ-Choices-->
            <div class="mcq-answer" id="mcq">
                <label class="mcq-choices">
                    <?php echo $row["quques_choices_A"]; ?>
                    <input type="checkbox" name="quques_correct_answer[]"  <?php if($row['quques_correct_answer']=="1") {?> <?php echo "checked";?> <?php }?>value="1">
                    <span class="checkmark"></span>
                </label>
                <label class="mcq-choices">
                    <?php echo $row["quques_choices_B"]; ?>
                    <input type="checkbox" name="quques_correct_answer[]"  <?php if($row['quques_correct_answer']=="2") {?> <?php echo "checked";?> <?php }?>value="2">
                    <span class="checkmark"></span>
                </label>
                    <label class="mcq-choices">
                    <?php echo $row["quques_choices_C"]; ?>
                    <input type="checkbox" name="quques_correct_answer[]"  <?php if($row['quques_correct_answer']=="3") {?> <?php echo "checked";?> <?php }?>value="3">
                    <span class="checkmark"></span>
                </label>
                <label class="mcq-choices">
                    <?php echo $row["quques_choices_D"]; ?>
                    <input type="checkbox" name="quques_correct_answer[]"  <?php if($row['quques_correct_answer']=="4") {?> <?php echo "checked";?> <?php }?>value="4">
                    <span class="checkmark"></span>
                </label>
            </div>
            <?php
                }
            }
            ?>
            <div class="quiz-btn">
                <div class="delete-btn">
                    <a onclick="return confirm('Are you sure you want to delete?')" href="deletequiz.php?qid=<?php echo $quiz_id ?>">Delete</a>
                </div>
                <div class="edit-btn">
                    <a href="teacher-edit-quiz.php?qid=<?php echo $quiz_id ?>&tid=<?php echo $teac_id ?>&cid=<?php echo $cour_id ?>">Edit</a>
                </div>

            </div>
        </form>
        

    <?php include ("footer.php"); ?>

    <script>
        //Get the button
        var mybutton = document.getElementById("bTt-btn");

        // When the user scrolls down 180px from the top of the document, show the button
        window.onscroll = function() {scrollFunction()};

        function scrollFunction() {
        if (document.body.scrollTop > 180 || document.documentElement.scrollTop > 180) {
            mybutton.style.display = "block";
        } else {
            mybutton.style.display = "none";
        }
        }

        //User click on the button will scroll back to top
        function topFunction() {
         document.body.scrollTop = 0;
         document.documentElement.scrollTop = 0;
        }
    </script>
</body>
</html>