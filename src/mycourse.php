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
    $search_query = "SELECT * FROM course c, teacher t WHERE (c.teac_id = t.teac_id) AND (c.teac_id = $teac_id) AND cour_name LIKE '%".$_POST['search']."%' ";
    $result = executeQuery($search_query);

} else {
    //Retreive selected result from the table and display them on page
    $sql = "SELECT * FROM course c, teacher t WHERE (c.teac_id = t.teac_id) AND (c.teac_id = $teac_id)";
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
    <link rel="stylesheet" href="mycourse.css">
    <link rel="icon" href="Images/LE_Favicon.png">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/8e94eefdff.js" crossorigin="anonymous"></script>
    <title>My Course</title>
</head>
<body>
    <div class="course-page">
    <!--My course title bar Teacher-Viewquiz-->
    <div class="title-bar">
        <div class="title-content">
            <!--My Course Title and Course search bar-->
            <div class="left-container">
                <p>My Course</p>
                <!--Course Search Bar-->
                <form class="input-search" method="POST" action="mycourse.php">
                     <input type="text" name="search" id="search-input" placeholder="Search your course here....." class="input-course">
                     <button type="submit" name="submit" value="Search" class="btn-course">
                        <i class="fa fa-search"></i>
                     </button>
                </form>
            </div>
            <!--Create Course and Filter button-->
            <div class="right-container">
                <!--Create Course button-->
                <div class="create-course-btn">
                    <a href="verified-or-not.php">Create Course</a>
                </div>
                <div class="view-quiz-btn">
                    <a href="Teacher-Viewquiz.php">View Quiz</a>
                </div>
            </div>
        </div>
    </div>

    <?php
    if(mysqli_num_rows($result) > 0){
        while ($row = mysqli_fetch_array($result)){
    ?>
    <!--Course Content - Course Card-->
    <div class="course-container">
         <!--Course Card Teacher Site (My course)-->
        <div class="course-card">
            <!--Cource Cover-->
            <div class="course-cover">
                <img src="Images/<?php echo $row["cour_cover"]; ?>">
            </div>
            <!--Course Content-->
            <div class="course-content">
                <!--Course Title-->
                <div class="course-title">
                    <p><?php echo $row["cour_name"]; ?></p>
                    <button class="course-category" style="outline: none; cursor:default"><?php echo $row["cour_category"]; ?></button>
                </div>
                <!--Details Information such as teacher name and published date-->
                <div class="course-details">
                    <h3>Published Date :<?php echo $row["cour_date"]; ?></h3>
                    <!--Edit and Delete button-->
                    <div class="course-btn">
                        <div class="View-btn">
                            <a href="teacher-content.php?cid=<?php echo $row["cour_id"]; ?>">View</a>
                        </div>
                        <div class="Edit-btn">
                            <a href="edit-course.php?cour_id=<?php echo $row["cour_id"]; ?>">Edit</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function () {
            $("#search-input").keyup(function () {
                var searchText = $(this).val();
                if (searchText != '') {
                    $.ajax({
                        url: 'action.php',
                        method: 'post',
                        data: {query: searchText},
                        success: function (response) {
                            $("#show-list").html(response);
                        }
                    });
                } else {
                    $("#show-list").html('');
                }
            });
            $(document).on('click', 'a', function () {
                    $("#search-input").val($(this).text());
                    $("#show-list").html('');

            });
        });
    </script>
    <?php
        }
    }else{
        ?>
        <div class="tab-empty-state">
          <img src="Images/tab-empty-state.png" alt="">
          <p>Nothing here...</p>
        </div>
    <?php
        }
    ?>
    <?php include ("footer.php"); ?>
</body>
</html>