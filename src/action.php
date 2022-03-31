<?php

if (isset($_POST['search'])) {
    $search_query = "SELECT *FROM course WHERE cour_name LIKE '%" . $_POST['search'] . "%'";
    $result = executeQuery($search_query);
} else {
    $default_query = "SELECT *FROM course";
    $result = executeQuery($default_query);
}

function executeQuery($query) {
    $connect = mysqli_connect("localhost", "root", "", "learneasy");
    $result = mysqli_query($connect, $query);
    return $result;
}
?>

<?php
while ($res = mysqli_fetch_array($result)): {
    $name = $res['cour_name'];
    $category = $res['cour_category'];
    $id = $res['teac_id'];
}
?>
    <?php
    include("conn.php");
    if (isset($_POST['query'])) {
        $inputText = $_POST['query'];
        $query = "SELECT * FROM course WHERE cour_name LIKE '%$inputText%' ";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                /* User Will Be Directly Transferred To The Specific Course Detail Page After Clicked */
                echo"
                    <form method='POST' action='show-course.php' class='listed-item'>
                    <a name='submit' class='list-group-item'>". $row['cour_name'] . "</a>
                    </form>               
                    ";
            }
        } else {
            echo "<p> No Found</p>";
        }
    }
    ?>
<?php endwhile; ?>

