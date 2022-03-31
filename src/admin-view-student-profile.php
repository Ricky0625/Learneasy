<?php
session_start();

if(!isset($_SESSION['adm_username'])){
    echo '<script>alert("You must log in to your account first.")</script>';
    echo '<script>location.href="admin-login-page.php"</script>';
}
include("conn.php");

header('Content-Type: text/html; charset=ISO-8859-1');

//Find the info of teacher
$sid = $_GET['sid'];
$finduser_sql = "SELECT * FROM student WHERE stud_id = '$sid'";
$result = mysqli_query($conn, $finduser_sql);
$row = mysqli_fetch_array($result);
$sid = $row['stud_id'];
$fname = $row['stud_first_name'];
$lname = $row['stud_last_name'];
$join_date = strtotime($row['stud_join_date']);
$convert_join_date = date('Y/m/d', $join_date);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin-students-profile.css">
    <link rel="stylesheet" href="admin-mo-dalss.css">
    <link rel="icon" type="image/png" href="Images/Learneasy_favicon.png">
    <script src="https://kit.fontawesome.com/8e94eefdff.js" crossorigin="anonymous"></script>
    <title><?php echo $fname;?> <?php echo $lname;?></title>
</head>
<body>
    <?php include("admin-nav.php")?>
        <div class="backbtn">
            <button onclick="goBack()"><i class="fas fa-caret-left"></i>Back</button>
        </div>

    <section class="top-profile">
        <div class="profile-section">
            <div class="cover">
                <img class="profile-cover container" src="Images/<?php echo $row['stud_cover_picture'];?>" alt="">
                <div class="overlay-blur container"></div>
            </div>
            <img id="profile-pic" src="Images/<?php echo $row['stud_profile_picture'];?>" alt="profile-pic">
            <div class="user-info">
                <div class="fullname-and-edit">
                    <div class="fullname">
                        <p class="first-name"><?php echo $fname;?></p>
                        <p class="last-name"><?php echo $lname;?></p>
                    </div>
                    <a onclick="return confirm('Are you sure you want to delete?')" href='admin-deletestudent.php?sid=<?php echo $sid;?>'><button class="deletebtn">Delete</button></a>
                    
                </div>
                <p class="username"><?php echo $row['stud_username'];?></p>
                <div class="join-date">
                    <i class="far fa-calendar"></i>
                    <p class="exact-date">Joined <?php echo $convert_join_date?></p>
                </div>
                <div class="user-bio">
                    <i class="fas fa-comment-alt"></i>
                    <p class="bio"><?php echo ($row['stud_bio']);?></p>
                </div>
            </div>
        </div>
    </section>
    <?php
    $num_of_course_sql = "SELECT * FROM enrolment WHERE stud_id = '$sid'";
    $resultNum = mysqli_query($conn, $num_of_course_sql);
    if($resultNum){
        
        $rowNum = mysqli_num_rows($resultNum);

        if($rowNum){
            $num_course = $rowNum;
        }else{
            $num_course = 0;
        }
        mysqli_free_result($resultNum);
    }
    ?>
    <section class="course-stats">
        <div class="num-of-course">
            <div class="nof-icon-label">
                <i class="fas fa-book"></i>
                <p class="nof-label">Number of Course Enrolled</p>
            </div>
            <p class="nof-value"><?php echo $num_course;?></p>
        </div>
        <?php
        $favorite = "-";
        $join_business = "SELECT * FROM enrolment LEFT JOIN course ON course.cour_id = enrolment.cour_id WHERE enrolment.stud_id = '$sid' AND course.cour_category = 'Business'";
        $resultBus = mysqli_query($conn, $join_business);
        if($resultBus){
            
            $rowBus = mysqli_num_rows($resultBus);

            if($rowBus){
                $num_bus = $rowBus;
            }else{
                $num_bus = 0;
            }
            mysqli_free_result($resultBus);
        }

        $join_design = "SELECT * FROM enrolment LEFT JOIN course ON course.cour_id = enrolment.cour_id WHERE enrolment.stud_id = '$sid' AND course.cour_category = 'Design'";
        $resultDes = mysqli_query($conn, $join_design);
        if($resultDes){
            
            $rowDes = mysqli_num_rows($resultDes);

            if($rowDes){
                $num_des = $rowDes;
            }else{
                $num_des = 0;
            }
            mysqli_free_result($resultDes);
        }

        $join_it = "SELECT * FROM enrolment LEFT JOIN course ON course.cour_id = enrolment.cour_id WHERE enrolment.stud_id = '$sid' AND course.cour_category = 'IT'";
        $resultIt = mysqli_query($conn, $join_it);
        if($resultIt){
            
            $rowIt = mysqli_num_rows($resultIt);

            if($rowIt){
                $num_it = $rowIt;
            }else{
                $num_it = 0;
            }
            mysqli_free_result($resultIt);
        }

        if($num_bus>$num_des AND $num_bus>$num_it){
            $favorite = 'Business';
        }
        if($num_des>$num_it AND $num_des>$num_bus){
            $favorite = 'Design';
        }
        if($num_it>$num_bus AND $num_it>$num_des){
            $favorite = 'IT';
        }
        ?>
        <div class="fav-course">
            <div class="fav-icon-label">
                <i class="fas fa-heart"></i>
                <p class="fav-course-label">My favorite Course</p>
            </div>
            <p class="fav-course-value"><?php echo $favorite;?></p>
        </div>
    </section>
    <script>
    // Get the modal
    var modal = document.getElementById("edit-profile-modal");
    
    // Get the button that opens the modal
    var btn = document.getElementById("edit-profile-button");
    
    // Get the <span> element that close-modals the modal
    var span = document.getElementsByClassName("close-modal")[0];
    
    // When the user clicks the button, open the modal 
    btn.onclick = function() {
      modal.style.display = "block";
    }
    
    // When the user clicks on <span> (x), close-modal the modal
    span.onclick = function() {
      modal.style.display = "none";
    }
    
    // When the user clicks anywhere outside of the modal, close-modal it
    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }
    </script>

    <!--Count the first name characters-->
    <script>
    function countupdatefname(str) {
        var length = str.length;
        document.getElementById("countfname").innerHTML = length + '/30';
    }
    </script>

    <!--Count the last name characters-->
    <script>
    function countupdatelname(str) {
        var length = str.length;
        document.getElementById("countlname").innerHTML = length + '/30';
    }
    </script>

    <!--Count the bio characters-->
    <script>
    function countupdatebio(str) {
        var length = str.length;
        document.getElementById("countbio").innerHTML = length + '/250';
    }
    </script>

    <!--Javascript to turn normal button to a upload file button-->
    <script type="text/javascript">
        const realFileBtn = document.getElementById("real-profile");
        const customBtn = document.getElementById("custom-button-profile");
        const customTxt = document.getElementById("custom-profile-text");

        customBtn.addEventListener("click", function(){
            realFileBtn.click();
        });

        realFileBtn.addEventListener("change", function(){
            if (realFileBtn.value) {
                customTxt.innerHTML = realFileBtn.value.match(/[\/\\]([\w\d\s\.\-\(\)]+)$/)[1];
            } else{
                customTxt.innerHTML = "No file chosen, yet."
            }
        });
    </script>

    <!--Javascript to turn normal button to a upload file button-->
    <script type="text/javascript">
        const realCoverBtn = document.getElementById("real-bg");
        const customButton = document.getElementById("custom-button-cover");
        const customCoverTxt = document.getElementById("custom-cover-text");

        customButton.addEventListener("click", function(){
            realCoverBtn.click();
        });

        realCoverBtn.addEventListener("change", function(){
            if (realCoverBtn.value) {
                customCoverTxt.innerHTML = realCoverBtn.value.match(/[\/\\]([\w\d\s\.\-\(\)]+)$/)[1];
            } else{
                customCoverTxt.innerHTML = "No file chosen, yet."
            }
        });
    </script>

    <script>
        //back button
        function goBack() {
        window.history.back();
        }
    </script>
</body>
</html>