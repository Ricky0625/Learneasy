<?php
session_start();

//Establish connection to database
require("conn.php");

//Register Student
if (isset($_POST['stud-reg'])) {
    //Receive the input values from the student registration form
    $stud_fname = $_POST['stud_first_name'];
    $stud_lname = $_POST['stud_last_name'];
    $stud_username = $_POST['stud_username'];
    $stud_email = $_POST['stud_email'];
    $stud_pass = $_POST['stud_password'];
    $stud_conpass = $_POST['stud_confirm_password'];
    $registered_date = strval(date("Y/m/d"));
    
    
    //Form Validation
    if (empty($stud_fname)) {
        echo '<script>alert("First name cannot be blank!")</script>';
        echo '<script>window.history.go(-1);</script>';
    }elseif (empty($stud_lname)) {
        echo '<script>alert("Last Name cannot be blank!")</script>';
        echo '<script>window.history.go(-1);</script>';
    }elseif (empty($stud_username)) {
        echo '<script>alert("Username cannot be blank!")</script>';
        echo '<script>window.history.go(-1);</script>';
    }elseif (empty($stud_email)) {
        echo '<script>alert("Email cannot be blank!")</script>';
        echo '<script>window.history.go(-1);</script>';
    }elseif (empty($stud_pass)) {
        echo '<script>alert("Password cannot be blank!")</script>';
        echo '<script>window.history.go(-1);</script>';
    }elseif ($stud_pass != $stud_conpass) {
        echo '<script>alert("Password and Confirm Password does not match.");</script>';
        echo '<script>window.history.go(-1);</script>';
    }else{
        //User Exist Validation
        $user_exist = "SELECT * FROM student WHERE stud_username='$stud_username' OR stud_email='$stud_email' LIMIT 1";
        $result = mysqli_query($conn, $user_exist);
        $existed = mysqli_fetch_assoc($result);
        
        if ($existed) {
            if ($existed['stud_username'] === $stud_username) {
                echo '<script>alert("Username already existed.");</script>';
                echo '<script>window.history.go(-1);</script>';
            }elseif ($existed['stud_email'] === $stud_email) {
                echo '<script>alert("Email already existed.");</script>';
                echo '<script>window.history.go(-1);</script>';
            }
        }else {
            //Insert data after there is no any error
            $query = "INSERT INTO student(stud_id, stud_first_name, stud_last_name, stud_username, stud_email, stud_password, stud_join_date) VALUES(NULL, '$stud_fname', '$stud_lname', '$stud_username', '$stud_email', '".md5($stud_pass)."', now())";
            if (mysqli_query($conn, $query)){
                echo '<script>alert("Registration completed! We are glad to have you on board!");</script>';
                echo '<script type="text/javascript">location.href = "index.php";</script>';
            }else {
                echo '<script>alert("Oppss! Something wrong. Please try again.")</script>';
                header("location: Student-SignUp.php");
            }
        }
    }
}
?>