<?php
session_start();
include 'conn.php';

$username = $_SESSION['logged_username'];

if(isset($_POST['delete-stud-acc'])){
	//Get the id of the student
	$sql = "SELECT * FROM student WHERE stud_username = '$username'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	$sid = $row['stud_id'];
	echo $sid;
	
	$sql = "DELETE FROM student WHERE stud_id = $sid";
	if(mysqli_query($conn, $sql)){
		$sql = "DELETE FROM rating WHERE stud_id = $sid";
		if(mysqli_query($conn, $sql)){
			$sql = "SELECT COUNT(prog_id) AS prog_count FROM progress p, enrolment e WHERE (p.enro_id = e.enro_id) AND (e.stud_id = $sid)";
			$result = mysqli_query($conn, $sql);
    		$row = mysqli_fetch_assoc($result);
    		$progress = $row['prog_count'];
			
			if($progress == 0){
				$sql = "DELETE FROM enrolment WHERE enro_id = $enro_id";
				if(mysqli_query($conn, $sql)){
					$sql = "DELETE FROM qna_question WHERE stud_id = $sid";
					if(mysqli_query($conn, $sql)){
						$sql = "DELETE FROM answer WHERE stud_id = $sid";
						if(mysqli_query($conn, $sql)){
						}
					}
				}
			}else{
				$sql = "DELETE enrolment, progress FROM enrolment INNER JOIN progress WHERE (enrolment.enro_id = progress.enro_id) AND (enrolment.stud_id = $sid)";
				if(mysqli_query($conn, $sql)){
					$sql = "DELETE FROM qna_question WHERE stud_id = $sid";
					if(mysqli_query($conn, $sql)){
						$sql = "DELETE FROM answer WHERE stud_id = $sid";
						if(mysqli_query($conn, $sql)){
						}
					}
				}
			}
		}
		echo '<script>alert("Account Has Been Deleted.")</script>';
		echo '<script>window.location.href="index.php"</script>';
	}
	else{
		echo '<script>alert("Failed to Delete Your Account")</script>';
	}

}

//Step 5 - Close connection
mysqli_close($conn);
?>