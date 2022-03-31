<?php
session_start();
require("conn.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="Images/Learneasy_favicon.png">
    <link rel="stylesheet" href="course-card.css">
    <link rel="stylesheet" href="visitorhome.css">
    <title>Learneasy</title>
</head>
<body>
    <?php include("visitor-nav.php");?>
    <div class="top-hero">
        <img id="visitor-home-illu" src="Images/Visitor-Homepage Illustration.png" alt="">
        <div class="title-button">
            <p class="hero-title">Ready to stand out from the crowd?</p>
            <p class="hero-subtitle">Enroll & Learn. Just that easy.</p>
            <a class="browse-course" href="course-category.php?get_category=all">Browse Courses</a>
        </div>
    </div>
    <div class="course-carousel">
        <p class="carousel-title">Courses</p>
        <div class="carousel">
            <div class="carousel-tab">
                <button class="tablinks" onclick="openCategory(event, 'all-course')" id="defaultOpen">All</button>
                <button class="tablinks" onclick="openCategory(event, 'business-course')">Business</button>
                <button class="tablinks" onclick="openCategory(event, 'design-course')">Design</button>
                <button class="tablinks" onclick="openCategory(event, 'it-course')">IT</button>
            </div>
              
            <div id="all-course" class="tabcontent">
                <div class="view-more-flex">
                    <a class="view-more-course" href="course-category.php?get_category=all">View More</a>
                </div>
                <div class="carousel-flex">
                    <?php
                    //echo the all course
                    $sql = "SELECT * ,(SELECT AVG(rate_course_value) FROM rating r WHERE (r.cour_id = c.cour_id)) AS avg_rating FROM course c, teacher t WHERE (c.teac_id = t.teac_id) ORDER BY RAND() LIMIT 4";
                    $result = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($result) > 0){
                    while ($row = mysqli_fetch_array($result)){
                        $cid = $row['cour_id'];
                        $cover = $row['cour_cover'];
                        $name = $row['cour_name'];
                        $tfname = $row['teac_first_name'];
                        $tlname = $row['teac_last_name'];
                        $cour_category = $row['cour_category'];
                        $cour_rating = round($row['avg_rating'],1);
                        if(is_null($cour_rating)){
                            $cour_rating = 0;
                        }
                        /*
                        $sql = "SELECT AVG(rate_course_value) AS rate_avg FROM rating WHERE cour_id = $cid";
                        $result = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_assoc($result);
                        $ratingavg = round($row['rate_avg'],1);
                        */
                    ?>
                    <a class="course-link" href="enrolled-or-not.php?cid=<?php echo $cid?>">
                        <div class="course-card">
                            <img class="course-cover-pic" src="Images/<?php echo $cover;?>" alt="Course cover picture">
                            <p class="course-name"><?php echo $name;?></p>
                            <div class="teacher-star-flex">
                                <p class="course-teacher"><?php echo $tfname.' '.$tlname;?></p>
                                <div class="rating-and-value">
                                    <img class="rating-star" src="Images/rating-star.png" alt="rating-star">
                                    <p class="rating-value"><?php echo $cour_rating?></p>
                                </div>
                            </div>
                            <p class="course-tag"><?php echo $cour_category;?></p>
                        </div>
                    </a>
                    <?php 
                        }
                    }
                    ?>
                </div>
            </div>
              
            <div id="business-course" class="tabcontent">
                <div class="view-more-flex">
                    <a class="view-more-course" href="course-category.php?get_category=business">View More</a>
                </div>
                <div class="carousel-flex">
                    <?php
                    //echo the business course
                    $sql = "SELECT * ,(SELECT AVG(rate_course_value) FROM rating r WHERE (r.cour_id = c.cour_id)) AS avg_rating FROM course c, teacher t WHERE (c.teac_id = t.teac_id) AND c.cour_category = 'Business' ORDER BY RAND() LIMIT 4";
                    $result = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($result) > 0){
                    
                    while ($row = mysqli_fetch_array($result)){
                        $cour_rating = round($row['avg_rating'],1);
                        if(is_null($cour_rating)){
                            $cour_rating = 0;
                        }
                    ?>
                    <a class="course-link" href="enroll-course.php?cid=<?php echo $row['cour_id']?>">
                        <div class="course-card">
                            <img class="course-cover-pic" src="Images/<?php echo $row['cour_cover'];?>" alt="Course cover picture">
                            <p class="course-name"><?php echo $row['cour_name'];?></p>
                            <div class="teacher-star-flex">
                                <p class="course-teacher"><?php echo $row['teac_first_name'].' '.$row['teac_last_name']?></p>
                                <div class="rating-and-value">
                                    <img class="rating-star" src="Images/rating-star.png" alt="rating-star">
                                    <p class="rating-value"><?php echo $cour_rating;?></p>
                                </div>
                            </div>
                            <p class="course-tag"><?php echo $row['cour_category'];?></p>
                        </div>
                    </a>
                    <?php 
                        }
                    }
                    ?>
                </div>
            </div>
              
            <div id="design-course" class="tabcontent">
                <div class="view-more-flex">
                    <a class="view-more-course" href="course-category.php?get_category=design">View More</a>
                </div>
                <div class="carousel-flex">
                    <?php
                    //echo the business course
                    $sql = "SELECT * ,(SELECT AVG(rate_course_value) FROM rating r WHERE (r.cour_id = c.cour_id)) AS avg_rating FROM course c, teacher t WHERE (c.teac_id = t.teac_id) AND c.cour_category = 'Design' ORDER BY RAND() LIMIT 4";
                    $result = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($result) > 0){
                    
                    while ($row = mysqli_fetch_array($result)){
                        $cour_rating = round($row['avg_rating'],1);
                        if(is_null($cour_rating)){
                            $cour_rating = 0;
                        }
                    ?>
                    <a class="course-link" href="enroll-course.php?cid=<?php echo $row['cour_id']?>">
                        <div class="course-card">
                            <img class="course-cover-pic" src="Images/<?php echo $row['cour_cover'];?>" alt="Course cover picture">
                            <p class="course-name"><?php echo $row['cour_name'];?></p>
                            <div class="teacher-star-flex">
                                <p class="course-teacher"><?php echo $row['teac_first_name'].' '.$row['teac_last_name']?></p>
                                <div class="rating-and-value">
                                    <img class="rating-star" src="Images/rating-star.png" alt="rating-star">
                                    <p class="rating-value"><?php echo $cour_rating?></p>
                                </div>
                            </div>
                            <p class="course-tag"><?php echo $row['cour_category'];?></p>
                        </div>
                    </a>
                    <?php 
                        }
                    }
                    ?>
                </div>
            </div>

            <div id="it-course" class="tabcontent">
                <div class="view-more-flex">
                    <a class="view-more-course" href="course-category.php?get_category=it">View More</a>
                </div>
                <div class="carousel-flex">
                <?php
                    //echo the business course
                    $sql = "SELECT * ,(SELECT AVG(rate_course_value) FROM rating r WHERE (r.cour_id = c.cour_id)) AS avg_rating FROM course c, teacher t WHERE (c.teac_id = t.teac_id) AND c.cour_category = 'IT' ORDER BY RAND() LIMIT 4";
                    $result = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($result) > 0){
                    
                    while ($row = mysqli_fetch_array($result)){
                        $cour_rating = round($row['avg_rating'],1);
                        if(is_null($cour_rating)){
                            $cour_rating = 0;
                        }
                    ?>
                    <a class="course-link" href="enroll-course.php?cid=<?php echo $row['cour_id']?>">
                        <div class="course-card">
                            <img class="course-cover-pic" src="Images/<?php echo $row['cour_cover'];?>" alt="Course cover picture">
                            <p class="course-name"><?php echo $row['cour_name'];?></p>
                            <div class="teacher-star-flex">
                                <p class="course-teacher"><?php echo $row['teac_first_name'].' '.$row['teac_last_name']?></p>
                                <div class="rating-and-value">
                                    <img class="rating-star" src="Images/rating-star.png" alt="rating-star">
                                    <p class="rating-value"><?php echo $cour_rating?></p>
                                </div>
                            </div>
                            <p class="course-tag"><?php echo $row['cour_category'];?></p>
                        </div>
                    </a>
                    <?php 
                        }
                    }
                    ?>
                </div>
            </div>

            <script>
                function openCategory(evt, cityName) {
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

        </div>
    </div>
    <div class="recruit-teacher">
        <img id="recruit-illu" src="Images/recruit-teacher.png" alt="">
        <div class="recruit-text">
            <div class="bigtext">
                <span class="bigtext-blue">Become a teacher</span>
                <div>
                    <span class="bigtext-blue">on Learn</span><span class="bigtext-orange">easy</span><span class="bigtext-blue">.</span>
                </div>
            </div>
            <p class="recruit-paragraph">Top teachers from all over the world teach the students that learning on Learneasy. We can give you the means to teach what you love.</p>
            <a class="learn-more" href="Teacher-BecomeATeacher.php">Learn More</a>
        </div>
    </div>
    <?php include("footer.php");?>
</body>
</html>