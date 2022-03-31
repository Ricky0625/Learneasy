<?php
session_start();
include("conn.php");

//Teacher profile update
$teac_username = $_SESSION['logged_teacher'];
$sql = "SELECT * FROM teacher WHERE teac_username = '$teac_username'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$teac_id = $row['teac_id'];


if(isset($_POST['update-teac-profile'])){
    //First name
    $fname = $_POST['teac-fname'];
    #echo $fname;
    //Last name
    $lname = $_POST['teac-lname'];
    #echo $lname;
    //Bio
    $bio = $_POST['teac-bio-ed'];
    $new_bio = str_replace(array("'", "\""), "&lsquo;", htmlspecialchars($bio));
    #echo $bio;


    //Name of the uploaded profile picture
    $profilePic = $_FILES['uploadteacProfile']['name'];
    #echo $profilePic;
    $coverPic = $_FILES['uploadteacCover']['name'];
    #echo $coverPic;

    //Destination
    $destination = 'Images/' . $profilePic;
    $destinationCover = 'Images/' . $coverPic;

    //Get the file extension
    $extension = pathinfo($profilePic, PATHINFO_EXTENSION);
    $extensionCover = pathinfo($coverPic, PATHINFO_EXTENSION);

    $file = $_FILES['uploadteacProfile']['tmp_name'];
    $fileCover = $_FILES['uploadteacCover']['tmp_name'];
    
    if(!empty($profilePic)){
        if(move_uploaded_file($file, $destination)) {
            $sql = "UPDATE teacher SET teac_profile_picture = '$profilePic' WHERE teac_id = '$teac_id'";
            if(mysqli_query($conn, $sql)){
            }
        }else {
            echo '<script>alert("Failed to update.")</script>';
        }
    }else{
    };
    
    if(!empty($coverPic)){
        if(move_uploaded_file($fileCover, $destinationCover)) {
            $sql = "UPDATE teacher SET teac_cover_picture = '$coverPic' WHERE teac_id = '$teac_id'";
            if(mysqli_query($conn, $sql)){
            }
        }else {
            echo '<script>alert("Failed to update.")</script>';
        }
    }else{
    };

    if(!empty($fname)){
        $sql = "UPDATE teacher SET teac_first_name = '$fname' WHERE teac_id = '$teac_id'";
        if(mysqli_query($conn, $sql)){
        }
    }else {
        echo '<script>alert("Failed to update.")</script>';
    }

    if(!empty($lname)){
        $sql = "UPDATE teacher SET teac_last_name = '$lname' WHERE teac_id = '$teac_id'";
        if(mysqli_query($conn, $sql)){
        }
    }else {
        echo '<script>alert("Failed to update.")</script>';
    }

    if(!empty($bio)){
        $sql = "UPDATE teacher SET teac_bio = '$new_bio' WHERE teac_id = '$teac_id'";
        if(mysqli_query($conn, $sql)){
        }
    }else {
        echo '<script>alert("Failed to update.")</script>';
    }

    echo '<script>alert("Successfully updated.")</script>';
    
}

echo '<script>location.href="teacher-profile.php";</script>';

?>