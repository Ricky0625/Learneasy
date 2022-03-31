
<?php
session_start();
include 'conn.php';

$username = $_SESSION['logged_teacher'];
$current_pass = md5($_POST['teac-cur-pass']);
$new_pass = $_POST['teac-new-pass'];
$conf_pass = $_POST['teac-conf-pass'];

$sql = "SELECT * FROM teacher WHERE (teac_password ='$current_pass') AND (teac_username= '$username')";
$cur_pass = mysqli_query($conn, $sql);
if (mysqli_affected_rows($conn) != 1) {

  echo '<script>alert("Current Password Does Not Matched. Pleasr Try Again")</script>';
  echo '<script>window.location.href = "setting-teac.php"</script>';
  }elseif ($new_pass != $conf_pass) {
echo '<script>alert("The password and confirmation do not match. Please re-enter your password.")</script>';
echo '<script>window.location.href="setting-teac.php"</script>';
}else{	
$sql = 'UPDATE teacher SET teac_password ="'.md5($new_pass).'" WHERE teac_username = "'.$username.'"';

if (mysqli_query($conn, $sql))
    echo '<script>alert("Successfully UPDATED.")</script>';
else
    echo '<script>alert("Unable to update password")</script>';


mysqli_close($conn);

echo '<script>window.location.href="setting-teac.php";</script>';
  
}
?>

