<?php
session_start();
include "conn.php";

$teac_id ='1';
$cour_id = $_GET['cid'];

$sql = 'SELECT * FROM course WHERE cour_id = "'.$cour_id.'" AND teac_id ="'.$teac_id.'"';
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$cid = $row['cour_id'];
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="createresources.css">
    <link rel="icon" href="Images/LE_Favicon.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <title>Add Resources</title>
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
        <p>Resources</p>
        <!--Input field for chapter name (video title) and video file attach butoon-->
    <form method="POST" action="uploadresource.php">
        <div class="content-details">
            <div class="info-box">
                <label class="res-title">
                    <h3>Resources Title :</h3>
                    <input type="text" name="res_title[]" maxlength="100" required>
                </label>
                <label class="res-file">
                    <h3>Resources File :</h3>
                    <input type="file" name="res_file[]" class="choose" accept=".docx,.jpg,.pdf,.png,.txt,.xlsx" required>   
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
            $('.content-details').append(`
            <div class="input-box">
            <div class="info-box">
            <label class="res-title">
                <h3>Video Title :</h3>
                <input type="text" name="res_title[]">
            </label>
            <label class="res-file">
                <h3>Video File :</h3>
                <input type="file" name="res_file[]" class="choose" accept=".docx,.jpg,.pdf,.png,.txt,.xlsx" required>
            </label>
                <a href="#" class="remove-btn">Remove</a>
            </div>
            `); 
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
