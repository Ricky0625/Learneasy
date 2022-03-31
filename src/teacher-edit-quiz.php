<?php

session_start();
include "conn.php";
$username = $_SESSION['logged_teacher'];
$quiz_id = $_GET['qid'];
$teac_id = $_GET['tid'];
$cour_id = $_GET['cid'];
$sql = 'SELECT * FROM course WHERE cour_id = "'.$cour_id.'" AND teac_id ="'.$teac_id.'"';

$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) > 0){
while ($row = mysqli_fetch_array($result)){

?>
    

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="createsquiz1.css">
    <link rel="icon" href="Images/LE_Favicon.png">
    <title>Create Quiz</title>
</head>
<body> 
      <?php include("teacher-nav.php");?>

    <div class="backbtn">
        <button onclick="goBack()"><i class="fas fa-caret-left"></i>Back</button>
    </div>
     
    <form class="create-quiz-container" action="teacher-update-edit-quiz.php" method="POST">
        <!--Quiz Form Title-->
        <div style="display: flex; align-items:center;justify-content:space-between;">
            <p>Quiz Form</p>
            <button class="submit-btn" style="margin: 0;margin-bottom:2.15vw;width:fit-content;margin-right:20vw;background-color:#FF6B58;" onclick="location.href='teacher-edit-quiz-question.php?qid=<?php echo $quiz_id?>'">Edit Quiz Question</button>
        </div>
        <!--quiz title and quiz time box-->
        <div class="quiz-content">
            <!--Quiz Title Box-->
            <div class="quiz-title">
                <div class="title">
                    <p>Quiz title :</p>
                </div>
                
                <?php
                //echo the quiz detail
                $sql = "SELECT * FROM teacher t, course c, quiz q WHERE (t.teac_id = c.teac_id)AND(c.cour_id = q.cour_id) AND (q.quiz_id = '$quiz_id')";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_array($result);
                ?>
                <input type="hidden" name="quiz_id" value="<?php echo $row['quiz_id'];?>">
                <input type="text" maxlength="50" name="quiz_title" value="<?php echo $row['quiz_title'];?>">
                <div class="display-course-info">
                    <!--label for course-->
                    <label>Course: <?php echo  $row['cour_name'] ?></label>
                    <!--Label for created by-->
                    <label>Created by: <?php echo $row['teac_username']; ?></label>
                    <!--Label for created date-->
                    <label>Created date: <?php echo $row['quiz_create_date'] ?></label>
                </div>
            </div>

            <!--Quiz Time Box-->
            <div class="quiz-time">
                <label>Time :</label>
                <div class="input-box">
                   <input type=text name="quiz_timer" value="<?php echo $row['quiz_timer'];?>" maxlength="3" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"/>
                   <h2>mins</h2>
                </div>
            </div>
        </div>
        <!--Submit Quiz Form Button-->
            <div>
                <input type="submit" value="Update Quiz" class="submit-btn">
            </div>
    </form>

    <?php
    }
}
?>
    <script>
    //back button
    function goBack() {
        window.history.back();
    }
    </script>
    <?php include ("footer.php"); ?> 
</body>
</html>