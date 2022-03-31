<?php
session_start();
include("conn.php");

$cid = $_GET['cour_id'];

$teac_username = $_SESSION['logged_teacher'];
$sql = "SELECT * FROM teacher WHERE teac_username = '$teac_username'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$tid = $row['teac_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="create-course.css">
    <link rel="icon" type="image/png" href="Images/Learneasy_favicon.png">
    <title>Edit Course</title>
</head>
<body>
    <?php include("teacher-nav.php")?>
    <section class="cc-create-course">
        <?php include("backBtn.php")?>
        <?php
        //echo the course detail
        $sql = "SELECT * FROM course WHERE cour_id = '$cid'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        $cour_name = $row['cour_name'];
        $cour_des = $row['cour_description'];
        $cour_category = $row['cour_category'];

        if($cour_category == "Business"){
            $business = "selected";
            $design = "";
            $it = "";
        }elseif($cour_category == "Design"){
            $business = "";
            $design = "selected";
            $it = "";
        }elseif($cour_category == "IT"){
            $business = "";
            $design = "";
            $it = "selected";
        }else {
            $business = "";
            $design = "";
            $it = "";
        }
        ?>
        <div class="ed-navigate">
            <button onclick="location.href='edit-course.php?cour_id=<?php echo $cid;?>'">Course Detail</button>
            <button onclick="location.href='upload-content.php?cn=<?php echo $cour_name?>&tid=<?php echo $tid?>&cid=<?php echo $cid;?>'">Upload Content</button>
            <button onclick="location.href='upload-resources.php?cid=<?php echo $cid?>&cn=<?php echo $row['cour_name']?>&tid=<?php echo $tid?>'">Upload Resource</button>
            <button onclick="location.href='createquiz.php?cid=<?php echo $cid?>&cn=<?php echo $cour_name?>&tid=<?php echo $tid?>'">Create Quiz</button>
        </div>
        <div style="display: flex; flex-direction:row; justify-content:space-between; align-items:center;">
            <p class="cc-main-title">Course</p>
            <button type="button" class="cc-edit" style="background-color: #F2617B;" onclick="location.href='delete-course?cid=<?php echo $cid;?>'">Delete Course</button>
        </div>
        <form action="coursecreate.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="cid" value="<?php echo $cid?>"">
            <div class="cc-flex cc-div">
                <div class="cc-cour-name">
                    <p class="cc-label">Course Name:</p>
                    <input type="text" name="cour_name" id="cc-in-cour-name" autocomplete="off" required value="<?php echo $cour_name?>">
                </div>
                <div class="cc-cour-category">
                    <p class="cc-label">Categories:</p>
                    <select name="cour_category" id="cc-op-cour-category" required>
                        <option value="NULL"></option>
                        <option value="Business" <?php echo $business?>>Business</option>
                        <option value="Design" <?php echo $design?>>Design</option>
                        <option value="IT" <?php echo $it?>>IT</option>
                    </select>
                </div>
            </div>
            <div class="cc-about-class cc-div">
                <p class="cc-label">About the Class:</p>
                <textarea name="cour_des" id="cc-ta-about" cols="30" rows="10"><?php echo $cour_des?></textarea>
            </div>
            <div class="cc-cour-cover cc-div">
                <p class="cc-label">Course Cover Picture:</p>
                <input type="file" name="cour-cover" id="real-cover" accept="image/*" hidden/>
                <div class="flex-row upload-file">
                    <button type="button" id="custom-cover-btn">Choose File</button>
                    <span id="custom-cover-span">No file chosen, yet.</span>
                </div>
            </div>
            <div class="cc-button cc-div">
                <button type="button" class="cc-cancel" onclick="location.href='mycourse.php'">Cancel</button>
                <input type="submit" class="cc-create" name="edit-course-btn" value="Next"></input>
            </div>
        </form>
    </section>

    <!--Javascript to turn normal button to a upload file button-->
    <script type="text/javascript">
        const realFileBtn = document.getElementById("real-cover");
        const customBtn = document.getElementById("custom-cover-btn");
        const customTxt = document.getElementById("custom-cover-span");

        customBtn.addEventListener("click", function(){
            realFileBtn.click();
        });

        realFileBtn.addEventListener("change", function(){
            if (realFileBtn.value) {
                customTxt.innerHTML = realFileBtn.value.match(/[\/\\]([\w\d\s\.\-\(\)]+)$/)[1];
            } else{
                customTxt.innerHTML = "No file chosen, yet."
            }
        });
    </script>
</body>
</html>