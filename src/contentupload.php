<?php
include("conn.php");

if(isset($_POST['upload-content-btn'])){
    $cid = $_POST['cid'];
    #echo $cid;
    $cont_title = $_POST['cont-title'];
    #echo $cont_title;
    $tid = $_POST['tid'];
    #echo $tid;
    $cour_name = $_POST['cn'];


    //For the uploaded picture
    $cont_file = $_FILES['cont-file']['name'];
    $randomno=rand(0,10000);
    $newname= "Content/".$randomno.'-'.$cont_file;
    $savename = $randomno.'-'.$cont_file;
    $destination = "Content/" . $savename;
    $tmp = $_FILES['cont-file']['tmp_name'];

    //move_uploaded_file($tmp, $destination);

    //Search is there content that belongs to the course in the table
    $sql = "SELECT * FROM content WHERE cour_id = $cid";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    if(mysqli_num_rows($result) > 0){
        $sql = "SELECT MAX(cont_sequence) AS max_sequence FROM content WHERE cour_id = $cid";
        $max = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($max);
        $the_max = $row['max_sequence'];
        $the_max++;
        
        //Insert the content into the table
        $sql = "INSERT INTO content(cont_id, cont_title, cont_video_file, cont_sequence, cour_id) VALUES(NULL, '$cont_title', '$newname', '$the_max', '$cid')";
        
        if (mysqli_query($conn, $sql)){
            move_uploaded_file($tmp, $destination);
            echo '<script>alert("Content added!")</script>';
            echo '<script type="text/javascript">location.href = "upload-content.php?cn='.$cour_name.'&tid='.$tid.'";</script>';
        }else {
            echo '<script>alert("Oppss! Something wrong. Please try again.")</script>';
            echo '<script type="text/javascript">location.href = "upload-content.php?cn='.$cour_name.'&tid='.$tid.'";</script>';
        }
    }else{
        $the_max = 1;
    
        //Insert the content into the table
        $sql = "INSERT INTO content(cont_id, cont_title, cont_video_file, cont_sequence, cour_id) VALUES(NULL, '$cont_title', '$newname', '$the_max', '$cid')";
        
        if (mysqli_query($conn, $sql)){
            move_uploaded_file($tmp, $destination);
            echo '<script>alert("Content added!")</script>';
            echo '<script type="text/javascript">location.href = "upload-content.php?cn='.$cour_name.'&tid='.$tid.'";</script>';
        }else {
            echo '<script>alert("Oppss! Something wrong. Please try again.")</script>';
            echo '<script type="text/javascript">location.href = "upload-content.php?cn='.$cour_name.'&tid='.$tid.'";</script>';
        }
        
    }
}

if(isset($_POST['ed-save'])){
    $tid = $_POST['tid'];
    #echo $tid;
    $cour_name = $_POST['cn'];
    $ed_cont_id = $_POST['ed-cont-id'];
    $ed_cont_title = $_POST['ed-cont-title'];
    $ed_cont_sequence = $_POST['ed-cont-sequence'];

    //For the uploaded picture
    $ed_cont_file = $_FILES['ed-cont-file']['name'];
    $randomno=rand(0,10000);
    $newname= "Content/".$randomno.'-'.$ed_cont_file;
    $savename = $randomno.'-'.$ed_cont_file;
    $destination = "Content/" . $savename;
    $tmp = $_FILES['ed-cont-file']['tmp_name'];

    if($tmp == ""){
        $sql = "SELECT * FROM content WHERE cont_id = '$ed_cont_id'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        $cont_video = $row['cont_video_file'];

        $sql = "UPDATE content SET cont_title = '$ed_cont_title', cont_sequence = '$ed_cont_sequence', cont_video_file = '$cont_video' WHERE(cont_id = '$ed_cont_id')";
        
        
        if (mysqli_query($conn, $sql)){
            echo '<script>alert("Your Content Has Been Successfully Updated")</script>';
            echo '<script type="text/javascript">location.href = "upload-content.php?cn='.$cour_name.'&tid='.$tid.'";</script>';
        }else{
            echo '<script>alert("Unable to update content")</script>';
            echo '<script type="text/javascript">location.href = "upload-content.php?cn='.$cour_name.'&tid='.$tid.'";</script>';
        }
        
    }else{
        $sql = "UPDATE content SET cont_title = '$ed_cont_title', cont_sequence = '$ed_cont_sequence', cont_video_file = '$newname' WHERE(cont_id = '$ed_cont_id')";

        if (mysqli_query($conn, $sql)){
            move_uploaded_file($tmp, $destination);
            echo '<script>alert("Your Content Has Been Successfully Updated")</script>';
            echo '<script type="text/javascript">location.href = "upload-content.php?cn='.$cour_name.'&tid='.$tid.'";</script>';
        }else{
            echo '<script>alert("Unable to update content")</script>';
            echo '<script type="text/javascript">location.href = "upload-content.php?cn='.$cour_name.'&tid='.$tid.'";</script>';
        }
    }
}
?>