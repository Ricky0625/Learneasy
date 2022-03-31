<?php
session_start();
include("conn.php");

$teac_username = $_SESSION['logged_teacher'];

//Find the teacher id
$sql = "SELECT * FROM teacher WHERE teac_username = '$teac_username'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$verified = $row['teac_status'];


if($verified == 1){
    echo '<script>location.href = "create-course.php?"</script>';
}else{
    echo '<script>alert("Opps! Seems like your teacher account not yet been verified. Please wait Admin to verify your account. Only verified teacher account could create course.")</script>';
    echo '<script>location.href = "teacher-home.php?"</script>';
}

?>