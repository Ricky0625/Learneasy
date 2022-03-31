<?php

session_start();
include "conn.php";

$teac_id ='1';
$cour_name = $_GET['cn'];

$sql = 'SELECT * FROM course WHERE cour_name LIKE "'.$cour_name.'" AND teac_id ="'.$teac_id.'"';
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$cid = $row['cour_id'];
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="create-content.css">
    <link rel="icon" href="Images/LE_Favicon.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <title>Create Content</title>
</head>
<body> 
    <?php include ("nav.php"); ?> 

     <!--Create Course Titlebar column-->
    <div class="create-course-titlebar">
        <!--Create Course Words-->
        <div class="titlebar-content">
            <p>Create Course</p>
        </div>
    </div>

    <div class="content-container">
        <p>Course Content</p>
        <!--Input field for chapter name (video title) and video file attach butoon-->
    <form method="POST" action="content.php">
        <div class="content-details">
            <div class="info-box">
                <div class="video-details">
                    <label class="video-title">
                        <h3>Video Title :</h3>
                        <input type="text" name="cont_title[]" required>
                    </label>
                    <label class="video_sequence">
                        <h3>Sequence :</h3>
                        <input type="number" name="cont_sequence[]" value="1" required readonly>
                    </label>
                </div>
                <label class="video-file">
                    <h3>Video File :</h3>
                    <input type="file" name="cont_video_file[]" accept=".mp4" class="choose" required>
                </label>
            </div>
        </div>
        <div class="button">
            <button class="add-btn" id="add">Add</button>
            <input type="submit" value="Next" class="submit-btn">
            <input type="hidden" value="<?php echo $cid; ?>" name="cour_id">
        </div>
    </form>
    </div>

    <script>
        $(document).ready(function () {
        // allowed maximum input fields
        var max_input = 5;
        // initialize the counter for textbox
        var x = 1;
        // handle click event on Add More button
        $('.add-btn').click(function (e) {
        e.preventDefault();
        
        if (x < max_input) { // validate the condition
            x++; // increment the counter
            $('.content-details').append('<div class="info-box"><div class="video-details"><label class="video-title"><h3>Video Title :</h3><input type="text" name="cont_title[]" maxlength="100" required></label><label class="video_sequence"><h3>Sequence :</h3><input type="number" name="cont_sequence[]" value="'+x+'" required readonly></label></div><label class="video-file"><h3>Video File :</h3><input type="file" name="cont_video_file[]" multiple class="choose" multiple required accept=".mp4"></label><a href="#" class="remove-btn">Remove</a></div>'); 
        //hide the default "no file chosen"
        $(function () {
        $('input[type="file"]').change(function () {
          if ($(this).val() != "") {
                 $(this).css('color', '#333');
          }else{
                 $(this).css('color', 'transparent');
          }
        });
        })
        }
        });
        
        // handle click event of the remove link
        $('.content-details').on("click", ".remove-btn", function (e) {
        e.preventDefault();
        $(this).parent('div').remove();  // remove input field
        x--; // decrement the counter
        })

        });
        
        //hide the default "no file chosen"
        $(function () {
        $('input[type="file"]').change(function () {
          if ($(this).val() != "") {
                 $(this).css('color', '#333');
          }else{
                 $(this).css('color', 'transparent');
          }
        });
        })
    </script>
    <?php include ("footer.php"); ?> 
</body>
</html>
