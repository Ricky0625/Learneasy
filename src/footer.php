<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="footer.css">
    <script src="https://kit.fontawesome.com/8e94eefdff.js" crossorigin="anonymous"></script>
    <title>Footer</title>
</head>
<body>
    <footer>
        <div class="learneasy-footer">
            <div class="logo-and-social">
                <a href=""><img src="Images/Learneasy-bottom-logo.png" alt="Learneasy logo"></a>
                <p class="company-des">Education for everyone and anywhere.</p>
                <div class="social-icon">
                    <div class="facebook social-odd">
                        <a href="https://www.facebook.com/rickroll548/" target="_NEW"><i class="fab fa-facebook-f"></i></a>
                    </div>
                    <div class="insta social-even">
                        <a href="https://www.instagram.com/rick_r0lled/" target="_NEW"><i class="fab fa-instagram"></i></a>
                    </div>
                    <div class="twitter social-odd">
                        <a href="https://twitter.com/ChirnLoL/status/1362112971451731973?ref_src=twsrc%5Etfw" target="_NEW"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
            </div>
            <div class="footer-menu">
                <a href="redirect-to.php">Home</a>
                <?php
                if(isset($_SESSION['logged_teacher'])){
                    echo '<style type = "text/css">
                    #course-URL {
                      display: none;
                    }
                    </style>';
                }
                ?>
                <a href="course-category.php?get_category=all" id="course-URL">Courses</a>
                <a href="AboutUs.php">About Us</a>
                <a href="FAQ.php">FAQ</a>
                <?php
                if(isset($_SESSION['logged_teacher'])){
                    echo '<style type = "text/css">
                    #to-teacher-register {
                      display: none;
                    }
                    </style>';
                }
                ?>
                <a href="Teacher-BecomeATeacher.php" id="to-teacher-register">Become a teacher</a>
            </div>
        </div>
        <div class="team-members">
            Design and Develop by Win Yip, Ming En, and Ricky - SDP Assignment
        </div>
    </footer>
</body>
</html>