

<?php
session_start();

include 'conn.php';
$stud_username = "lisa"; //change the student sesstion
$cour_name = "Business Analysis Fundamentals"; //change course session you want
$sql = "SELECT * FROM  course c, teacher t, student s WHERE (c.teac_id = t.teac_id) AND (cour_name = '$cour_name') AND (stud_username = '$stud_username') LIMIT 1";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="rating.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <title>Rating</title>

    </head>
    <body>

        <!-- Trigger/Open The Modal -->
        <button id="give-rating-btn" title="Click to edit profile.">Rating Profile</button>

        <!-- The Modal -->
        <div id="rating-modal" class="rating-modal-overall">
            <!-- Modal content -->
            <div class="rating-modal-content">
                <div class="rating-modal-top-banner">
                    <div class="rating-modal-close-and-title">
                        <span class="close-rating-modal close-modal" title="Close"></span>
                        <p>Give Rating</p>
                    </div>
                </div>
                <form method = "POST" name="rating-modal-form" action = "insert-update-rating.php"  >
                    <!--To post the teacher id , student id and course id to rating php for record purpose-->
                    <input type="hidden" name="teac_id" value="<?php echo $row['teac_id'] ?>">
                    <input type="hidden" name="stud_id" value="<?php echo $row['stud_id'] ?>">
                    <input type="hidden" name="cour_id" value="<?php echo $row['cour_id'] ?>">
                    <!-- Teacher rating part -->
                    <div class="teacher-rating-section">
                        <div class="teacher-profile-pics">
                            <img id="teacher-modal-profile-pic" src="https://images.unsplash.com/photo-1499482125586-91609c0b5fd4?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=334&q=80" alt="">
                        </div>
                        <!-- Words  for Teacher rating part -->
                        <div class="teacher-rating-words">
                            <h2>How was your experience with <?php #echo $row['teac_username'] ?>?</h2>
                            <p>Your feedback matters</p>
                        </div>
                        <!-- Rating Star -->
                        <div class="rating-star-icon">
                            <input type="radio" name ="rate_teacher_value" id="star1" value="5" required="choose 1"><label for ="star1"></label>
                            <input type="radio" name ="rate_teacher_value" id="star2" value="4" required><label for ="star2"></label>
                            <input type="radio" name ="rate_teacher_value" id="star3" value="3" required><label for ="star3"></label>
                            <input type="radio" name ="rate_teacher_value" id="star4" value="2" required><label for ="star4"></label>
                            <input type="radio" name ="rate_teacher_value" id="star5" value="1" required><label for ="star5"></label>
                        </div>
                    </div>
                    <hr class="rating-modal-seperateline">
                    <!-- Course rating part -->
                    <div class="course-rating-section">
                        <p class="course-rating-title">Course Rating</p>
                        <div class="course-rating-detail">
                            <p class="course-rating-name"><?php echo $row['cour_name'] ?> </p>
                            <p class="course-rating-tag"><?php echo $row['cour_category'] ?></p>
                            <p class="course-rating-pubs-date">Published Date : <?php echo $row['cour_published_date']?></p>
                            <div class="rating-star-icon" id="course-rating-star">
                                <input type="radio" name ="rate_course_value" id="course-star1" value="5" required><label for ="course-star1"></label>
                                <input type="radio" name ="rate_course_value" id="course-star2" value="4" required><label for ="course-star2"></label>
                                <input type="radio" name ="rate_course_value" id="course-star3" value="3" required><label for ="course-star3"></label>
                                <input type="radio" name ="rate_course_value" id="course-star4" value="2" required><label for ="course-star4"></label>
                                <input type="radio" name ="rate_course_value" id="course-star5" value="1" required><label for ="course-star5"></label>
                            </div>
                        </div>
                    </div>
                    <!-- Comment box part -->
                    <div class="rating-comment-box">
                        <p class="rating-comment-box-title">Write a comment :</p>
                        <textarea name="rate_comment" id="" cols="30" rows="8" required></textarea>
                    </div>
                    <div class="submit-rating">
                        <button  title="Submit rating" id="submit" >Submit</button>
                    </div>
                </form>
            </div>
        </div>

        <script>
        // Get the modal
            var modal = document.getElementById("rating-modal");

        // Get the button that opens the modal
            var btn = document.getElementById("give-rating-btn");

        // Get the <span> element that close-modals the modal
            var span = document.getElementsByClassName("close-modal")[0];

        // When the user clicks the button, open the modal 
            btn.onclick = function () {
                modal.style.display = "block";
            }

        // When the user clicks on <span> (x), close-modal the modal
            span.onclick = function () {
                modal.style.display = "none";
            }

        // When the user clicks anywhere outside of the modal, close-modal it
            window.onclick = function (event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        </script>
</body>
</html>