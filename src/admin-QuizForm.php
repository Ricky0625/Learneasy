<?php
session_start();
require("conn.php");
$cour_id = $_GET['cid'];

$quizquestion = "SELECT SUM(quques_score) AS mark FROM quiz_question qq, quiz q WHERE (qq.quiz_id = q.quiz_id) AND (q.cour_id = $cour_id)";
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
    <link rel="stylesheet" href="admin-quizform.css">
    <link rel="icon" href="Images/LE_Favicon.png">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<body>
    <title>Quiz Homepage</title>
</head>
<body> 
    <?php include("admin-nav.php")?>
    <!--Quiz Title and Quiz Reminder and Quiz Marks-->
    <?php
    $sql = "SELECT * FROM quiz WHERE cour_id = $cour_id";
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
                <?php
                $quizresult = "SELECT * FROM result r, quiz q WHERE (r.quiz_id = q.quiz_id) AND (q.cour_id = $cour_id)";
                $result = mysqli_query($conn, $quizresult);
                $row = mysqli_fetch_array($result);
                $resmarks = $row['res_marks'];
                if(!$row){
                    $score = '0';
                } else {
                    $score = $row['res_marks'];
                }
                ?>
                <div class="display-marks">
                    <h2><?php echo $score ?>/<?php echo $mark ?></h2>
                </div>
            </div>
        </div>

        <div class="right-quiz-container">
            <!--Quiz Timer-->
                <div class=timer>
                    <p>Time Remains</p>
                    <?php
                    $sql = "SELECT * FROM quiz WHERE cour_id = $cour_id";
                    $result = mysqli_query($conn, $sql);    
                    $row = mysqli_fetch_array($result);
                    ?>
                    <div class="time-set">
                        <h2><?php echo $row['quiz_timer'] ?> mins</h2>
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
        $sql = "SELECT * FROM quiz q, quiz_question qq WHERE (q.quiz_id = qq.quiz_id) AND (q.cour_id = $cour_id) AND quques_number = '1'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        ?>                
        <form class="question-content" method ="POST" action ="answer.php" id="submit">
            <input type="hidden" name="quiz_id" value="<?php echo $row['quiz_id'] ?>">
            <input type="hidden" name="quques_number1" value="<?php echo $row['quques_number'] ?>">
            <div class="mcq-question">
                <h2><?php echo $row["quques_number"]; ?></h2>
                <h3><?php echo $row["quques_question"]; ?></h3>
                <h4><?php echo $row["quques_score"]; ?></h4>
            </div>

            <!--MCQ-Choices-->
            <div class="mcq-answer">
                <label class="mcq-choices">
                    <?php echo $row["quques_choices_A"]; ?>
                    <input type="hidden" name="1A" value="0">
                    <input type="checkbox" name="1A" class="option" value="1">
                    <span class="checkmark"></span>
                </label>
                <label class="mcq-choices">
                    <?php echo $row["quques_choices_B"]; ?>
                    <input type="hidden" name="1B" value="0">
                    <input type="checkbox" name="1B" class="option" value="2">
                    <span class="checkmark"></span>
                </label>
                    <label class="mcq-choices">
                    <?php echo $row["quques_choices_C"]; ?>
                    <input type="hidden" name="1C" value="0">
                    <input type="checkbox" name="1C" class="option" value="3">
                    <span class="checkmark"></span>
                </label>
                <label class="mcq-choices">
                    <?php echo $row["quques_choices_D"]; ?>
                    <input type="hidden" name="1D" value="0">
                    <input type="checkbox" name="1D" class="option" value="4">
                    <span class="checkmark"></span>
                </label>
            </div>

            <!--Question 2-->
            <?php
            include "conn.php";
            $sql = "SELECT * FROM quiz q, quiz_question qq WHERE (q.quiz_id = qq.quiz_id) AND (q.cour_id = $cour_id) AND quques_number = '2'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result);
            ?>  
            <div>
                <input type="hidden" name="quiz_id" value="<?php echo $row['quiz_id'] ?>">
                <input type="hidden" name="quques_number2" value="<?php echo $row['quques_number'] ?>">
                <div class="mcq-question">
                    <h2><?php echo $row["quques_number"]; ?></h2>
                    <h3><?php echo $row["quques_question"]; ?></h3>
                    <h4><?php echo $row["quques_score"]; ?></h4>
                </div>

                <!--MCQ-Choices-->
                <div class="mcq-answer">
                    <label class="mcq-choices">
                        <?php echo $row["quques_choices_A"]; ?>
                        <input type="hidden" name="2A" value="0">
                        <input type="checkbox" name="2A" class="option" value="1">
                        <span class="checkmark"></span>
                    </label>
                    <label class="mcq-choices">
                        <?php echo $row["quques_choices_B"]; ?>
                        <input type="hidden" name="2B" value="0">
                        <input type="checkbox" name="2B" class="option" value="2">
                        <span class="checkmark"></span>
                    </label>
                        <label class="mcq-choices">
                        <?php echo $row["quques_choices_C"]; ?>
                        <input type="hidden" name="2C" value="0">
                        <input type="checkbox" name="2C" class="option" value="3">
                        <span class="checkmark"></span>
                    </label>
                    <label class="mcq-choices">
                        <?php echo $row["quques_choices_D"]; ?>
                        <input type="hidden" name="2D" value="0">
                        <input type="checkbox" name="2D" class="option" value="4">
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>

            <!--Question 3-->
            <?php
            include "conn.php";
            $sql = "SELECT * FROM quiz q, quiz_question qq WHERE (q.quiz_id = qq.quiz_id) AND (q.cour_id = $cour_id) AND quques_number = '3'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result);
            ?>  
            <div>
                <input type="hidden" name="quiz_id" value="<?php echo $row['quiz_id'] ?>">
                <input type="hidden" name="quques_number3" value="<?php echo $row['quques_number'] ?>">
                <div class="mcq-question">
                    <h2><?php echo $row["quques_number"]; ?></h2>
                    <h3><?php echo $row["quques_question"]; ?></h3>
                    <h4><?php echo $row["quques_score"]; ?></h4>
                </div>

                <!--MCQ-Choices-->
                <div class="mcq-answer">
                    <label class="mcq-choices">
                        <?php echo $row["quques_choices_A"]; ?>
                        <input type="hidden" name="3A" value="0">
                        <input type="checkbox" name="3A" class="option" value="1">
                        <span class="checkmark"></span>
                    </label>
                    <label class="mcq-choices">
                        <?php echo $row["quques_choices_B"]; ?>
                        <input type="hidden" name="3B" value="0">
                        <input type="checkbox" name="3B" class="option" value="2">
                        <span class="checkmark"></span>
                    </label>
                        <label class="mcq-choices">
                        <?php echo $row["quques_choices_C"]; ?>
                        <input type="hidden" name="3C" value="0">
                        <input type="checkbox" name="3C" class="option" value="3">
                        <span class="checkmark"></span>
                    </label>
                    <label class="mcq-choices">
                        <?php echo $row["quques_choices_D"]; ?>
                        <input type="hidden" name="3D" value="0">
                        <input type="checkbox" name="3D" class="option" value="4">
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>

            <!--Question 4-->
            <?php
            include "conn.php";
            $sql = "SELECT * FROM quiz q, quiz_question qq WHERE (q.quiz_id = qq.quiz_id) AND (q.cour_id = $cour_id) AND quques_number = '4'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result);
            ?>  
            <div>
                <input type="hidden" name="quiz_id" value="<?php echo $row['quiz_id'] ?>">
                <input type="hidden" name="quques_number4" value="<?php echo $row['quques_number'] ?>">
                <div class="mcq-question">
                    <h2><?php echo $row["quques_number"]; ?></h2>
                    <h3><?php echo $row["quques_question"]; ?></h3>
                    <h4><?php echo $row["quques_score"]; ?></h4>
                </div>

                <!--MCQ-Choices-->
                <div class="mcq-answer">
                    <label class="mcq-choices">
                        <?php echo $row["quques_choices_A"]; ?>
                        <input type="hidden" name="4A" value="0">
                        <input type="checkbox" name="4A" class="option" value="1">
                        <span class="checkmark"></span>
                    </label>
                    <label class="mcq-choices">
                        <?php echo $row["quques_choices_B"]; ?>
                        <input type="hidden" name="4B" value="0">
                        <input type="checkbox" name="4B" class="option" value="2">
                        <span class="checkmark"></span>
                    </label>
                        <label class="mcq-choices">
                        <?php echo $row["quques_choices_C"]; ?>
                        <input type="hidden" name="4C" value="0">
                        <input type="checkbox" name="4C" class="option" value="3">
                        <span class="checkmark"></span>
                    </label>
                    <label class="mcq-choices">
                        <?php echo $row["quques_choices_D"]; ?>
                        <input type="hidden" name="4D" value="0">
                        <input type="checkbox" name="4D" class="option" value="4">
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>

            <!--Question 5-->
            <?php
            include "conn.php";
            $sql = "SELECT * FROM quiz q, quiz_question qq WHERE (q.quiz_id = qq.quiz_id) AND (q.cour_id = $cour_id) AND quques_number = '5'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result);
            ?>  
            <div>
                <input type="hidden" name="quiz_id" value="<?php echo $row['quiz_id'] ?>">
                <input type="hidden" name="quques_number5" value="<?php echo $row['quques_number'] ?>">
                <div class="mcq-question">
                    <h2><?php echo $row["quques_number"]; ?></h2>
                    <h3><?php echo $row["quques_question"]; ?></h3>
                    <h4><?php echo $row["quques_score"]; ?></h4>
                </div>

                <!--MCQ-Choices-->
                <div class="mcq-answer">
                    <label class="mcq-choices">
                        <?php echo $row["quques_choices_A"]; ?>
                        <input type="hidden" name="5A" value="0">
                        <input type="checkbox" name="5A" class="option" value="1" >
                        <span class="checkmark"></span>
                    </label>
                    <label class="mcq-choices">
                        <?php echo $row["quques_choices_B"]; ?>
                        <input type="hidden" name="5B" value="0">
                        <input type="checkbox" name="5B" class="option" value="2" >
                        <span class="checkmark"></span>
                    </label>
                        <label class="mcq-choices">
                        <?php echo $row["quques_choices_C"]; ?>
                        <input type="hidden" name="5C" value="0">
                        <input type="checkbox" name="5C" class="option" value="3" >
                        <span class="checkmark"></span>
                    </label>
                    <label class="mcq-choices">
                        <?php echo $row["quques_choices_D"]; ?>
                        <input type="hidden" name="5D" value="0">
                        <input type="checkbox" name="5D" class="option" value="4" >
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>

            <div class="quiz-btn">
                <div class="back-btn">
                    <a class="link-to-course"href="admin-course-content.php?cid=<?php echo $cour_id ?>">Back</a>
                </div>
            </div>
        </form>
 
    <script>
        $(function()
        {
        function toggle(choices,name)
        {
            if(choices.includes(name))
            {
                for( i=0;i<choices.length;i++)
                {
                if(name !=choices[i])
                    $('input[name="' + choices[i] + '"]').not(this).prop('checked', false); 
                }
            } 
        }
        $('input[type="checkbox"]').on('change', function() 
        {
            var Q1 = ["1A","1B","1C","1D"];
            var Q2 = ["2A","2B","2C","2D"];
            var Q3 = ["3A","3B","3C","3D"];
            var Q4 = ["4A","4B","4C","4D"];
            var Q5 = ["5A","5B","5C","5D"];

            toggle(Q1,this.name);
            toggle(Q2,this.name);
            toggle(Q3,this.name);
            toggle(Q4,this.name);
            toggle(Q5,this.name);

        });
        });
    </script>

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