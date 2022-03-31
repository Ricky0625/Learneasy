
<?php
session_start();
include 'conn.php';
$username = $_SESSION['logged_username'];

$new_email = $_POST['stu-new-email'];
$pass = md5($_POST['stu-password']);


$sql = "SELECT * FROM student WHERE (stud_password ='$pass') AND (stud_username= '$username')";
$conf_pass = mysqli_query($conn, $sql);
if (mysqli_affected_rows($conn) != 1) {
  echo '<script>alert("Password Does Not Matched. Pleasr Try Again")</script>';
  echo '<script>window.location.href = "setting.php"</script>';
  }else{	
$sql = "UPDATE student SET stud_email = '$new_email' WHERE stud_username= '$username'";

if (mysqli_query($conn, $sql))
    echo '<script>alert("Email Has Been Change Successfully")</script>';
else
    echo '<script>alert("Unable to change your email")</script>';

//Step 5
mysqli_close($conn);

echo '<script>window.location.href="setting.php";</script>';
  }
?>

