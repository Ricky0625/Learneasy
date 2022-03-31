<?php
session_start();
include "conn.php";

if (isset($_POST['search'])) {
    $search_query ="SELECT *FROM course WHERE cour_name LIKE '%".$_POST['search']."%'";
    $result = executeQuery($search_query);

} else {
    //Retreive selected result from the table and display them on page
    $sql = "SELECT * FROM course";
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
    <link rel="stylesheet" href="admin-course-reports.css">
    <link rel="icon" type="image/png" href="Images/Learneasy_favicon.png">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <title>Course Report</title>
</head>
<body>
    <?php include("admin-nav.php")?>

    <div class="course-page-container">
        <p class="course-page-title">Courses</p>
        <div class="search-box">
            <form method="POST" action="admin-course-report.php" autocomplete="off">
                <input id="search-input" name="search" type="text" placeholder="Search courses here...">
                <input id="real-submit" type="submit" hidden>
                <button id="search-btn" type="submit" name="submit" value="Search"><i class="fas fa-search"></i></button>
            </form>
        </div>

        <div class="course-list">
            <table class="list">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Course Name</th>
                        <th>Course Category</th>
                        <th>Course Created Date</th>
                        <th>View</th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($row = mysqli_fetch_array($result)){
                        ?>
                        <tr>
                            <td><?php echo $row["cour_id"]; ?></td>
                            <td><?php echo $row["cour_name"]; ?></td>
                            <td><?php echo $row["cour_category"]; ?></td>
                            <td><?php echo $row["cour_date"]; ?></td>
                            <td><a href='admin-viewcourse.php?cour_id=<?php echo $row['cour_id'];?>'><button class="viewbtn">View</button></a></td>
                        </tr>
                    <?php
                    }
                ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="admin-footer">
        <div class="foo-des">
            <p>Design and Develop by Win Yip, Ming En and Ricky - SDP Assignment</p>
        </div>
    </div>
</body>
</html>