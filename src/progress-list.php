<?php
session_start();
include("conn.php");
$cid = $_GET['cid'];

//Get Course Name
$sql = "SELECT * FROM course WHERE cour_id = $cid";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$cour_name = $row['cour_name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="course-tab.css">
    <title>Progress List</title>
</head>
<body>
    <?php include("teacher-nav.php")?>
    <section class="progress-list-section">
        <?php include("backBtn.php")?>
    <div class="progress-title-viewall">
        <p>Student Progress - <?php echo $cour_name;?></p>
      </div>
      <?php

        $contsql = "SELECT COUNT(*) cont_total FROM content WHERE cour_id = '$cid'";
        $contresult = mysqli_query($conn, $contsql);
        $row = mysqli_fetch_assoc($contresult);
        $totalcont = $row['cont_total'];

      $sql = "SELECT * FROM enrolment e, student s WHERE (e.stud_id = s.stud_id) AND (e.cour_id = $cid)";
      $progresult = mysqli_query($conn, $sql);
      if(mysqli_num_rows($progresult) > 0){
      
      while ($row = mysqli_fetch_array($progresult)){
        $enroll_date = strtotime($row['enro_start_date']);
        $convert_enroll_date = date('Y/m/d', $enroll_date);
        $current_prog = $row['enro_progress'];
        $enro_id = $row['enro_id'];

        if($current_prog > 0){
          $prog_percentage = round(($current_prog/$totalcont),2);
          $prog_width = $prog_percentage*290;
          echo '<style type = "text/css">
                  .prog-stud-orange-bar-'.$enro_id.' {
                    position: absolute;
                    height: 30px;
                    width: '.$prog_width.'px;
                    background-color: #FF6B58;
                    border-radius: 5px;
                    text-align: center;
                    font-family: Nunito;
                    font-style: normal;
                    font-weight: normal;
                    font-size: 12px;
                    line-height: 16px;
                    color: #FFFFFF;
                    vertical-align: middle;
                    box-sizing: border-box;
                    padding: 8px;
                  }
                  </style>';
        }elseif($current_prog == 0){
          $prog_percentage = 0;
          echo '<style type = "text/css">
                  .prog-stud-orange-bar-'.$enro_id.' {
                    display:none;
                  }
                  </style>';
        }
      ?>
      <div class="prog-stud-info">
        <img src="Images/<?php echo $row['stud_profile_picture']?>" alt="student profile picture">
        <div class="prog-name">
          <p class="prog-stud-fullname"><?php echo $row['stud_first_name']?> <?php echo $row['stud_last_name'];?></p>
          <p class="prog-stud-username">@<?php echo $row['stud_username']?></p>
        </div>
        <p class="prog-stud-date">Enrolled date: <?php echo $convert_enroll_date?></p>
        <div class="progress-bars">
          <div class="prog-stud-bar">
            <div class="prog-stud-orange-bar-<?php echo $enro_id;?>"><?php echo ($prog_percentage*100);?>%</div>
            <div class="prog-stud-grey-bar"></div>
          </div>
        </div>
      </div>
      <hr class="progress-seperator">
      <?php
        }
      }else{
      ?>
      <div class="tab-empty-state">
        <img src="Images/tab-empty-state.png" alt="">
        <p>Nothing here...</p>
      </div>
      <?php
      }
      ?>
      </section>
      <?php include("footer.php")?>
</body>
</html>