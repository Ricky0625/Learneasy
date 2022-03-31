<?php
include "conn.php";

if ((isset($_POST["res_title"]) && is_array($_POST["res_title"])) + (isset($_POST["res_file"]) && is_array($_POST["res_file"])))
{ 
    
  $res_title = $_POST["res_title"];
  $res_file = $_POST["res_file"];
  $cour_id = $_POST["cour_id"];

  foreach ($res_title as $key => $value) {
    $sql = "INSERT INTO resources(res_title, res_file, cour_id) VALUES ('".$value."','".$res_file[$key]."','".$cour_id."')";
    if (mysqli_query($conn, $sql)) {
        $cour_id = $_POST['cour_id'];
        echo '<script>alert("Successfully added your resources")</script>';
        echo '<script> window.location.href="createquiz.php?cid='.$cour_id.'";</script>';
        }else{
        echo '<script>alert("Failed to add your resources")</script>';
        echo '<script> window.location.href="createresource.php"; </script>';
        }
  }
}

?>