<?php
session_start();

if(!isset($_SESSION['logged_teacher'])){
    echo '<script>alert("You must log in to your account first.")</script>';
    echo '<script>location.href="Student-SignIn.php"</script>';
}
include("conn.php");

header('Content-Type: text/html; charset=ISO-8859-1');

//Find the info of teacher
$username = $_SESSION['logged_teacher'];
$finduser_sql = "SELECT * FROM teacher WHERE teac_username = '$username'";
$result = mysqli_query($conn, $finduser_sql);
$row = mysqli_fetch_array($result);
$tid = $row['teac_id'];
$fname = $row['teac_first_name'];
$lname = $row['teac_last_name'];
$teac_username = $row['teac_username'];
$teac_cover = $row['teac_cover_picture'];
$teac_profile = $row['teac_profile_picture'];
$teac_bio = nl2br($row['teac_bio']);
$join_date = strtotime($row['teac_join_date']);
$convert_join_date = date('Y/m/d', $join_date);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="course-card.css">
    <link rel="stylesheet" href="teacher-profile.css">
    <link rel="stylesheet" href="mo-dalss.css">
    
    <link rel="icon" type="image/png" href="Images/Learneasy_favicon.png">
    <script src="https://kit.fontawesome.com/8e94eefdff.js" crossorigin="anonymous"></script>
    <title><?php echo $fname;?> <?php echo $lname;?></title>
</head>
<body>
    <?php include("teacher-nav.php");?>
    <section class="top-profile">
        <div class="profile-section">
            <div class="cover">
                <img class="profile-cover container" src="Images/<?php echo $teac_cover;?>" alt="">
                <div class="overlay-blur container"></div>
            </div>
            <img id="profile-pic" src="Images/<?php echo $teac_profile;?>" alt="profile-pic">
            <div class="user-info">
                <div class="fullname-and-edit">
                    <?php
                    //Display the total number of review
                    $verifiedsql = "SELECT * FROM teacher WHERE teac_id = '$tid'";
                    $verifiedresult = mysqli_query($conn, $verifiedsql);
                    $row = mysqli_fetch_assoc($verifiedresult);
                    $verified = $row['teac_status'];
                    
                    if($verified == 1){
                      echo '<style type = "text/css">
                              .fa-check-circle {
                                display: block;
                                color: #FF6B58;
                                margin-left: 8px;
                              }
                              </style>';
                    }else{
                      echo '<style type = "text/css">
                              .fa-check-circle {
                                color: transparent;
                              }
                              </style>';
                    }
                    ?>
                    <div class="fullname">
                        <div style="display: flex; align-items:center;">
                            <p class="first-name"><?php echo $fname;?></p>
                            <p class="last-name"><?php echo $lname;?></p>
                            <i class="fas fa-check-circle"></i>
                        </div>
                    </div>
                    <button id="edit-profile-button" title="Click to edit profile.">Edit Profile<i class="fas fa-pen"></i></button>
                    <!-- The Modal -->
                    <div id="edit-profile-modal" class="modal">
                        <!-- Modal content -->
                        <form action="update-teac-profile.php" method="POST" enctype="multipart/form-data">
                            <div class="modal-content">
                                <div class="modal-top-banner">
                                    <div class="close-and-title">
                                        <span class="close-modal" title="Close"><i class="fas fa-times"></i></span>
                                        <p>Edit Profile</p>
                                    </div>
                                    <button type="submit" id="save-changes" title="Save changes" name="update-teac-profile">Save</button>
                                </div>
                                <div class="upload-profile-bg">
                                    <input type="file" id="real-profile" hidden="hidden" accept=".png,.jpg,.jpeg" name="uploadteacProfile">
                                    <div class="picture-column">
                                        <p class="name-label">Upload Profile Picture</p>
                                        <div class="upload-file">
                                            <button type="button" id="custom-button-profile">Upload</button>
                                            <span id="custom-profile-text" class="name-label">No file chosen, yet.</span>
                                        </div>
                                    </div>
                                    <input type="file" id="real-bg" hidden="hidden" accept=".png,.jpg,.jpeg" name="uploadteacCover">
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
                                            <input type="text" onkeyup="countupdatefname(this.value)" autocomplete="off" value="<?php echo $fname?>" maxlength="30" minlength="1" name="teac-fname">
                                        </div>
                                        <div class="modal-name">
                                            <div class="name-counter">
                                                <p class="name-label">Last Name</p>
                                                <span id="countlname"></span>
                                            </div>
                                            <input type="text" autocomplete="off" onkeyup="countupdatelname(this.value)" value="<?php echo $lname?>" maxlength="30" minlength="1" name="teac-lname">
                                        </div>
                                    </div>
                                    <div class="modal-bio">
                                        <div class="name-counter">
                                            <p class="bio-label">Bio</p>
                                            <span id="countbio"></span>
                                        </div>
                                        <textarea name="teac-bio-ed" id="" cols="30" rows="5" autocomplete="off" maxlength="250" onkeyup="countupdatebio(this.value)"><?php echo $row['teac_bio'];?></textarea>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <p class="username">@<?php echo $teac_username;?></p>
                <?php
                $sql = "SELECT AVG(rate_teacher_value) AS ratingteac FROM rating WHERE teac_id = '$tid'";
                $avgresult = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($avgresult);
                $ratingavg = round($row['ratingteac'],1);
                ?>
                <div class="teacher-rate-star">
                    <i class="fas fa-star"></i>
                    <p class="teacher-rating"><?php echo $ratingavg;?></p>
                </div>
                <div class="join-date">
                    <i class="far fa-calendar"></i>
                    <p class="exact-date">Joined <?php echo $convert_join_date?></p>
                </div>
                <div class="user-bio">
                    <i class="fas fa-comment-alt"></i>
                    <p class="bio"><?php echo $teac_bio;?></p>
                </div>
            </div>
        </div>
    </section>
    <section class="course-from-teacher">
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