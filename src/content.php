<?php
include "conn.php";

if ((isset($_POST["cont_title"]) && is_array($_POST["cont_title"])) + (isset($_POST["cont_video_file"]) && is_array($_POST["cont_video_file"])) + (isset($_POST["cont_sequence"]) && is_array($_POST["cont_sequence"])))
{ 

  $cont_title = $_POST["cont_title"];
  $cont_video_file = $_POST["cont_video_file"];
  $cour_id = $_POST["cour_id"];
  $cont_sequence = $_POST["cont_sequence"];
  echo $cour_id;

  echo '<pre>';
  print_r($_POST["cont_title"]);
  print_r($_POST["cont_video_file"]);
  print_r($_POST["cont_sequence"]);
  echo '</pre>';
  
  foreach ($cont_title as $key => $value) {
    $sql = "INSERT INTO content(cont_title, cont_video_file, cour_id, cont_sequence) VALUES ('".$value."','".$cont_video_file[$key]."','".$cour_id."','".$cont_sequence[$key]."')";
    if (mysqli_query($conn, $sql)) {
      $cour_id = $_POST['cour_id'];
      echo '<script>alert("Successfully added your video content")</script>';
      echo '<script> window.location.href="createresource.php?cid='.$cour_id.'"; </script>';
      }else{
      echo '<script>alert("Failed to add your video content")</script>';
      echo '<script> window.location.href="createcontent.php"; </script>';
      }
  }
}  
?>




