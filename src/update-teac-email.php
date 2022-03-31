
<?php
session_start();
include 'conn.php';
$username = $_SESSION['logged_teacher'];

$new_email = $_POST['teac-new-email'];
$pass = md5($_POST['teac-password']);


$sql = "SELECT * FROM teacher WHERE (teac_password ='$pass') AND (teac_username= '$username')";
$conf_pass = mysqli_query($conn, $sql);
if (mysqli_affected_rows($conn) != 1) {
  echo '<script>alert("Password Does Not Matched. Pleasr Try Again")</script>';
  echo '<script>window.location.href = "setting-teac.php"</script>';
  }else{	
$sql = "UPDATE teacher SET teac_email = '$new_email' WHERE teac_username= '$username'";

if (mysqli_query($conn, $sql))
    echo '<script>alert("Email Has Been Change Successfully")</script>';
else
    echo '<script>alert("Unable to change your email")</script>';

//Step 5
mysqli_close($conn);

echo '<script>window.location.href="setting-teac.php";</script>';
  }
?>

