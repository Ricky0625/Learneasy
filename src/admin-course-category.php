<?php
session_start();
if(isset($_GET['get_category'])){
    if ($_GET['get_category'] == 'all'){
        $_SESSION['page-title'] = "Courses";
        echo "<script>location.href='admin-show-course.php?'</script>";
    }
    elseif ($_GET['get_category'] == 'business'){
        $_SESSION['page-title'] = "Business Courses";
        echo "<script>location.href='admin-show-bus-course.php?'</script>";
    }
    elseif ($_GET['get_category'] == 'design'){
        $_SESSION['page-title'] = "Design Courses";
        echo "<script>location.href='admin-show-des-course.php?'</script>";
    }
    elseif ($_GET['get_category'] == 'it'){
        $_SESSION['page-title'] = "IT Courses";
        echo "<script>location.href='admin-show-it-course.php?'</script>";
    }
    else{
    }
}
else{
}
?>