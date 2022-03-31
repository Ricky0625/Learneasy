<?php
include("conn.php");
$cont_id = $_GET['cont_id'];
$cn = $_GET['cn'];
$tid = $_GET['tid'];
$cid = $_GET['cid'];

$sql = "DELETE FROM content WHERE cont_id = '$cont_id'";

if(mysqli_query($conn, $sql)){
	echo '<script>alert("Content Has Been Deleted.")</script>';
	echo '<script>window.location.href="upload-content.php?cn='.$cn.'&tid='.$tid.'&cid='.$cid.'"</script>';
}
else{
	echo '<script>alert("Failed to Delete Selected Content")</script>';
    echo '<script>window.location.href="upload-content.php?cn='.$cn.'&tid='.$tid.'&cid='.$cid.'"</script>';
}
//Step 5 - Close connection
mysqli_close($conn);

?> 