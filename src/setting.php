<?php
session_start();

include 'conn.php';
$username = $_SESSION['logged_username'];
$sql = "SELECT * FROM student WHERE stud_username = '$username' LIMIT 1";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$join_date = strtotime($row['stud_join_date']);
$stud_join_date = date('Y/m/d', $join_date);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="setting.css">
        <link rel="icon" type="image/png" href="Images/Learneasy_favicon.png">
        <script src="https://kit.fontawesome.com/8e94eefdff.js" crossorigin="anonymous"></script>
        <title>Settings</title>
    </head>
    <body>
<!--$username = $_SESSION['logged_username'];-->
        <?php include("nav.php");?>
        <div class="page-padding">
            <?php include("backBtn.php"); ?>
            <div class="setting-page">
                <section class="setting-left">
                    <div class="setting-flex-row">
                    </div>
                    <div class="account-title">
                        <span>Account</span>
                    </div>
                    <div class="setting-flex-row">
                        <span class="acc-info-label">Name:</span><span><?php echo $row['stud_first_name'] ?> <?php echo $row['stud_last_name'] ?></span>
                    </div>

                    <div class="setting-flex-row">
                            <span class="acc-info-label">Username:</span><span><?php echo $row['stud_username'] ?></span>
                    </div>
                    <div class="setting-flex-row">
                        <span class="acc-info-label">Email:</span><span><?php echo $row['stud_email'] ?></span>
                    </div>
                    <div class="setting-flex-row">
                        <span class="acc-info-label">Join Date:</span><span><?php echo $stud_join_date; ?></span>
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
                            <form method = "POST" action = "update-email.php" >
                                <p class="setting-title">Change Email Address</p>
                                <div class="flex-col">
                                    <span class="small-title">Current Email Address</span>
                                    <input type="email" name="stu-cur-email" class="input-field" value="<?php echo $row['stud_email'] ?>" readonly="">
                                </div>
                                <div class="flex-col">
                                    <span class="small-title">New Email Address</span>
                                    <input type="email" name="stu-new-email"class="input-field" required="">
                                </div>
                                <div class="flex-col">
                                    <div class="flex-col">
                                        <span class="small-title">Password</span>
                                        <span class="italic-text" >*Please retype your password to agree the changes.</span>
                                    </div>
                                    <input type="password" name="stu-password" class="input-field" required="">
                                </div>
                                <input type="submit" value="Update" class="setting-btn">
                            </form>
                        </div>

                        <div id="Password" class="tabcontent">
                            <form method = "POST" action = "update-password.php" >
                                <p class="setting-title">Change Password</p>
                                <div class="flex-col">
                                    <span class="small-title">Current Password</span>
                                    <input type="password" name="stu-cur-pass" class="input-field" required="">
                                </div>
                                <div class="flex-col">
                                    <span class="small-title">New Password</span>
                                    <input type="password" name="stu-new-pass"class="input-field" required="">
                                </div>
                                <div class="flex-col">
                                    <span class="small-title">Confirm New Password</span>
                                    <input type="password" name="stu-conf-pass"class="input-field" required="">
                                </div>
                                <input type="submit" value="Update" class="setting-btn"> 
                            </form>
                        </div>

                        <div id="Account" class="tabcontent">
                            <form method = "POST" action = "delete-account.php" >
                                <p class="setting-title">Delete Account</p>
                                <div class="flex-row" style="border-bottom: none;">
                                    <img id="profile-pic" src="Images/<?php echo $row['stud_profile_picture'] ?> " alt="">
                                    <div class="flex-col" style="margin: 0; margin-left: 10px;">
                                        <span id="fullname"><?php echo $row['stud_first_name'] ?> <?php echo $row['stud_last_name'] ?></span>
                                        <span id="username">@<?php echo $row['stud_username'] ?></span>
                                        
                                    </div>
                                </div>
                                <p class="reminder-big">This will delete your account permanently.</p>
                                <p class="reminder-text">After you click on the button below, all of your account data including    enrolled courses, learning progress, etc. will be deleted and you will not be  able to sign in to this account anymore. You will be logged out from this    account too once you click on the button.</p>
                                <p class="reminder-small">If you are sure about your decision, here is the button.</p>
                                <input type="submit" value="Delete My Account" class="setting-btn delete-acc" name="delete-stud-acc">
                            </form>
                        </div>
                    </div>

                </section>
            </div>
        </div>
        <?php include("footer.php") ?>
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