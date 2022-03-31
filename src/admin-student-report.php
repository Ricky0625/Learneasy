<?php
session_start();
include "conn.php";

if (isset($_POST['search'])) {
    $search_query ="SELECT* FROM enrolment e, student s WHERE stud_username LIKE '%".$_POST['search']."%' AND (e.stud_id = s.stud_id) AND (e.enro_end_date != 'NULL')";
    $result = executeQuery($search_query);

} else {
    //Retreive selected result from the table and display them on page
    $sql = "SELECT* FROM enrolment e, student s WHERE (e.stud_id = s.stud_id) AND (e.enro_end_date != 'NULL')";
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
    <link rel="stylesheet" href="admin-student-reports.css">
    <link rel="icon" type="image/png" href="Images/Learneasy_favicon.png">
    <title>Student Report</title>
</head>
<body>
    <?php include("admin-nav.php")?>

    <div class="student-page-container">
        <p class="student-page-title">Student Enrollment Report</p>
        <div class="search-box">
            <form method="POST" action="admin-student-report.php" autocomplete="off">
                <input id="search-input" name="search" type="text" placeholder="Search courses here...">
                <input id="real-submit" type="submit" hidden>
                <button id="search-btn" type="submit" name="submit" value="Search"><i class="fas fa-search"></i></button>
            </form>
        </div>

        <div class="student-list">
            <table class="list">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Enroll Start Date</th>
                        <th>Enroll End Date</th>
                        <th>Duration(Days)</th>
                        <th>Course ID</th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($row = mysqli_fetch_array($result)){

                            $startdate = strtotime($row['enro_start_date']); 
                            $enddate = strtotime($row['enro_end_date']); 
                            $duration = ($enddate - $startdate)/60/60/24;
                        ?>
                        <tr>
                            <td><?php echo $row["stud_id"]; ?></td>
                            <td><?php echo $row["stud_username"]; ?></td>
                            <td><?php echo $row["enro_start_date"]; ?></td>
                            <td><?php echo $row["enro_end_date"]; ?></td>
                            <td><?php echo $duration; ?></td>
                            <td><?php echo $row["cour_id"]; ?></td>
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