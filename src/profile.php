<?php
session_start();

if(!isset($_SESSION['logged_username'])){
    echo '<script>alert("You must log in to your account first.")</script>';
    echo '<script>location.href="Student-SignIn.php"</script>';
}
include("conn.php");

header('Content-Type: text/html; charset=ISO-8859-1');

//Find the name of the logged user
$logged_username = $_SESSION['logged_username'];
$finduser_sql = "SELECT * FROM student WHERE stud_username = '$logged_username'";
$result = mysqli_query($conn, $finduser_sql);
$row = mysqli_fetch_array($result);
$sid = $row['stud_id'];
$fname = $row['stud_first_name'];
$lname = $row['stud_last_name'];
$join_date = strtotime($row['stud_join_date']);
$convert_join_date = date('Y/m/d', $join_date);
$bio = str_replace(array("&lsquo;", "\""), "'", htmlspecialchars($row['stud_bio']));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="userprofile.css">
    <link rel="stylesheet" href="mo-dalss.css">
    <link rel="icon" type="image/png" href="Images/Learneasy_favicon.png">
    <script src="https://kit.fontawesome.com/8e94eefdff.js" crossorigin="anonymous"></script>
    <title><?php echo $fname;?> <?php echo $lname;?></title>
</head>
<body>
    <?php include("nav.php");?>
    <section class="top-profile">
        <div class="profile-section">
            <div class="cover">
                <img class="profile-cover container" src="Images/<?php echo $row['stud_cover_picture'];?>" alt="">
                <div class="overlay-blur container"></div>
            </div>
            <img id="profile-pic" src="Images/<?php echo $row['stud_profile_picture'];?>" alt="profile-pic">
            <div class="user-info">
                <div class="fullname-and-edit">
                    <div class="fullname">
                        <p class="first-name"><?php echo $fname;?></p>
                        <p class="last-name"><?php echo $lname;?></p>
                    </div>
                    <button id="edit-profile-button" title="Click to edit profile.">Edit Profile<i class="fas fa-pen"></i></button>
                    <!-- The Modal -->
                    <div id="edit-profile-modal" class="modal">
                        <!-- Modal content -->
                        <form action="update-profile.php" method="POST" enctype="multipart/form-data">
                            <div class="modal-content">
                                <div class="modal-top-banner">
                                    <div class="close-and-title">
                                        <span class="close-modal" title="Close"><i class="fas fa-times"></i></span>
                                        <p>Edit Profile</p>
                                    </div>
                                    <button type="submit" id="save-changes" title="Save changes" name="update-profile">Save</button>
                                </div>
                                <div class="upload-profile-bg">
                                    <input type="file" id="real-profile" hidden="hidden" accept=".png,.jpg,.jpeg" name="uploadProfile">
                                    <div class="picture-column">
                                        <p class="name-label">Upload Profile Picture</p>
                                        <div class="upload-file">
                                            <button type="button" id="custom-button-profile">Upload</button>
                                            <span id="custom-profile-text" class="name-label">No file chosen, yet.</span>
                                        </div>
                                    </div>
                                    <input type="file" id="real-bg" hidden="hidden" accept=".png,.jpg,.jpeg" name="uploadCover">
                                    <div class="picture-column">
                                        <p class="name-label">Upload Cover Picture</p>
                                        <div class="upload-file">
                                            <button type="button" id="custom-button-cover">Upload</button>
                                            <span id="custom-cover-text" class="name-label">No file chosen, yet.</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="edit-info">
                                    <div class="flexbox-for-names">
                                        <div class="modal-name">
                                            <div class="name-counter">
                                                <p class="name-label">First Name</p>
                                                <span id="countfname"></span>
                                            </div>
                                            <input type="text" onkeyup="countupdatefname(this.value)" autocomplete="off" value="<?php echo $fname?>" maxlength="30" minlength="1" name="fname">
                                        </div>
                                        <div class="modal-name">
                                            <div class="name-counter">
                                                <p class="name-label">Last Name</p>
                                                <span id="countlname"></span>
                                            </div>
                                            <input type="text" autocomplete="off" onkeyup="countupdatelname(this.value)" value="<?php echo $lname?>" maxlength="30" minlength="1" name="lname">
                                        </div>
                                    </div>
                                    <div class="modal-bio">
                                        <div class="name-counter">
                                            <p class="bio-label">Bio</p>
                                            <span id="countbio"></span>
                                        </div>
                                        <textarea name="bio" id="" cols="30" rows="5" autocomplete="off" maxlength="250" onkeyup="countupdatebio(this.value)"><?php echo $bio;?></textarea>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <p class="username">@<?php echo $row['stud_username'];?></p>
                <div class="join-date">
                    <i class="far fa-calendar"></i>
                    <p class="exact-date">Joined <?php echo $convert_join_date?></p>
                </div>
                <div class="user-bio">
                    <i class="fas fa-comment-alt"></i>
                    <p class="bio"><?php echo nl2br($row['stud_bio']);?></p>
                </div>
            </div>
        </div>
    </section>
    <?php
    $num_of_course_sql = "SELECT * FROM enrolment WHERE stud_id = '$sid'";
    $resultNum = mysqli_query($conn, $num_of_course_sql);
    if($resultNum){
        
        $rowNum = mysqli_num_rows($resultNum);

        if($rowNum){
            $num_course = $rowNum;
        }else{
            $num_course = 0;
        }
        mysqli_free_result($resultNum);
    }
    ?>
    <section class="course-stats">
        <div class="num-of-course">
            <div class="nof-icon-label">
                <i class="fas fa-book"></i>
                <p class="nof-label">Number of Course Enrolled</p>
            </div>
            <p class="nof-value"><?php echo $num_course;?></p>
        </div>
        <?php
        $favorite = "-";
        $join_business = "SELECT * FROM enrolment LEFT JOIN course ON course.cour_id = enrolment.cour_id WHERE enrolment.stud_id = '$sid' AND course.cour_category = 'Business'";
        $resultBus = mysqli_query($conn, $join_business);
        if($resultBus){
            
            $rowBus = mysqli_num_rows($resultBus);

            if($rowBus){
                $num_bus = $rowBus;
            }else{
                $num_bus = 0;
            }
            mysqli_free_result($resultBus);
        }

        $join_design = "SELECT * FROM enrolment LEFT JOIN course ON course.cour_id = enrolment.cour_id WHERE enrolment.stud_id = '$sid' AND course.cour_category = 'Design'";
        $resultDes = mysqli_query($conn, $join_design);
        if($resultDes){
            
            $rowDes = mysqli_num_rows($resultDes);

            if($rowDes){
                $num_des = $rowDes;
            }else{
                $num_des = 0;
            }
            mysqli_free_result($resultDes);
        }

        $join_it = "SELECT * FROM enrolment LEFT JOIN course ON course.cour_id = enrolment.cour_id WHERE enrolment.stud_id = '$sid' AND course.cour_category = 'IT'";
        $resultIt = mysqli_query($conn, $join_it);
        if($resultIt){
            
            $rowIt = mysqli_num_rows($resultIt);

            if($rowIt){
                $num_it = $rowIt;
            }else{
                $num_it = 0;
            }
            mysqli_free_result($resultIt);
        }

        if($num_bus>$num_des AND $num_bus>$num_it){
            $favorite = 'Business';
        }
        if($num_des>$num_it AND $num_des>$num_bus){
            $favorite = 'Design';
        }
        if($num_it>$num_bus AND $num_it>$num_des){
            $favorite = 'IT';
        }
        ?>
        <div class="fav-course">
            <div class="fav-icon-label">
                <i class="fas fa-heart"></i>
                <p class="fav-course-label">My favorite Course</p>
            </div>
            <p class="fav-course-value"><?php echo $favorite;?></p>
        </div>
    </section>
    <?php include("footer.php");?>
    <script>
    // Get the modal
    var modal = document.getElementById("edit-profile-modal");
    
    // Get the button that opens the modal
    var btn = document.getElementById("edit-profile-button");
    
    // Get the <span> element that close-modals the modal
    var span = document.getElementsByClassName("close-modal")[0];
    
    // When the user clicks the button, open the modal 
    btn.onclick = function() {
      modal.style.display = "block";
    }
    
    // When the user clicks on <span> (x), close-modal the modal
    span.onclick = function() {
      modal.style.display = "none";
    }
    
    // When the user clicks anywhere outside of the modal, close-modal it
    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }
    </script>

    <!--Count the first name characters-->
    <script>
    function countupdatefname(str) {
        var length = str.length;
        document.getElementById("countfname").innerHTML = length + '/30';
    }
    </script>

    <!--Count the last name characters-->
    <script>
    function countupdatelname(str) {
        var length = str.length;
        document.getElementById("countlname").innerHTML = length + '/30';
    }
    </script>

    <!--Count the bio characters-->
    <script>
    function countupdatebio(str) {
        var length = str.length;
        document.getElementById("countbio").innerHTML = length + '/250';
    }
    </script>

    <!--Javascript to turn normal button to a upload file button-->
    <script type="text/javascript">
        const realFileBtn = document.getElementById("real-profile");
        const customBtn = document.getElementById("custom-button-profile");
        const customTxt = document.getElementById("custom-profile-text");

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

    <!--Javascript to turn normal button to a upload file button-->
    <script type="text/javascript">
        const realCoverBtn = document.getElementById("real-bg");
        const customButton = document.getElementById("custom-button-cover");
        const customCoverTxt = document.getElementById("custom-cover-text");

        customButton.addEventListener("click", function(){
            realCoverBtn.click();
        });

        realCoverBtn.addEventListener("change", function(){
            if (realCoverBtn.value) {
                customCoverTxt.innerHTML = realCoverBtn.value.match(/[\/\\]([\w\d\s\.\-\(\)]+)$/)[1];
            } else{
                customCoverTxt.innerHTML = "No file chosen, yet."
            }
        });
    </script>
</body>
</html>