<?php
session_start();
include("conn.php");

if(!isset($_SESSION['logged_username'])){
    echo '<script type="text/javascript">location.href = "Student-SignIn.php?";</script>';
}

//Get the name of the student
$logged_user = $_SESSION['logged_username'];
$sql="SELECT * FROM student WHERE stud_username = '$logged_user'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$name = $row['stud_first_name'].' '.$row['stud_last_name'];

$cid = $_GET['cid'];
//Get the completed course name
$sql = "SELECT * FROM course c, enrolment e WHERE (c.cour_id = e.cour_id) AND c.cour_id = $cid";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$cour_name = $row['cour_name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="certificate.css">
    <link rel="stylesheet" href="navv.css">
    <link rel="icon" href="Images/LE_Favicon.png">
    <title>Certificate</title>
</head>
<body>
    <div class="back-btn" style="margin-left: 315px;margin-top:40px"><?php include("backBtn.php");?></div>
    <div class="learneasy-cert">
        
        <div class="cert-div">
            <div class="cert-banner">
                <img src="Images/learneasy-cert.png" alt="">
            </div>
            <div class="cert-info">
                <p class="coc">CERTIFICATE OF COMPLETION</p>
                <p class="subtitle">Awarded To</p>
                <p class="stud-name"><?php echo $name;?></p>
                <p class="subtitle">For completed the course</p>
                <p class="cour-name"><?php echo $cour_name?></p>
                <p class="subtitle">Completed on <?php echo $row['enro_end_date'];?></p>
                <p class="quote">“There are no secrets to success. It is the result of preparation, hard work, and learning from failure.”<br>
                    – Colin Powell</p>
            </div>
        </div>
    </div>
    <div style="margin-bottom: 100px;">
        <button id="print-cert" onclick="window.print()">Print Certificate</button>
    </div>
</body>
</html>