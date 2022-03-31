<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="quizempty.css">
    <link rel="icon" href="Images/LE_Favicon.png">
    <script src="https://kit.fontawesome.com/8e94eefdff.js" crossorigin="anonymous"></script>
    <title>Quiz Homepage</title>
</head>
<body> 
    <?php include ("navbar#"); ?>
    <div class="welcome-student">
        <p>Welcome Back, Student Name.</p>
    </div>

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
                        <span class="icon-tooltiptext">You need to enroll a course to enter a quiz.</span>
                    </div>
                </div>
                <!--Search funtion-->
                <div class="right-quiz-container">
                    <div class="search-quiz">
                        <form class="input-search">
                            <input type="text" name="search" placeholder="Search your quiz here....." class="input-quiz">
                            <button type="submit" class="btn-quiz">
                                <i class="fa fa-search"></i>
                            </button>
                        </form>
                    <!--Quiz history button-->
                    </div>
                    <div class="quiz-history-btn">
                        <button onclick="location.href='#'">Quiz History</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="quiz-card">
            <div class="quiz-iilustration-empty">
                <img src="Images/empty-quiz.png">
            </div>
                <h2>Oops seems like you didn't have any quiz to attempt</h2>
            <div class="enroll-btn">
                <button onclick="location.href='#'">Enroll Now</button>
            </div>
        </div>
    </section>
    <?php include ("footer#"); ?>
</body>
</hmtl>

