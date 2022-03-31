<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="aboutus.css">
    <link rel="icon" type="image/png" href="Images/Learneasy_favicon.png">
    <title>About Us</title>
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
    <div class="about-us-hero">
        <img src="https://images.unsplash.com/photo-1560785496-3c9d27877182?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=967&q=80" alt="">
        <div class="hero-title-tag">
            <p class="about-us-hero-title">Learn with passion to live with purpose</p>
            <a class="hero-tag" href="#mission">Our Mission</a>
            <a class="hero-tag" href="#story">Our Story</a>
        </div>
    </div>
    <div class="our-mission" id="mission">
        <p class="our-title">Our Mission</p>
        <div class="mission-flex">
            <div class="missions">
                <img class="mission-circle" src="https://image.freepik.com/free-vector/flat-design-characters-doing-time-management_23-2148274068.jpg" alt="">
                <p class="mission-subtitle">Flexibility</p>
                <p class="mission-paragraph">
                    Students are given freedom in how, what, when and where they learn, a better time management.
                </p>
            </div>
            <div class="missions">
                <img class="mission-circle" src="https://image.freepik.com/free-vector/kids-online-lessons_52683-36818.jpg" alt="">
                <p class="mission-subtitle">Pace of Learning</p>
                <p class="mission-paragraph">
                    A wide range of learning abilities, allows a different pace of learning for every student or teacher.
                </p>
            </div>
            <div class="missions">
                <img class="mission-circle" src="https://image.freepik.com/free-vector/modern-productivity-concept-with-flat-design_23-2147972848.jpg" alt="">
                <p class="mission-subtitle">Effectiveness</p>
                <p class="mission-paragraph">
                    Online courses provided appeal to all learning styles and able to know your subject material well.
                </p>
            </div>
        </div>
    </div>
    <div class="our-story" id="story">
        <div class="story-title-paragraph">
            <p class="our-title">Our Story</p>
            <p class="story-paragraph">
                Learneasy is an online learning platform that have various type of courses which allow students to choose what they be fond of it. Learneasy was founded by Ricky Wong Tiong Song, Chai Ming En and Chong Win Yip in 2020 with a vision of expands education options and pathways for students through quality online, hybrid, and web-enhanced courses by embracing innovative and accessible modes of course development and delivery. The objectives to develop the e-learning system is to let students be more attentive in learning and have more opportunity to ask questions if facing any problems. The benefits of e-learning system is that students able to learn the courses at their own pace, flexible and better time management on themselves. Even students are learning at their own pace, the course's teacher also able to know the learning progress of their students through the system.
                Today, Learneasy become a global online learning platform that offers anyone come together to find inspiration and take the next step in their creative journey.
            </p>
        </div>
    </div>
    <?php include("footer.php")?>
</body>
</html>
