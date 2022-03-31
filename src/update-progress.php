<?php
include("conn.php");
$sid = $_POST['sid'];
$cid = $_POST['cid'];
$sequence = $_POST['sequence'];
#$test = $_GET['sequence'];
#echo $sid;
#echo $cid;
#echo $test;

//Find the total content of the course
$content = "SELECT COUNT(cont_id) AS total_cont FROM content x, course c WHERE (x.cour_id = c.cour_id) AND (x.cour_id = $cid)";
$result = mysqli_query($conn, $content);
$row = mysqli_fetch_assoc($result);
$total_cont = $row['total_cont'];

//Find the enro id
$sql = "SELECT * FROM enrolment WHERE stud_id = $sid AND cour_id = $cid";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$eid = $row['enro_id'];
$enro_progress = $row['enro_progress'];


//To update or insert?
$sql = "SELECT * FROM progress WHERE enro_id = $eid AND cont_sequence = $sequence LIMIT 1";
$check_sql = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($check_sql);
$prog_status = $row['prog_status'];

if (mysqli_affected_rows($conn) != 1){
    $sql = "INSERT INTO progress (prog_id,prog_status,cont_sequence,enro_id) VALUES (NULL, 1, $sequence, $eid)";
    if (mysqli_query($conn, $sql)){
        $enro_progress++;
        $progsql = "UPDATE enrolment SET enro_progress = $enro_progress WHERE cour_id = $cid AND stud_id = $sid";
        if(mysqli_query($conn,$progsql)){
            echo '<script type="text/javascript">location.href = "course-content.php?cid='.$cid.'";</script>';
        }
    }else {
        echo '<script>alert("Update progress fail.")</script>';
        header("location: enroll-course.php?cid=$cid");
    }
}
else{
    if($prog_status == 1){
        $updatesql = "UPDATE progress SET prog_status = 0 WHERE enro_id = $eid AND cont_sequence = $sequence";
        if (mysqli_query($conn, $updatesql)){
            $enro_progress--;
            if($total_cont == $enro_progress){
                $progsql = "UPDATE enrolment SET enro_progress = '$enro_progress', enro_end_date = now() WHERE cour_id = $cid AND stud_id = $sid";
                if(mysqli_query($conn,$progsql)){
                    echo '<script type="text/javascript">location.href = "course-content.php?cid='.$cid.'";</script>';
                }
            }else{
                $progsql = "UPDATE enrolment SET enro_progress = '$enro_progress', enro_end_date = null WHERE cour_id = $cid AND stud_id = $sid";
                if(mysqli_query($conn,$progsql)){
                    echo '<script type="text/javascript">location.href = "course-content.php?cid='.$cid.'";</script>';
                }
            }
        }else {
            echo '<script>alert("Update progress fail.")</script>';
            header("location: enroll-course.php?cid=$cid");
        }
    }elseif($prog_status == 0){
        $updatesql = "UPDATE progress SET prog_status = 1 WHERE enro_id = $eid AND cont_sequence = $sequence";
        if (mysqli_query($conn, $updatesql)){
            $enro_progress++;
            if($total_cont == $enro_progress){
                $progsql = "UPDATE enrolment SET enro_progress = '$enro_progress', enro_end_date = now() WHERE cour_id = $cid AND stud_id = $sid";
                if(mysqli_query($conn,$progsql)){
                    echo '<script type="text/javascript">location.href = "course-content.php?cid='.$cid.'";</script>';
                }
            }else{
                $progsql = "UPDATE enrolment SET enro_progress = '$enro_progress', enro_end_date = null WHERE cour_id = $cid AND stud_id = $sid";
                if(mysqli_query($conn,$progsql)){
                    echo '<script type="text/javascript">location.href = "course-content.php?cid='.$cid.'";</script>';
                }
            }
            
        }else {
            echo '<script>alert("Update progress fail.")</script>';
            header("location: enroll-course.php?cid=$cid");
        }
    }

    
}

?> 