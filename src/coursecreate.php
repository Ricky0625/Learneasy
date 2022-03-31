<?php
include("conn.php");
session_start();

//Find the current logged teacher id
$teac_username =  $_SESSION['logged_teacher'];
$sql = "SELECT * FROM teacher WHERE teac_username = '$teac_username'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$tid = $row['teac_id'];


if(isset($_POST['create-course-btn'])){
    //variables for the course details
    $cour_name = $_POST['cour_name'];
    #echo $cour_name;
    $cour_category = $_POST['cour_category'];
    #echo $cour_category;
    $cour_des = $_POST['cour_des'];
    $new_des = str_replace(array("'", "\""), "&lsquo;", htmlspecialchars($cour_des));
    #echo $new_bio;
    #echo $cour_des;

    //For the uploaded picture
    $cour_cover = $_FILES['cour-cover']['name'];
    $randomno=rand(0,10000);
    $newname= $randomno.'-'.$cour_cover;
    $destination = 'Images/' . $newname;
    $tmp = $_FILES['cour-cover']['tmp_name'];

    //Get the file extension
    $extension = pathinfo($cour_cover, PATHINFO_EXTENSION);

    //Insert sql
    $sql = "INSERT INTO course(cour_id, cour_name, cour_category, cour_description, cour_cover, cour_date, teac_id) VALUES(NULL, '$cour_name', '$cour_category', '$new_des', '$newname', now(), '$tid')";
    if (mysqli_query($conn, $sql)){

        move_uploaded_file($tmp, $destination);
        echo '<script>alert("Course created!")</script>';
        echo '<script type="text/javascript">location.href = "upload-content.php?cn='.$cour_name.'&tid='.$tid.'";</script>';
    }else {
        echo '<script>alert("Oppss! Something wrong. Please try again.")</script>';
        echo '<script>history.go(-1)</script>';
    }

}

if(isset($_POST['edit-course-btn'])){
    //variables for the course details
    $cid = $_POST['cid'];
    #echo $cid;
    $cour_name = $_POST['cour_name'];
    #echo $cour_name;
    $cour_category = $_POST['cour_category'];
    #echo $cour_category;
    $cour_des = $_POST['cour_des'];
    $new_des = str_replace(array("'", "\""), "&lsquo;", htmlspecialchars($cour_des));
    #echo $cour_des;

    //For the uploaded picture
    $cour_cover = $_FILES['cour-cover']['name'];
    #echo $cour_cover;

    if($cour_cover == ""){
        $sql = "SELECT * FROM course WHERE cour_id = '$cid'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        $newname = $row['cour_cover'];

        $sql = "UPDATE course SET cour_name = '$cour_name', cour_category = '$cour_category', cour_description = '$new_des' WHERE(cour_id = '$cid')";

        if (mysqli_query($conn, $sql)){
            echo '<script>alert("Course updated!")</script>';
            echo '<script type="text/javascript">location.href = "edit-course.php?cour_id='.$cid.'";</script>';
        }else {
            echo '<script>alert("Oppss! Something wrong. Please try again.")</script>';
            echo '<script type="text/javascript">history.go(-1);</script>';
        }

    }else{
        $randomno=rand(0,10000);
        $newname= $randomno.'-'.$cour_cover;
        $destination = 'Images/' . $newname;
        $tmp = $_FILES['cour-cover']['tmp_name'];

        //Get the file extension
        $extension = pathinfo($cour_cover, PATHINFO_EXTENSION);
        move_uploaded_file($tmp, $destination);

        $sql = "UPDATE course SET cour_name = '$cour_name', cour_category = '$cour_category', cour_description = '$cour_des', cour_cover = '$newname' WHERE(cour_id = '$cid')";

        if (mysqli_query($conn, $sql)){
            echo '<script>alert("Course updated!")</script>';
            echo '<script type="text/javascript">location.href = "edit-course.php?cour_id='.$cid.'";</script>';
        }else {
            echo '<script>alert("Oppss! Something wrong. Please try again.")</script>';
            echo '<script type="text/javascript">history.go(-1);</script>';
        }
    }
}

?>

