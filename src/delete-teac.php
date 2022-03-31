<?php
session_start();
include("conn.php");

$username = $_SESSION['logged_teacher'];
$sql = "SELECT * FROM teacher WHERE teac_username = '$username'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$tid = $row['teac_id'];


$sql = "DELETE course FROM course WHERE (teac_id = '$tid')";
if(mysqli_query($conn, $sql)){
	$sql = "DELETE FROM teacher WHERE teac_id = '$tid'";
	if(mysqli_query($conn, $sql)){
		echo '<script>alert("Account Has Been Deleted.")</script>';
		echo '<script>window.location.href="index.php"</script>';
	}
}
else{
	echo '<script>alert("Failed to Delete Your Account")</script>';
    echo '<script>window.location.href = "setting-teac.php"</script>';
}


//Step 5 - Close connection
mysqli_close($conn);
?>