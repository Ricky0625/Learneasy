<?php
include "conn.php";

if ((isset($_POST["quques_number"]) && is_array($_POST["quques_number"])) + (isset($_POST["quques_question"]) && is_array($_POST["quques_question"])) + (isset($_POST["quques_correct_answer"]) && is_array($_POST["quques_correct_answer"])) + (isset($_POST["quques_choices_A"]) && is_array($_POST["quques_choices_A"])) + (isset($_POST["quques_choices_B"]) && is_array($_POST["quques_choices_B"])) + (isset($_POST["quques_choices_C"]) && is_array($_POST["quques_choices_C"])) + (isset($_POST["quques_choices_D"]) && is_array($_POST["quques_choices_D"])) + (isset($_POST["quques_score"]) && is_array($_POST["quques_score"])) +  (isset($_POST["quques_id"]) && is_array($_POST["quques_id"])))
{ 
    
  $quques_number = $_POST["quques_number"];
  $quques_question = $_POST["quques_question"];
  $quques_correct_answer = $_POST["quques_correct_answer"];
  $quques_choices_A = $_POST["quques_choices_A"];
  $quques_choices_B = $_POST["quques_choices_B"];
  $quques_choices_C = $_POST["quques_choices_C"];
  $quques_choices_D = $_POST["quques_choices_D"];
  $quques_score = $_POST["quques_score"];
  $quiz_id = $_POST["quiz_id"];
  $quques_id = $_POST["quques_id"];
  

foreach ($quques_id as $key => $value){
$sql = "UPDATE quiz_question SET quques_number ='".$quques_number[$key]."', quques_question ='".$quques_question[$key]."', quques_correct_answer = '".$quques_correct_answer[$key]."', quques_choices_A = '".$quques_choices_A[$key]."', quques_choices_B ='".$quques_choices_B[$key]."', quques_choices_C = '".$quques_choices_C[$key]."', quques_choices_D = '".$quques_choices_D[$key]."', quques_score = '".$quques_score[$key]."', quiz_id = '".$quiz_id."' WHERE quques_id = '$value'";
if (mysqli_query($conn, $sql)) {
  $quiz_id = $_POST['quiz_id'];
  echo '<script>alert("Successfully updated Quiz Questions")</script>';
  echo '<script> window.location.href="Teacher-quizform.php?qid='.$quiz_id.'"; </script>';

  }else{
  $quiz_id = $_POST['quiz_id'];
  echo '<script>alert("Failed to edit Quiz Questions")</script>';
  echo '<script> window.location.href="teacher-edit-upload-question.php?qid='.$quiz_id.'"; </script>';
}
}
}
?>

