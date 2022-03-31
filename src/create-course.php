<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="create-course.css">
    <link rel="icon" type="image/png" href="Images/Learneasy_favicon.png">
    <title>Create Course</title>
</head>
<body>
    <?php include("teacher-nav.php")?>
    <section class="cc-create-course">
        <?php include("backBtn.php")?>
        <p class="cc-main-title">Create Course</p>
        <form action="coursecreate.php" method="POST" enctype="multipart/form-data">
            <div class="cc-flex cc-div">
                <div class="cc-cour-name">
                    <p class="cc-label">Course Name:</p>
                    <input type="text" name="cour_name" id="cc-in-cour-name" autocomplete="off" required>
                </div>
                <div class="cc-cour-category">
                    <p class="cc-label">Categories:</p>
                    <select name="cour_category" id="cc-op-cour-category" required>
                        <option value="NULL"></option>
                        <option value="Business">Business</option>
                        <option value="Design">Design</option>
                        <option value="IT">IT</option>
                    </select>
                </div>
            </div>
            <div class="cc-about-class cc-div">
                <p class="cc-label">About the Class:</p>
                <textarea name="cour_des" id="cc-ta-about" cols="30" rows="10" required></textarea>
            </div>
            <div class="cc-cour-cover cc-div">
                <p class="cc-label">Course Cover Picture:</p>
                <input type="file" name="cour-cover" required id="real-cover" accept="image/*" hidden/>
                <div class="flex-row upload-file">
                    <button type="button" id="custom-cover-btn">Choose File</button>
                    <span id="custom-cover-span">No file chosen, yet.</span>
                </div>
            </div>
            <div class="cc-button cc-div">
                <button type="button" class="cc-cancel" onclick="location.href='mycourse.php'">Cancel</button>
                <input type="submit" class="cc-create" name="create-course-btn" value="Next"></input>
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