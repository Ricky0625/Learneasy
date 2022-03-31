<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="settings.css">
    <script src="https://kit.fontawesome.com/8e94eefdff.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <?php
    echo $_SESSION['logged_teacher'];
    if(!is_null($_SESSION['logged_username'])){
        include("nav.php");
    }else{
        include("teacher-nav.php");
    }
    ?>
    <div class="page-padding">
        <?php include("backBtn.php");?>
        <div class="setting-page">
            <section class="setting-left">
                <div class="setting-flex-row">
                    <span class="setting-main-title">Settings</span><i class="fas fa-cog"></i>
                </div>
                <div class="account-title">
                    <span>Account</span>
                </div>
                <div class="setting-flex-row">
                    <span class="acc-info-label">Name:</span><span>Tiffany Gracie</span>
                </div>
                <div class="setting-flex-row">
                    <span class="acc-info-label">Username:</span><span>tiffGracie</span>
                </div>
                <div class="setting-flex-row">
                    <span class="acc-info-label">Email:</span><span>tiffanyGracie0707@gmail.com</span>
                </div>
                <div class="setting-flex-row">
                    <span class="acc-info-label">Join Date:</span><span>07/01/2021</span>
                </div>
            </section>
            <section class="setting-right">
                <div class="setting-tab">
                    <div class="flex-row">
                        <button class="tablinks first-link" onclick="openSetting(event, 'Email')" id="defaultOpen"><i class="fas fa-envelope"></i>Change Email Address</button>
                        <i class="fas fa-caret-right"></i>
                    </div>
                    <div class="flex-row">
                        <button class="tablinks" onclick="openSetting(event, 'Password')"><i class="fas fa-key"></i>Change Password</button>
                        <i class="fas fa-caret-right"></i>
                    </div>
                    <div class="flex-row">
                        <button class="tablinks" onclick="openSetting(event, 'Account')"><i class="fas fa-user-times"></i>Delete Account</button>
                        <i class="fas fa-caret-right"></i>
                    </div>
                </div>
                <div class="setting-content">
                    <div id="Email" class="tabcontent">
                        <form action="">
                            <p class="setting-title">Change Email Address</p>
                            <div class="flex-col">
                                <span class="small-title">Current Email Address</span>
                                <input type="email" class="input-field" value="tiffanyGracie0707@gmail.com" readonly>
                            </div>
                            <div class="flex-col">
                                <span class="small-title">New Email Address</span>
                                <input type="email" class="input-field">
                            </div>
                            <div class="flex-col">
                                <div class="flex-col">
                                    <span class="small-title">Password</span>
                                    <span class="italic-text">*Please retype your password to agree the changes.</span>
                                </div>
                                <input type="password" class="input-field">
                            </div>
                            <input type="submit" value="Update" class="setting-btn">
                        </form>
                    </div>

                    <div id="Password" class="tabcontent">
                        <p class="setting-title">Change Password</p>
                        <div class="flex-col">
                            <span class="small-title">Current Password</span>
                            <input type="password" class="input-field">
                        </div>
                        <div class="flex-col">
                            <span class="small-title">New Password</span>
                            <input type="password" class="input-field">
                        </div>
                        <div class="flex-col">
                            <span class="small-title">Confirm New Password</span>
                            <input type="password" class="input-field">
                        </div>
                        <input type="submit" value="Update" class="setting-btn"> 
                    </div>

                    <div id="Account" class="tabcontent">
                        <p class="setting-title">Delete Account</p>
                            <div class="flex-row" style="border-bottom: none;">
                                <img id="profile-pic" src="https://images.unsplash.com/photo-1610683343028-6bfeec9b1ea7?ixid=MXwxMjA3fDB8MHx0b3BpYy1mZWVkfDF8dG93SlpGc2twR2d8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=60" alt="">
                                <div class="flex-col" style="margin: 0; margin-left: 10px;">
                                  <span id="fullname">Tiffany Gracie</span>
                                  <span id="username">@tiffGracie</span>
                                </div>
                            </div>
                        <p class="reminder-big">This will delete your account permanently.</p>
                        <p class="reminder-text">After you click on the button below, all of your account data including    enrolled courses, learning progress, etc. will be deleted and you will not be  able to sign in to this account anymore. You will be logged out from this    account too once you click on the button.</p>
                        <p class="reminder-small">If you are sure about your decision, here is the button.</p>
                        <input type="submit" value="Delete My Account" class="setting-btn delete-acc">
                    </div>
                </div>
            </section>
        </div>
    </div>
    <?php include("footer.php")?>
<script>
function openSetting(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>
</body>
</html>