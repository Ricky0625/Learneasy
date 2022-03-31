<?php
include("conn.php");

if(isset($_POST['upload-resource-btn'])){
    $cid = $_POST['cid'];
    $tid = $_POST['tid'];
    $res_title = $_POST['res-title'];

    //For the uploaded picture
    $res_file = $_FILES['res-file']['name'];
    $randomno=rand(0,10000);
    $newname= $randomno.'-'.$res_file;
    $savename = $randomno.'-'.$res_file;
    $destination = "Documents/" . $savename;
    $tmp = $_FILES['res-file']['tmp_name'];

    #move_uploaded_file($tmp, $destination);
        
    //Insert the content into the table
    $sql = "INSERT INTO resources(res_id, res_title, res_file, cour_id) VALUES(NULL, '$res_title', '$newname', '$cid')";
    if (mysqli_query($conn, $sql)){
        move_uploaded_file($tmp, $destination);
        echo '<script>alert("Resources added!")</script>';
        echo '<script type="text/javascript">location.href = "upload-resources.php?cid='.$cid.'&tid='.$tid.'";</script>';
    }else {
        echo '<script>alert("Oppss! Something wrong. Please try again.")</script>';
        echo '<script type="text/javascript">location.href = "upload-resources.php?cid='.$cid.'&tid='.$tid.'";</script>';
    }
}

if(isset($_POST['ed-save'])){
    $cid = $_POST['cid'];
    $tid = $_POST['tid'];
    $res_title = $_POST['ed-res-title'];
    $rid = $_POST['ed-res-id'];

    //For the uploaded picture
    $res_file = $_FILES['ed-res-file']['name'];
    $randomno=rand(0,10000);
    $newname= $randomno.'-'.$res_file;
    $savename = $randomno.'-'.$res_file;
    $destination = "Documents/" . $savename;
    $tmp = $_FILES['ed-res-file']['tmp_name'];

    if($tmp == ""){
        $sql = "SELECT * FROM resources WHERE res_id = '$rid'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        $res_file = $row['res_file'];

        $sql = "UPDATE resources SET res_title = '$res_title', res_file = '$res_file' WHERE(res_id = '$rid')";

        if (mysqli_query($conn, $sql)){
            echo '<script>alert("Resources updated!")</script>';
            echo '<script type="text/javascript">location.href = "upload-resources.php?cid='.$cid.'&tid='.$tid.'";</script>';
        }else {
            echo '<script>alert("Oppss! Something wrong. Please try again.")</script>';
            echo '<script type="text/javascript">location.href = "upload-resources.php?cid='.$cid.'&tid='.$tid.'";</script>';
        }

    }else{
        $sql = "UPDATE resources SET res_title = '$res_title', res_file = '$newname' WHERE(res_id = '$rid')";

        if (mysqli_query($conn, $sql)){
            move_uploaded_file($tmp, $destination);
            echo '<script>alert("Resources updated!")</script>';
            echo '<script type="text/javascript">location.href = "upload-resources.php?cid='.$cid.'&tid='.$tid.'";</script>';
        }else {
            echo '<script>alert("Oppss! Something wrong. Please try again.")</script>';
            echo '<script type="text/javascript">location.href = "upload-resources.php?cid='.$cid.'&tid='.$tid.'";</script>';
        }
    }
}
?>