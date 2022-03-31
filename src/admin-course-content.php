<?php
session_start();
include("conn.php");

header('Content-Type: text/html; charset=ISO-8859-1');


$logged_adm = $_SESSION['adm_username'];
$sql = "SELECT * FROM admin where adm_username = '$logged_adm' LIMIT 1";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$sid = $row['adm_id'];

$cid = $_GET['cid'];
$sql = "SELECT * FROM course c, teacher t WHERE (c.teac_id = t.teac_id) AND cour_id = '$cid'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$cour_name = $row['cour_name'];
$tid = $row['teac_id'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin-course-content.css">
    <link rel="icon" type="image/png" href="Images/Learneasy_favicon.png">
    <script src="https://kit.fontawesome.com/8e94eefdff.js" crossorigin="anonymous"></script>
    <title><?php echo $cour_name;?></title>
</head>
<body>
  <?php include("admin-nav.php")?>
    <div class="course-content-div">
        <p class="content-course-name"><?php echo $cour_name;?></p>
        <div class="course-video-chapter">
            <?php
            //Display the selected course detail
            $sql = "SELECT * FROM content WHERE cour_id = '$cid' AND cont_sequence = 1";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result);
            ?>
            <iframe id="course-content-iframe" name="course-video" src="<?php echo $row['cont_video_file'];?>" allowfullscreen></iframe>
            <div class="course-chapter">
                <p class="fixed-chapter">Chapters</p>
                <?php
                //Display the selected course detail
                $sql = "SELECT * FROM content WHERE cour_id = '$cid' ORDER BY cont_sequence";
                $result = mysqli_query($conn, $sql);

                if(mysqli_num_rows($result) > 0){
                
                while ($row = mysqli_fetch_array($result)){
                    $sequence = $row['cont_sequence'];
                ?>
                <div class="chapter-name-div">
                    <a href="<?php echo $row['cont_video_file'];?>" target="course-video">
                        <p class="chapter-name"><?php echo $row['cont_title'];?></p>
                    </a>

                </div>
                <?php
                    }
                }
                ?>
              
            </div>
        </div>
    </div>
    <?php 
    $sql = "SELECT * FROM course c, teacher t WHERE (c.teac_id = t.teac_id) AND cour_id = '$cid'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    $about = nl2br($row['cour_description']);
    $create_date = strtotime($row['cour_date']);
    $convert_create_date = date('Y/m/d', $create_date);
    $course_cat = $row['cour_category'];
    $tid = $row['teac_id'];
    $teac_first_name = $row['teac_first_name'];
    $teac_last_name = $row['teac_last_name'];
    $teac_bio = nl2br($row['teac_bio']);
    $teac_profile = $row['teac_profile_picture'];

    include("admin-course-tab.php")
    ?>
</body>
</html>