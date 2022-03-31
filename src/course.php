<?php
session_start();
include "conn.php";

// If upload button is clicked ...
if (isset($_POST['upload'])) {
// Get image name
$cour_cover = $_FILES['cour_cover']['name'];
$tmp =  $_FILES['cour_cover']['tmp_name'];
$randomno=rand(0,10000);
$newname= $randomno.'-'.$cour_cover;

// image file directory
move_uploaded_file($tmp, "Images/".$newname);

$sql = 'INSERT INTO course(cour_name, cour_category, cour_description, cour_cover, cour_date, teac_id) VALUES ("'.$_POST['cour_name'].'","'.$_POST['cour_category'].'","'.$_POST['cour_description'].'","'.$newname.'","'.$_POST['cour_date'].'","'.$_POST['teac_id'].'")';

if (mysqli_query($conn, $sql)) {
$cour_name = $_POST['cour_name'];
echo '<script>alert("Successfully added your new course")</script>';
echo '<script> window.location.href="createcontent.php?cn='.$cour_name.'"; </script>';

}else{
echo '<script>alert("Failed to add your course")</script>';
echo '<script> window.location.href="createcourse.php"; </script>';
}
}
?>