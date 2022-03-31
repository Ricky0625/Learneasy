<?php
session_start();
require("conn.php");

if(isset($_SESSION['logged_teacher'])){
    $nav = "teacher-nav.php";
}
include($nav);

$username = $_SESSION['logged_teacher'];

//Get teac id
$sql = "SELECT * FROM teacher WHERE teac_username = '$username'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$teac_id = $row['teac_id'];


if (isset($_POST['search'])) {
    $search_query = "SELECT *, (SELECT SUM(quques_score) FROM quiz_question qq WHERE (qq.quiz_id = q.quiz_id)) AS marks FROM quiz q, course c, teacher t WHERE (q.cour_id = c.cour_id) AND (c.teac_id = t.teac_id) AND (c.teac_id = $teac_id) AND cour_name LIKE '%".$_POST['search']."%'";
    $result = executeQuery($search_query);

} else {
    //Retreive selected result from the table and display them on page
    $sql = "SELECT *, (SELECT SUM(quques_score) FROM quiz_question qq WHERE (qq.quiz_id = q.quiz_id)) AS marks FROM quiz q, course c, teacher t WHERE (q.cour_id = c.cour_id) AND (c.teac_id = t.teac_id) AND (c.teac_id = $teac_id) ORDER BY RAND()";
    $result = mysqli_query($conn, $sql);
}

function executeQuery($query) {
    require("conn.php");
    $result = mysqli_query($conn, $query);
    return $result;
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="teacherquiz.css">
    <link rel="icon" href="Images/LE_Favicon.png">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <title>Teahcer Quiz</title>
</head>
<body> 
    <section class="quiz-content">
        <!--quiz bar contain of quiz history button and search bar-->
        <div class="quiz-bar">
            <div class="quiz-bar-item">
                <div class="left-quiz-container">
                    <p>Quizzes</p>
                    <!--Pen Icon Beside Quiz title-->
                    <div class="icon-pen">
                        <i class="fas fa-pen-fancy"></i>
                    </div>
                    <!--Question mark icon beside pen icon-->
                    <div class="icon-question-mark">
                        <i class="fas fa-question-circle"></i>
                        <span class="icon-tooltiptext">You have to create your own course to edit your quiz.</span>
                    </div>
                </div>
                <!--Search funtion-->
                <div class="right-quiz-container">
                    <div class="search-quiz">
                        <form class="input-search" method="POST" action="Teacher-Viewquiz.php">
                            <input type="text" name="search"  id="search-input" placeholder="Search your quiz here....." class="input-quiz">
                            <button type="submit" name="submit" value="Search" class="btn-quiz">
                                <i class="fa fa-search"></i>
                            </button>
                        </form>
                    </div>
                    <!--Create Course button-->
                    <div class="enroll-more-btn">
                        <button onclick="location.href='create-course.php'">Create Course</button>
                    </div>
                </div>
            </div>
        </div>

        <!--Box to display/arrage the quiz card-->
        <div class="quiz-box-quizcard">
            <!--First row display quiz card-->
                <div class="quiz-list">
                    <!--Quiz Card List-->
                    <?php              
                    if (mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_array($result)){
                    ?>
                    <a class="quiz-card" href="Teacher-quizform.php?qid=<?php echo $row['quiz_id']; ?>">
                        <!--Quiz Cover-->
                        <div class="left-card-cover">
                            <img src="Images/<?php echo $row["cour_cover"]; ?>">
                        </div>
                        <!--Quiz Information-->
                        <div class="right-quiz-title">
                            <div class="quiz-info">
                                <div class="quiz-title">
                                    <h2><?php echo $row['quiz_title'];?></h2>
                                </div>
                                <hr class="seperate-line">
                                <!--Course/Created By/Created On/Marks-->
                                <div class="quiz-info-content">
                                    <p><?php echo $row['cour_name'];?></p>
                                    <!--Quiz Created By and Created On-->
                                    <div class="quiz-created">
                                        <h2>Created By: <?php echo $row['teac_first_name'];?> <?php echo $row['teac_last_name'];?></h2>
                                        <h2>Created On: <?php echo $row['quiz_create_date'];?></h2>
                                    </div>
                                    <div>
                                        <h3>Marks: <?php echo $row['marks'];?></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    <?php
                        } 
                    }else {
                    ?>
                     <div class="quiz-empty">
                        <div class="quiz-iilustration-empty">
                            <img src="Images/empty-quiz.png">
                        </div>
                            <h2>Oops seems like you didn't have any quiz</h2>
                        <div class="enroll-btn">
                            <button onclick="location.href='mycourse.php'">Create Course</button>
                        </div>
                    </div>
                    <?php 
                    }
                ?>
                </div>
            </div>
        </section>
    <?php include("footer.php")?>
</body>
</html>