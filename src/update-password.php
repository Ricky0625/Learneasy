
<?php
session_start();
include 'conn.php';

$username = $_SESSION['logged_username'];
$current_pass = md5($_POST['stu-cur-pass']);
$new_pass = $_POST['stu-new-pass'];
$conf_pass = $_POST['stu-conf-pass'];

$sql = "SELECT * FROM student WHERE (stud_password ='$current_pass') AND (stud_username= '$username')";
$cur_pass = mysqli_query($conn, $sql);
if (mysqli_affected_rows($conn) != 1) {

  echo '<script>alert("Current Password Does Not Matched. Pleasr Try Again")</script>';
  echo '<script>window.location.href = "setting.php"</script>';
  }elseif ($new_pass != $conf_pass) {
echo '<script>alert("The password and confirmation do not match. Please re-enter your password.")</script>';
echo '<script>window.location.href="setting.php"</script>';
}else{	
$sql = 'UPDATE student SET stud_password ="'.md5($new_pass).'" WHERE stud_username = "'.$username.'"';

if (mysqli_query($conn, $sql))
    echo '<script>alert("Successfully UPDATED.")</script>';
else
    echo '<script>alert("Unable to update data")</script>';


mysqli_close($conn);

echo '<script>window.location.href="setting.php";</script>';
  
}
?>

