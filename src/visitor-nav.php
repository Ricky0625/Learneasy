<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="visitor-nav.css">
    <link rel="icon" type="image/png" href="Images/Learneasy_favicon.png">
    <script src="https://kit.fontawesome.com/8e94eefdff.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <section class="top-nav-bar" style="z-index: 50;">
        <div class="left-nav">
            <a id="learneasy-logo" href="index.php"><img src="Images/Learneasy-top-logo.png" alt=""></a>
            <nav>
                <ul class="main-menu">
                    <li><a href="course-category.php?get_category=all" name="all_course">Course <i class="fas fa-caret-down"></i></a>
                        <ul class="sub-menu" style="z-index: 50;">
                            <li><a href="course-category.php?get_category=business">Business</a></li>
                            <li><a href="course-category.php?get_category=design">Design</a></li>
                            <li><a href="course-category.php?get_category=it">IT</a></li>
                        </ul>
                    </li>
                    <li><a href="AboutUs.php">About Us</a></li>
                    <li><a href="FAQ.php">FAQ</a></li>
                    <li><a href="Teacher-BecomeATeacher.php">Become A Teacher</a></li>
                </ul>
            </nav>
        </div>
        <div class="right-nav">
            <a class="sign-in" href="Student-SignIn.php">Sign In</a>
            <a class="sign-up" href="Student-SignUp.php">Sign Up</a>
        </div>
    </section>
</body>
</html>