<?php

session_start();
require("conn.php");

if (isset($_POST['submit-btn'])) {
    //Receive the input values from the student registration form
    $adm_first_name = $_POST['adm_first_name'];
    $adm_last_name = $_POST['adm_last_name'];
    $adm_username = $_POST['adm_username'];
    $adm_email = $_POST['adm_email'];
    $adm_password = $_POST['adm_password'];
    $adm_confirm_password = $_POST['adm_confirm_password'];

    if ($adm_password != $adm_confirm_password) {
        echo '<script>alert("Password and Confirm Password does not match.");</script>';
        echo '<script>window.history.go(-1);</script>';
    } 
    else 
    {
    $sql = "INSERT INTO admin(adm_id, adm_username, adm_password, adm_email, adm_first_name, adm_last_name) VALUES(NULL, '$adm_username', '".md5($adm_password)."','$adm_email', '$adm_first_name', '$adm_last_name')";
    if (mysqli_query($conn, $sql)){
        echo '<script>alert("Successfully added new Admin!");</script>';
        echo '<script> window.location.href="admin-mgadmin.php"; </script>';
    }else {
        echo '<script>alert("Unable to add Admin")</script>';
        echo '<script> window.location.href="admin-mgadmin.php"; </script>';
    }
}
}
?>