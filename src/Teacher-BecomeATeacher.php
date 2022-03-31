<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="visitorteacher.css">
    <link rel="icon" href="Images/LE_Favicon.png">
    <script src="https://kit.fontawesome.com/8e94eefdff.js" crossorigin="anonymous"></script>
    <title>Become A Teacher on Learneasy</title>
</head>
<body> 
    <?php
    session_start();
    if(isset($_SESSION['logged_username'])){
        include("nav.php");
    }else{
        include("visitor-nav.php");
    }
    ?>

     <section class="visitor-info">
     <!--Visitor title and img (teacher page)-->
     <div class="top-title-visitor">
         <!--Title for Visitor Teacher Page-->
        <div class="title">
             <p>Bringing Excellence to Students</p>
                <div class="sub-title">
                    <h3>A new way to learn for students</h3>
                </div>
                <div class="sign-up-button-teacher">
                    <button onclick="location.href='teacher-register.php'">Sign Up as Teacher</button>
                </div>
         </div>    
        <!--Images for title-->
         <div class="image-title">
             <img src="Images/title-visitor-top.png" alt="title-illustration">
         </div>   
     </div>

     <!--Middle Advertisement for teacher /introduction-->
     <div class="mid-intro">
         <div class="intro-words">
             <p>A success-oriented Learning Environment</p>
                <div class="sub-intro">
                    <h3>Education students in the richness of their past, the diversity of their present and the possibilities for their future.</h3>
                    <div class="about-us-button-intro">
                        <button onclick="location.href='AboutUs.php'">About Us</button>
                    </div>
                </div>
         </div>
         <!--Images for Mid-Intro-->
         <div class="image-middle">
             <img src="Images/intro-visitor-middle.png" alt="teacher-avatar">
        </div>
     </div>
     
     <!--Bottom Description of the website-->
     <div class="bottom-des">
        <div class="image-des">
            <img src="Images/des-visitor-bottom" alt="illustration-image">
        </div>
        <!--How does Learneasy work? (description)-->
        <div class="des-learneasy">
            <div class="des-content">
                <p>How does Learn<b>easy</b> works?</p>
                <h3>Top teachers from all over the world teach the students that learning on Learneasy. We can give you the means to teach what you love.</h3>
            </div>
        </div>
     </div>
     </section>
     <?php include ("footer.php"); ?>
</body>
</html>