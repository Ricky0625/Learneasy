<?php
session_start();
include "conn.php";

if (isset($_POST['search'])) {
    $search_query ="SELECT *FROM student WHERE stud_username LIKE '%".$_POST['search']."%'";
    $result = executeQuery($search_query);

} else {
    //Retreive selected result from the table and display them on page
    $sql = "SELECT * FROM student ";
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
    <link rel="stylesheet" href="admin-mgstudents.css">
    <link rel="icon" type="image/png" href="Images/Learneasy_favicon.png">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <title>Manage Student</title>
</head>
<body>
    <?php include("admin-nav.php")?>

    <div class="stut-page-container">
        <p class="stut-page-title">Students</p>
        <div class="search-box">
                <form method="POST" action="admin-mgstudent.php" autocomplete="off">
                    <input id="search-input" name="search" type="text" placeholder="Search courses here...">
                    <input id="real-submit" type="submit" hidden>
                    <button id="search-btn" type="submit" name="submit" value="Search"><i class="fas fa-search"></i></button>
                </form>
        </div>
        <div class="stut-list">
            <table class="list">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email Address</th>
                        <th>Join Date</th>
                        <th>View</th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($row =mysqli_fetch_array($result)){?>
                        <tr>
                            <td><?php echo $row["stud_id"]; ?></td>
                            <td><?php echo $row["stud_username"]; ?></td>
                            <td><?php echo $row["stud_first_name"]; ?></td>
                            <td><?php echo $row["stud_last_name"]; ?></td>
                            <td><?php echo $row["stud_email"]; ?></td>
                            <td><?php echo $row["stud_join_date"]; ?></td>
                            <td><a href="admin-view-student-profile.php?sid=<?php echo $row["stud_id"]; ?>" '><button class="viewbtn">View</button></a></td>
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
