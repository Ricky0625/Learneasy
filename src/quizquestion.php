<?php
session_start();
require("conn.php");

if(isset($_SESSION['logged_teacher'])){
    $nav = "teacher-nav.php";
}
include($nav);

$username = $_SESSION['logged_teacher'];

$cour_id = $_GET['cid'];
$quizsql = "SELECT * FROM quiz WHERE cour_id = $cour_id ORDER BY quiz_id DESC LIMIT 1 ";
$result = mysqli_query($conn, $quizsql);
$row = mysqli_fetch_array($result);
$qid = $row['quiz_id'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="quizquestion.css">
    <link rel="icon" href="Images/LE_Favicon.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <title>Create Quiz Question</title>
</head>
<body> 
     <?php include ("teacher-nav.php"); ?>

     <div class="create-course-titlebar">
        <!--Create Course Words-->
        <div class="titlebar-content">
            <p>Create Course</p>
        </div>
     </div>

     <form class="create-quiz-container" action="uploadquestion.php" method="POST">
        <!--Quiz Form Title-->
        <p>Quiz Question</p>
        <div class="container-details">
            <div class="question-list">
                <!--Box content of question and choices-->
                    <div class="left-content">
                        <label>
                            <input type="number" class="quiz-number" min="1" max="5" name="quques_number[]" required>
                            <input type="text" class="quiz-question-field" maxlength="100" name="quques_question[]" required>
                        </label>
                        <div class="quiz-choices">
                            <div class="quiz-choices-box">
                                <label class="mcq-choices">
                                    <input type="checkbox" name="quques_correct_answer[]" value="1">
                                    <span class="checkmark"></span>
                                </label>
                                <input type="text" maxlength="50" name="quques_choices_A[]" required>
                            </div>
                            <div class="quiz-choices-box">
                                <label class="mcq-choices">
                                    <input type="checkbox" name="quques_correct_answer[]" value="2">
                                    <span class="checkmark"></span>
                                </label>
                                <input type="text" maxlength="50" name="quques_choices_B[]" required>
                            </div>
                            <div class="quiz-choices-box">
                                <label class="mcq-choices">
                                    <input type="checkbox" name="quques_correct_answer[]" value="3">
                                    <span class="checkmark"></span>
                                </label>
                                <input type="text" maxlength="50" name="quques_choices_C[]">
                            </div>
                            <div class="quiz-choices-box">
                                <label class="mcq-choices">
                                    <input type="checkbox" name="quques_correct_answer[]" value="4">
                                    <span class="checkmark"></span>
                                </label>
                                <input type="text" maxlength="50" name="quques_choices_D[]">
                            </div>
                        </div>
                    </div>
                    <!--Box content for score-->
                    <div class="right-content">
                        <label>Score :</label>
                        <input type=text maxlength="3" name="quques_score[]" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"/>
                    </div>
                    <div class="button">
                        <button type="button" class="add-question">Add Question</button>
                        <input type="hidden" value="<?php echo $qid; ?>" name="quiz_id">
                        <input type="submit" value="Create Quiz">
                    </div>
                </div>
            </div>
     </form>

     <script>
        //add option javascript
        $(document).ready(function () {
        // allowed maximum input fields
        var max_input = 5;
        // initialize the counter for textbox
        var x = 1;
        // handle click event on Add More button
        $('.add-question').click(function (e) {
        e.preventDefault();
        
        if (x < max_input) { // validate the condition
            x++; // increment the counter
            $('.container-details').append(`
            <div class="question-list">
                <!--Box content of question and choices-->
                    <div class="left-content">
                        <label>
                            <input type="number" class="quiz-number" min="1" max="5" name="quques_number[]" required>
                            <input type="text" class="quiz-question-field" maxlength="100" name="quques_question[]" required>
                        </label>
                        <div class="quiz-choices">
                            <div class="quiz-choices-box">
                                <label class="mcq-choices">
                                    <input type="checkbox" name="quques_correct_answer[]" value="1">
                                    <span class="checkmark"></span>
                                </label>
                                <input type="text" maxlength="50" name="quques_choices_A[]" required>
                            </div>
                            <div class="quiz-choices-box">
                                <label class="mcq-choices">
                                    <input type="checkbox" name="quques_correct_answer[]" value="2">
                                    <span class="checkmark"></span>
                                </label>
                                <input type="text" maxlength="50" name="quques_choices_B[]" required>
                            </div>
                            <div class="quiz-choices-box">
                                <label class="mcq-choices">
                                    <input type="checkbox" name="quques_correct_answer[]" value="3">
                                    <span class="checkmark"></span>
                                </label>
                                <input type="text" maxlength="50" name="quques_choices_C[]">
                            </div>
                            <div class="quiz-choices-box">
                                <label class="mcq-choices">
                                    <input type="checkbox"name="quques_correct_answer[]" value="4">
                                    <span class="checkmark"></span>
                                </label>
                                <input type="text" maxlength="50" name="quques_choices_D[]">
                            </div>
                        </div>
                    </div>
                    <!--Box content for score-->
                    <div class="right-content">
                        <label>Score :</label>
                        <input type=text maxlength="3" name="quques_score[]" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"/>
                    </div>
                        <button type="button" class="remove-question">Remove</button>
                </div>
            `);
        }
        });
        
        // handle click event of the remove link
        $('.container-details').on("click", ".remove-question", function (e) {
        e.preventDefault();
        $(this).parent('div').remove();  // remove input field
        x--; // decrement the counter
        })

        });       

     </script>
    <?php include ("footer.php"); ?> 
</body>
</html>