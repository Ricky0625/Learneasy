<?php

include "conn.php";
$teac_first_name = $_POST["teac_first_name"];
$teac_last_name = $_POST["teac_last_name"];
$teac_username = $_POST["teac_username"];
$teac_email = $_POST["teac_email"];
$teac_password = $_POST["teac_password"];
$teac_confirm_password = $_POST["teac_confirm_password"];
$teac_join_date = $_POST["teac_join_date"];
$teac_edu_proof = $_FILES['teac_edu_proof']['name'];
$tmp = $_FILES['teac_edu_proof']['tmp_name'];
$file_name = $teac_edu_proof;
move_uploaded_file($tmp, "Documents/" . $file_name);


$sql_username = "SELECT * FROM teacher WHERE teac_username='$teac_username'";
$sql_email = "SELECT * FROM teacher WHERE teac_email='$teac_email'";
$res_username = mysqli_query($conn, $sql_username);
$res_email = mysqli_query($conn, $sql_email);


if ($teac_password != $teac_confirm_password) {
    echo '<script>alert("Your password does not match with comfirm password")</script>';
    echo '<script>window.location.href="teacher-register.php"</script>';
} elseif (mysqli_num_rows($res_username) > 0) {
    echo '<script>alert("Username Already Exist ")</script>';
    echo '<script>window.location.href = "teacher-register.php"</script>';
} elseif (mysqli_num_rows($res_email) > 0) {
    echo '<script>alert("Email Already Exist ")</script>';
    echo '<script>window.location.href = "teacher-register.php"</script>';
} else {
    $sql = 'INSERT INTO teacher (teac_first_name,teac_last_name,teac_username,teac_join_date,teac_email,teac_password,teac_edu_proof)
        VALUES ("' . $teac_first_name . '","' . $teac_last_name . '","' . $teac_username . '","' . $teac_join_date . '","' . $teac_email . '","' . md5($teac_password) . '","' . $file_name . '")';
    if (mysqli_query($conn, $sql)) {
        echo'<script>alert("Teacher Registrtion Successful")</script>';
        echo'<script>window.location.href="teacher-register.php"</script>';
    } else {
        echo'<script>alert("Teacher registrtion failed")</script>';
        echo'<script>window.location.href="teacher-register.php"</script>';
    }
}
?>