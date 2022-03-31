<?php

session_start();
include "conn.php";

$teac_id = $_GET['tid'];
$cour_id = $_GET['cid'];
$cn = $_GET['cn'];

$sql = "SELECT * FROM teacher WHERE teac_id = '$teac_id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$teac_name = $row['teac_first_name'].' '.$row['teac_last_name'];

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
    <link rel="stylesheet" href="createsquiz.css">
    <link rel="icon" href="Images/LE_Favicon.png">
    <title>Create Quiz</title>
</head>
<body> 
     <?php include ("teacher-nav.php"); ?>

     <div class="create-course-titlebar">
        <!--Create Course-->
        <div class="titlebar-content">
            <p>Create Course</p>
        </div>
     </div>

    <form class="create-quiz-container" action="uploadquiz.php" method="POST">
        <!--Quiz Form Title-->
        <p>Quiz Form</p>
        <!--quiz title and quiz time box-->
        <div class="quiz-content">
            <!--Quiz Title Box-->
            <div class="quiz-title">
                <div class="title">
                    <p>Quiz title :</p>
                    <span>0/50</span>
                </div>
                <input type="text" maxlength="50" name="quiz_title" required>
                <div class="display-course-info">
                    <!--label for course-->
                    <label>Course: <?php echo $cn; ?></label>
                    <!--Label for created by-->
                    <label>Created by: <?php echo $teac_name; ?></label>
                    <!--Label for created date-->
                    <label>Created date: <?php echo date("Y-m-d h:i:s"); ?></label>
                </div>
            </div>

            <!--Quiz Time Box-->
            <div class="quiz-time">
                <label>Time :</label>
                <div class="input-box">
                   <input type=text name="quiz_timer" maxlength="3" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" required/>
                   <h2>mins</h2>
                </div>
            </div>
        </div>
        <!--Submit Quiz Form Button-->
            <div>
                <input type="submit" value="Create Quiz" class="submit-btn">
                <input type="hidden" value="<?php echo $cour_id; ?>" name="cour_id">
                <input type="hidden" value="<?php echo date("Y-m-d h:i:s"); ?>" name="quiz_create_date"> 
            </div>
    </form>

    <?php
    }
}
?>
    <?php include ("footer.php"); ?> 
</body>
</html>