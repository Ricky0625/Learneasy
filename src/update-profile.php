<?php
session_start();
include("conn.php");

$stud_username = $_SESSION['logged_username'];
$sql = "SELECT * FROM student WHERE stud_username = '$stud_username'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$stud_id = $row['stud_id'];

if(isset($_POST['update-profile'])){
    //First name
    $fname = $_POST['fname'];
    //Last name
    $lname = $_POST['lname'];
    //Bio
    $bio = $_POST['bio'];
    $new_bio = str_replace(array("'", "\""), "&lsquo;", htmlspecialchars($bio));


    //Name of the uploaded profile picture
    $profilePic = $_FILES['uploadProfile']['name'];
    $coverPic = $_FILES['uploadCover']['name'];

    //Destination
    $destination = 'Images/' . $profilePic;
    $destinationCover = 'Images/' . $coverPic;

    //Get the file extension
    $extension = pathinfo($profilePic, PATHINFO_EXTENSION);
    $extensionCover = pathinfo($coverPic, PATHINFO_EXTENSION);

    $file = $_FILES['uploadProfile']['tmp_name'];
    $fileCover = $_FILES['uploadCover']['tmp_name'];

    if(!empty($profilePic)){
        if(move_uploaded_file($file, $destination)) {
            $sql = "UPDATE student SET stud_profile_picture = '$profilePic' WHERE stud_id = '$stud_id'";
            if(mysqli_query($conn, $sql)){
            }
        }else {
            echo '<script>alert("Failed to update.")</script>';
        }
    }else{
    };
    
    if(!empty($coverPic)){
        if(move_uploaded_file($fileCover, $destinationCover)) {
            $sql = "UPDATE student SET stud_cover_picture = '$coverPic' WHERE stud_id = '$stud_id'";
            if(mysqli_query($conn, $sql)){
            }
        }else {
            echo '<script>alert("Failed to update.")</script>';
        }
    }else{
    };

    if(!empty($fname)){
        $sql = "UPDATE student SET stud_first_name = '$fname' WHERE stud_id = '$stud_id'";
        if(mysqli_query($conn, $sql)){
        }
    }else {
        echo '<script>alert("Failed to update.")</script>';
    }

    if(!empty($lname)){
        $sql = "UPDATE student SET stud_last_name = '$lname' WHERE stud_id = '$stud_id'";
        if(mysqli_query($conn, $sql)){
        }
    }else {
        echo '<script>alert("Failed to update.")</script>';
    }

    if(!empty($bio)){
        $sql = "UPDATE student SET stud_bio = '$new_bio' WHERE stud_id = '$stud_id'";
        if(mysqli_query($conn, $sql)){
        }
    }else {
        echo '<script>alert("Failed to update.")</script>';
    }

    echo '<script>alert("Successfully updated.")</script>';
}
echo '<script>location.href="profile.php";</script>';
?>