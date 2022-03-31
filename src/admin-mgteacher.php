<?php
session_start();
include "conn.php";

if (isset($_POST['search'])) {
    $search_query ="SELECT *FROM teacher WHERE teac_username LIKE '%".$_POST['search']."%'";
    $result = executeQuery($search_query);

} else {
    //Retreive selected result from the table and display them on page
    $sql = "SELECT * FROM teacher WHERE teac_status = '1'";
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
    <link rel="stylesheet" href="admin-mgteachers.css">
    <link rel="icon" type="image/png" href="Images/Learneasy_favicon.png">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <title>Manage Teacher</title>
</head>
<body>
    <?php include("admin-nav.php")?>
    
    <div class="teac-page-container">
        <p class="teac-page-title">Teacher</p>
        <button class="check-btn" onclick="document.getElementById('approval-list').style.display='block'">Approval</button>
        <div class="search-box">

                <form method="POST" action="admin-mgteacher.php" autocomplete="off">
                    <input id="search-input" name="search" type="text" placeholder="Search courses here...">
                    <input id="real-submit" type="submit" hidden>
                    <button id="search-btn" type="submit" name="submit" value="Search"><i class="fas fa-search"></i></button>
                </form>
        </div>

        <div class="teac-list">
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
                            <td><?php echo $row["teac_id"]; ?></td>
                            <td><?php echo $row["teac_username"]; ?></td>
                            <td><?php echo $row["teac_first_name"]; ?></td>
                            <td><?php echo $row["teac_last_name"]; ?></td>
                            <td><?php echo $row["teac_email"]; ?></td>
                            <td><?php echo $row["teac_join_date"]; ?></td>
                            <td><a href="admin-view-teacher-profile.php?tid=<?php echo $row["teac_id"]; ?>"><button class="viewbtn">View</button></a></td>
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

         
    <div id="approval-list" class="modal">
        <div class="modal-content animate">
            <div class="container">
                <p>Teacher Approval List</p>
                <div class="pending-list">
                    <table class="list">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Education Proof</th>
                            <th>Update Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        include("conn.php");

                        $sql= "SELECT* FROM teacher WHERE teac_status = '0'";

                            $result = mysqli_query($conn, $sql);
                            if(mysqli_num_rows($result) >0){

                            while ($row = mysqli_fetch_array($result)){
                            ?>
                            <tr>
                                <td><?php echo $row["teac_id"]; ?></td>
                                <td><?php echo $row["teac_username"]; ?></td>
                                <td><a href="Documents/<?php echo $row['teac_edu_proof']?>" download=""><?php echo $row['teac_edu_proof'];?></a></td>
                                <td><a onclick="return confirm('Are you sure you want to approve the teacher?')" href='admin-update-status.php?teac_id=<?php echo $row['teac_id'];?>'><button class="updatebtn">Update</button></a></td>
                            </tr>
                        <?php
                            }
                        }
                    ?>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>

    <script>
    // Get the modal
    var modal = document.getElementById('approval-list');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
    </script>
</body>
</html>