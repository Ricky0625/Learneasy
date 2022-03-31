<?php
session_start();
include 'conn.php';
$teac_id = $_POST['teac_id'];
$stud_id = $_POST['stud_id'];
$cour_id= $_POST['cour_id'];
$rate_comment = $_POST['rate_comment'];
$rate_course_value = $_POST['rate_course_value'];
$rate_teacher_value = $_POST['rate_teacher_value'];
echo $cour_id;
/*
echo $stud_id;
echo $cour_id;
echo $rate_comment;
echo $rate_course_value;
echo $rate_teacher_value;
*/

$sql = "SELECT * FROM rating WHERE (stud_id ='$stud_id') AND (cour_id = '$cour_id')";
$check_id = mysqli_query($conn, $sql);
if (mysqli_affected_rows($conn) != 1) {

  $sql = "INSERT INTO rating (rate_comment,rate_course_value,rate_teacher_value,rate_date,cour_id,teac_id,stud_id) VALUES ('$rate_comment','$rate_course_value','$rate_teacher_value',now(),'$cour_id','$teac_id','$stud_id')";
if (mysqli_query($conn, $sql))
    echo '<script>alert("Your Rating Has Been Successfully Submitted")</script>';
    echo '<script>window.location.href="course-content.php?cid='.$cour_id.'";</script>';

}else{	
  $sql = "UPDATE rating SET rate_comment = '$rate_comment', rate_course_value = '$rate_course_value' , rate_teacher_value = '$rate_teacher_value', rate_date = now() WHERE (stud_id ='$stud_id') AND (cour_id = '$cour_id')";

if (mysqli_query($conn, $sql)){
    echo '<script>alert("Your Rating Has Been Successfully Updated")</script>';
    echo '<script>window.location.href="course-content.php?cid='.$cour_id.'";</script>';
}else{
    echo '<script>alert("Unable to update rating")</script>';
    echo '<script>window.location.href="course-content.php?cid='.$cour_id.'";</script>';
}
//Step 5
mysqli_close($conn);

}

?>

