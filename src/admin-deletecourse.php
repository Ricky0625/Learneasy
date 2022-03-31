<?php
include "conn.php";

$cour_id = $_GET['cid'];

$sql = "DELETE FROM course WHERE cour_id = $cour_id";
$result = mysqli_query($conn, $sql);

if (mysqli_affected_rows($conn)<0)
{
    echo "<script>alert('Unable to delete course!');";
    echo "<script>window.location.href='admin-course-report.php';</script>";
}

    echo "<script>alert('Course have deleted!');</script>";
    echo "<script>window.location.href='admin-course-report.php';</script>";
?>