<?php

session_start();
include "conn.php";

$quiz_id = $_GET['qid'];

$sql = 'SELECT * FROM quiz WHERE quiz_id = "'.$quiz_id.'"';

$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) > 0){
while ($row = mysqli_fetch_array($result)){
    $cid = $row['cour_id']
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="quizquestions.css">
    <link rel="icon" href="Images/LE_Favicon.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <title>Create Quiz Question</title>
</head>
<body> 
      <?php include("teacher-nav.php");?>

    <div class="backbtn">
        <button onclick="goBack()"><i class="fas fa-caret-left"></i>Back</button>
    </div>
     
    <form class="create-quiz-container" action="teacher-edit-upload-question.php" method="POST">     
    <?php
    include "conn.php";
    $sql = "SELECT * FROM quiz_question WHERE quiz_id = '$quiz_id'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
    while ($row = mysqli_fetch_array($result)){
    ?>
        <p>Question <?php echo $row['quques_number'] ?></p>
        <input type="hidden" name="quiz_id" value="<?php echo $row['quiz_id'] ?>">
        <input type="hidden" name="quques_id[]" value="<?php echo $row['quques_id'] ?>">
        <div class="container-details">
            <div class="question-list">
                <!--Box content of question and choices-->
                    <div class="left-content">
                        <label>
                            <input type="number" class="quiz-number" value="<?php echo $row['quques_number'];?>" min="1" max="5" name="quques_number[]" required>
                            <input type="text" class="quiz-question-field" value="<?php echo $row['quques_question'];?>" maxlength="100" name="quques_question[]" required>
                        </label>
                        <div class="quiz-choices">
                            <div class="quiz-choices-box">
                                <label class="mcq-choices">
                                    <input type="checkbox" name="quques_correct_answer[]"  <?php if($row['quques_correct_answer']=="1") {?> <?php echo "checked";?> <?php }?>value="1">
                                    <span class="checkmark"></span>
                                </label>
                                <input type="text" value="<?php echo $row['quques_choices_A'];?>" maxlength="50" name="quques_choices_A[]" required>
                            </div>
                            <div class="quiz-choices-box">
                                <label class="mcq-choices">
                                    <input type="checkbox" name="quques_correct_answer[]"  <?php if($row['quques_correct_answer']=="2") {?> <?php echo "checked";?> <?php }?>value="2">
                                    <span class="checkmark"></span>
                                </label>
                                <input type="text" value="<?php echo $row['quques_choices_B'];?>" maxlength="50" name="quques_choices_B[]" required>
                            </div>
                            <div class="quiz-choices-box">
                                <label class="mcq-choices">
                                    <input type="checkbox" name="quques_correct_answer[]" <?php if($row['quques_correct_answer']=="3") {?> <?php echo "checked";?> <?php }?> value="3">
                                    <span class="checkmark"></span>
                                </label>
                                <input type="text" value="<?php echo $row['quques_choices_C'];?>" maxlength="50" name="quques_choices_C[]">
                            </div>
                            <div class="quiz-choices-box">
                                <label class="mcq-choices">
                                    <input type="checkbox" name="quques_correct_answer[]" <?php if($row['quques_correct_answer']=="4") {?> <?php echo "checked";?> <?php }?> value="4">
                                    <span class="checkmark"></span>
                                </label>
                                <input type="text" value="<?php echo $row['quques_choices_D'];?>" maxlength="50" name="quques_choices_D[]">
                            </div>
                        </div>
                    </div>
                    <!--Box content for score-->
                    <div class="rightcontent">
                        <label>Score :</label>
                        <input type=text maxlength="3" name="quques_score[]" value="<?php echo $row['quques_score'];?>" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"/>
                    </div>

                </div>
            </div>

        <?php
            }
        }
        ?>
        <div class="button">
            <input type="submit" value="Update Question">
        </div>         
     </form>

    <script>
     //back button
     function goBack() {
        window.history.back();
    }
     </script>

     <?php
    }
}
?>
    <?php include ("footer.php"); ?> 
</body>
</html>