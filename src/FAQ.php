<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="faq.css">
    <link rel="icon" href="Images/LE_Favicon.png">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <title>FAQ Page</title>
</head>
<body> 
<?php
    session_start();
    if(isset($_SESSION['logged_username'])){
        include("nav.php");
    }elseif(isset($_SESSION['logged_teacher'])){
        include("teacher-nav.php");
    }
    else{
        include("visitor-nav.php");
    }
    ?>

    <!--How can we help?-->
    <div class="faq-title">
        <p>How can we help you?</p>
    </div>

    <div class="faq-help">
        <!--Account Setup Div-->
        <div class="faq-box">
            <div class="account-setup">
                <i class="fas fa-user"></i>
                <h1>Account Setup</h1>
                <h2>Get started on <br>Learneasy</h2>
                <!--Overlay-->
                <div class="overlay">
                    <p>Account Setup</p>
                    <div class="questions">
                        <h2><a href="#password">How do I change my password?</a></h2>
                        <h3><a href="#email-address">How do I change my email address?</a></h3>
                        <h4><a href="#profile">How do I update my Learneasy profile?</a></h4>
                    </div>
                </div>
            </div>
        </div>
        <!--Enrollment Div-->
        <div class="faq-box">
            <div class="enrollment">
                <i class="fas fa-layer-group"></i>
                <h1>Enrollment</h1>
                <h2>Get a course on <br>Learneasy</h2>
                <!--Overlay-->
                <div class="overlay">
                    <p>Enrollment</p>
                    <div class="questions">
                        <h2><a href="#enroll">How to enroll a course?</a></h2>
                        <h3><a href="#mycourse">Where to find my courses?</a></h3>
                        <h4><a href="#unenroll">How to unenroll from a course?</a></h4>
                    </div>
                </div>
            </div>
        </div>
        <!--Trouble Shooting Div-->
        <div class="faq-box">
            <div class="troubleshooting">
                <i class="fas fa-wrench"></i>
                <h1>TroubleShooting</h1>
                <h2>Common Problems</h2>
                 <!--Overlay-->
                 <div class="overlay">
                    <p>Trouble Shooting</p>
                    <div class="questions">
                        <h2><a href="#troubleshoot">Troubleshooting Videos?</a></h2>
                        <h3><a href="#load-pro">Course loading problems?</a></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <p class="faq-word">Frequently Asked Questions</p>
        <div class="faq-container">
        <!--FAQ container include content - (Questions and Answer)-->
        <div class="faq-content">
            <details id="mycourse">
                <summary id="faq-question">
                    <span>
                        Where to find my courses?
                    </span>
                </summary>
                    <li>After Login to your account, you will now at your Student Homepage.</li>
                    <li>In the page, there will be 3 Tabs which are Home, In Progress and Completed </li>
                    <ul>You are able to discover, to enroll new course through the "Home" Tabs.</ul>
                    <ul>The in progress courses will be display in the "In Progress" Tabs </ul>
                    <ul>If the course was completed, it will shown in the "Completed" Tabs.</ul>
            </details>
            <details id="password">
                <summary id="faq-question">
                    <span>
                        How do I change my password?
                    </span>
                </summary>
                    <li>You can change your password in your Profile Settings.</li>
                    <li>Enter your current and new password, and you're all set!</li>
            </details>
            <details id="enroll">
                <summary id="faq-question">
                    <span>
                        How to enroll a course?
                    </span>
                </summary>
                    <li>Once you Register as a Student, you will now a member on Learneasy.</li>
                    <li>You are able to search the courses that you are looking for.</li>
                    <li>Click on the course-card, and you will be direct to the course page.</li>
                    <li>In the page, there is a "Enroll Button", click on it and will pop-up a message box to confirm your enrollment.</li>
            </details>
            <details id="profile">
                <summary id="faq-question">
                    <span>
                        How do I update my Learneasy profile?
                    </span>
                </summary>
                    <li>You must login to your account first to access to profile settings.</li>
                    <li>Click on the User Avatar and you will be direct to your Profile Settings.</li>
                    <li>Set up all your details information in the page.</li>
            </details>
            <details id="load-pro">
                <summary id="faq-question">
                    <span>
                        Course loading problems?
                    </span>
                </summary>
                    <li>Problems loading course content are a known issus on the Learneasy platform. We apologize for the incovenience.</li>
                    <li>There are a few steps to solve the problems.</li>
                    <ul>1. Check your internet connection.</ul>
                    <ul>2. Refresh the current page.</ul>
                    <ul>3. Try to use another devices to login to your account.</ul>
            </details>
            <details id="email-address">
                <summary id="faq-question">
                    <span>
                        How do I change my email address?
                    </span>
                </summary>
                    <li>You can change your email address in your Profile Settings</li>
                    <li>Enter your current and new email address, and you're all set!</li>
            </details>
            <details id="unenroll">
                <summary id="faq-question">
                    <span>
                        How to unenroll from a course?
                    </span>
                </summary>
                    <li>Click on the course card, and you will be direct to the course page.</li>
                    <li>In the course page, there is an "Unenroll Button".</li>
                    <li>Click on the button and a message box will show to get your confirmation.</li>
                    <li>You will not able to get the course's recourse or enter a quiz after you had unenrolled the course.</li>
            </details>
            <details id="troubleshoot">
                <summary id="faq-question">
                    <span>
                        Troubleshooting Videos?
                    </span>
                </summary>
                    <li>Videos errors may be caused by a number of factors. We recommend trying the following steps to troubleshoot.</li>
                    <ul>1. Clear your cache and cookies.</ul>
                    <ul>2. Sign out of Learneasy, quit your browser, then sign back in.</ul>
                    <ul>3. Try a different browser to sign in.</ul>
            </details>
            <details>
                <summary id="faq-question">
                    <span>
                        Set up your Learneasy account.
                    </span>
                </summary>
                    <ul>1. Go to sLearneasy</ul>
                    <ul>2. At the top of the page, click Sign Up.</ul>
                    <ul>3. Select to sign up as a "Student" or "Teacher"</ul>
                    <ul>4. Fill in all your details information and click "Sign Up", congratulations you are done signed up.</ul>
            </details>
            <details>
                <summary id="faq-question">
                    <span>
                        Enrollment options
                    </span>
                </summary>
                    <li>There are a fews benefits after enroll a course.</li>
                    <ul>1. You are able to see all the course materials.</ul>
                    <ul>2. You are able to ask question.</ul>
                    <ul>3. You are able to enter a quiz.</ul>
                    <ul>4. You are able to download the course's resource provided by teacher.</ul>
                    <ul>5. You are able to comment about the course and the teacher.</ul>
            </details>
        </div>
    </div>
    <?php include ("footer.php"); ?>
</body>
</html>
