<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin-pagination.css">
    <title>Pagination</title>
</head>
<body>
    <?php
    echo '<br>';
    //Connect to database
    $con = mysqli_connect('localhost', 'root', '', );
    mysqli_select_db($con, 'learneasy');

    //Define how many results you want per page
    $result_per_page = 4;

    //Find out the number of results stored in the table
    $sql = "SELECT * FROM course";
    $result = mysqli_query($con, $sql);
    $number_of_results = mysqli_num_rows($result);

    //Determine number of total pages available
    $number_of_pages = ceil($number_of_results/$result_per_page);

    //Determine which page number visitor is currently on
    if (!isset($_GET['page'])) {
        $page = 1;
    }
    else {
        $page = $_GET['page'];
    }

    //Determine the SQL LIMIT staring number for the results on the displaying page
    $starting_nunm = ($page-1)*$result_per_page;

    //Retreive selected result from the table and display them on page
    $sql = "SELECT * FROM course LIMIT " . $starting_nunm . ',' . $result_per_page;
    $result = mysqli_query($con, $sql);

    while ($row = mysqli_fetch_array($result)){
        echo $row['cour_id'] . '<br>';
    }
    ?>
    
    <div class="page-links-div">
        <span class="page-links">Page</span>
    <?php
    //Display the links to the pages
    for ($page=1;$page<=$number_of_pages;$page++) {
    ?>
        <a class="page-links" href="admin-pagination.php?page=<?php echo $page;?>"><?php echo $page;?></a>
    <?php
        }
    ?>
    </div>

</body>
</html>