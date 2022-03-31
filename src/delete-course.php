<?php
include("conn.php");

$cid = $_GET['cid'];

$sql = "DELETE course, content, resources FROM course LEFT JOIN content ON course.cour_id = content.cour_id LEFT JOIN resources ON course.cour_id = resources.cour_id WHERE course.cour_id = '$cid'";

if(mysqli_query($conn, $sql)){
	echo '<script>alert("Course Has Been Deleted.")</script>';
	echo '<script>window.location.href="teacher-home.php"</script>';
}
else{
	echo '<script>alert("Failed to Delete Selected Course")</script>';
    echo '<script>history.go(-1)</script>';
}
//Step 5 - Close connection
mysqli_close($conn);

?>