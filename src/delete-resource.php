<?php
include("conn.php");
$rid = $_GET['rid'];
$tid = $_GET['tid'];
$cid = $_GET['cid'];

$sql = "DELETE FROM resources WHERE res_id = '$rid'";

if(mysqli_query($conn, $sql)){
	echo '<script>alert("Resource Has Been Deleted.")</script>';
	echo '<script>window.location.href="upload-resources.php?cid='.$cid.'&tid='.$tid.'"</script>';
}
else{
	echo '<script>alert("Failed to Delete Selected Resource")</script>';
    echo '<script>window.location.href="upload-resources.php?cid='.$cid.'&tid='.$tid.'"</script>';
}
//Step 5 - Close connection
mysqli_close($conn);

?> 