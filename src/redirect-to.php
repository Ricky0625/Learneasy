<?php
session_start();
if(isset($_SESSION['logged_username'])){
    echo '<script>location.href="student-home.php"</script>';
}elseif(isset($_SESSION['logged_teacher'])){
    echo '<script>location.href="teacher-home.php"</script>';
}else{
    echo '<script>location.href="index.php"</script>';
}
?>