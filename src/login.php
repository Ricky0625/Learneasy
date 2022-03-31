<?php
session_start();
$_SESSION['logged_username'] = NULL;
$_SESSION['logged_teacher'] = NULL;

//Establish connection to database
require("conn.php");

if (isset($_POST['stud_login'])){
    $role = $_POST['roleSelector'];
    //echo $role;
    $username = $_POST['log_username'];
    //echo $username;
    $password = $_POST['log_password'];
    //echo $password;

    //User Exist?
    if ($role === "student"){
        $stud_exist = "SELECT * FROM student WHERE stud_username = '$username'";
        $result = mysqli_query($conn, $stud_exist);
        $existed = mysqli_fetch_assoc($result);

        if ($existed) {
            //Fetch the column and validate the username
            //Check are they correct
            if ($existed['stud_username'] === $username){
                //Validate the password if the username is existed
                if ($existed['stud_password'] === md5($password)){
                    echo '<script>alert("Welcome Back, '."$username".'.");</script>';
                    echo '<script type="text/javascript">location.href = "student-home.php";</script>';
                    $_SESSION['logged_username'] = $username;
                }else{
                    //If the password is wrong
                    echo '<script>alert("Opps! Wrong Password.");</script>';
                    echo '<script type="text/javascript">history.go(-1);</script>';
                }
            }
        }else {
            echo '<script>alert("Student does not exists!");</script>';
            echo '<script type="text/javascript">location.href = "Student-SignIn.php";</script>';
        }
    }elseif ($role === "teacher"){
        $tea_exist = "SELECT * FROM teacher WHERE teac_username = '$username'";
        $result = mysqli_query($conn, $tea_exist);
        $existed = mysqli_fetch_assoc($result);

        if ($existed) {
            //Validate the username and password
            //Check are they correct
            if ($existed['teac_username'] === $username){
                //Validate the password if the username is existed
                if ($existed['teac_password'] === md5($password)){
                    echo '<script>alert("Welcome Back, '."$username".'.");</script>';
                    echo '<script type="text/javascript">location.href = "teacher-home.php";</script>';
                    $_SESSION['logged_teacher'] = $username;
                    echo $_SESSION['logged_teacher'];
                }else{
                    //If the password is wrong
                    echo '<script>alert("Opps! Wrong Password.");</script>';
                    echo '<script type="text/javascript">history.go(-1);</script>';
                }
            }
        }else {
            echo '<script>alert("Teacher does not exists!");</script>';
            echo '<script type="text/javascript">location.href = "Student-SignIn.php";</script>';
        }
    }
}
?>