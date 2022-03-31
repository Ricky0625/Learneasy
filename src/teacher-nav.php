<?php
include("conn.php");

$logged_username = $_SESSION['logged_teacher'];
$finduser_sql = "SELECT * FROM teacher WHERE teac_username = '$logged_username'";
$result = mysqli_query($conn, $finduser_sql);
$row = mysqli_fetch_array($result);

$profile_pic = $row['teac_profile_picture'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="teacher-nav.css">
    <link rel="stylesheet" href="logout-confirmations.css">
    <link rel="icon" type="image/png" href="Images/Learneasy_favicon.png">
    <script src="https://kit.fontawesome.com/8e94eefdff.js" crossorigin="anonymous"></script>
</head>
<body>
    <section class="top-nav-bar">
        <div class="left-nav">
            <a id="learneasy-logo" href="teacher-home.php"><img src="Images/Learneasy-top-logo.png" alt=""></a>
            <nav>
                <ul class="main-menu">
                    <li><a href="mycourse.php">My Courses</a></li>
                    <li><a href="AboutUs.php">About Us</a></li>
                    <li><a href="FAQ.php">FAQ</a></li>
                </ul>
            </nav>
        </div>
        <div class="right-nav">
            <div>
                <img class="profile-circle" src="Images/<?php echo $profile_pic;?>" alt="Profile Picture">
            </div>
            <div>
                <ul class="my-account">
                    <li><a href="">My Account <i class="fas fa-caret-down"></i></a>
                        <ul class="account-sub">
                            <li><a href="teacher-profile.php" title="Profile">Profile</a></li>
                            <li><a href="setting-teac.php" title="Settings">Settings</a></li> 
                            <!--<li><a href="logout.php" title="Logout">Logout&nbsp;&nbsp;&nbsp;<i class="fas fa-power-off"></i></a></li>-->
                            <button id="logout-btn" class="logout-btn">Logout&nbsp;&nbsp;&nbsp;<i class="fas fa-power-off"></i></button>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <!-- The Modal -->
    <div id="logout-confirmation" class="logout-modal">
        <!-- Modal content -->
        <div class="logout-modal-content">
            <div class="logout-left">
                <div>
                    <p class="logout-left-top">Oh no, you are leaving...</p>
                    <p class="logout-left-bottom">Are you sure?</p>
                </div>
                <div class="logout-no-yes">
                    <button type="button" class="logout-close">Nope</button>
                    <button type="button" onclick="location.href='logout.php'" class="logout-agree">Yes</button>
                </div>
            </div>
            <div class="logout-right">
                <img src="Images/logout-door.png" alt="">
            </div>
        </div>
    </div>

    <script>
    // Get the modal
    var logoutmodal = document.getElementById("logout-confirmation");

    // Get the button that opens the modal
    var logoutbtn = document.getElementById("logout-btn");

    // Get the <span> element that closes the modal
    var logoutspan = document.getElementsByClassName("logout-close")[0];

    // When the user clicks the button, open the modal 
    logoutbtn.onclick = function() {
      logoutmodal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    logoutspan.onclick = function() {
      logoutmodal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
      if (event.target == logoutmodal) {
        logoutmodal.style.display = "none";
      }
    }
    </script>
</body>
</html>