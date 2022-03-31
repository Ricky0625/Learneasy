<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="teacher-register.css">
    <script src="https://kit.fontawesome.com/8e94eefdff.js" crossorigin="anonymous"></script>
    <link rel="icon" type="image/png" href="Images/Learneasy_favicon.png">
    <title>Become A Teacher</title>
</head>
<body>
    <?php include("visitor-nav.php");?>
    <p class="form-title">Become a teacher on Learneasy!</p>
    <section class="teacher-register">
        <form method="POST" action="teacher-insert.php" id="tr-form" enctype='multipart/form-data'>
            <div class="flex-row">
                <div class="flex-label-input">
                    <span class="tr-label">First Name :</span>
                    <input type="text" class="tr-input-short" name="teac_first_name" required>
                </div>
                <div class="flex-label-input lname">
                    <span class="tr-label">Last Name :</span>
                    <input type="text" class="tr-input-short" name="teac_last_name" required>
                </div>
            </div>
            <div class="flex-label-input top-space">
                <span class="tr-label">Username :</span>
                <input type="text" class="tr-input" name="teac_username" required>
            </div>
            <div class="flex-label-input top-space">
                <span class="tr-label">Email :</span>
                <input type="email" class="tr-input" name="teac_email" required>
            </div>
            <div class="flex-label-input top-space">
                <span class="tr-label">Password :</span>
                <div class="password-showhide">
                    <input type="password" class="tr-input" id="password-field"  name="teac_password" required>
                    <button type="button" onclick="showHide()" id="show-hide-pass"><i id="eye-pass" class="fas fa-eye"></i></button>
                </div>
            </div>
            <div class="flex-label-input top-space">
                <span class="tr-label">Confirm Password :</span>
                <div class="password-showhide">
                    <input type="password" class="tr-input" id="conpassword-field"  name="teac_confirm_password"required>
                    <button type="button" onclick="showHideCon()" id="show-hide-conpass"><i id="eye-conpass" class="fas fa-eye"></i></button>
                </div>
            </div>
            <div class="flex-label-input top-space">
                <span class="tr-label">Proof of Education</span>
                <p class="tr-paragraph">To get verified as a teacher on Learneasy, the applicant must submit proof of education to prove themselves qualified to create course for the students.</p>
                <input type="file" id="real-file" hidden="hidden" accept=".docx,.pdf" name="teac_edu_proof" required="required">
                <div class="flex-row upload-file">
                    <button type="button" id="custom-button">Choose File</button>
                    <span id="custom-text">No file chosen, yet.</span>
                </div>
            </div>
            <div class="current-date">
            <input type="hidden" class="teacher-join-date" name="teac_join_date" value="<?php echo  date("Y-m-d");?>">
            </div>
            <div id="terms">
                <input id="check" type="checkbox" required="required">
                <span>Agree to <a href="">Terms & Conditions</a>.</span>
            </div>
            <div class="flex-column">
                <input id="register-btn" type="submit" value="SIGN UP">
                <span>Already a teacher? <a href="">Sign In</a>.</span>
            </div>
        </form>
        <img src="Images/teacher-register-illu.png" alt="">
    </section>

    <!--Javascript to turn normal button to a upload file button-->
    <script type="text/javascript">
        const realFileBtn = document.getElementById("real-file");
        const customBtn = document.getElementById("custom-button");
        const customTxt = document.getElementById("custom-text");

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

    <?php include("footer.php")?>

    <!--Javascript for the show/hide password button for password-->
    <script type="text/javascript">
        const passwordField = document.getElementById("password-field");
        const eyePass = document.getElementById("eye-pass");

        function showHide(){
            if (passwordField.type === "password"){
                passwordField.type = "text";
                passwordField.focus();
                eyePass.classList.remove("fa-eye");
                eyePass.classList.toggle("fa-eye-slash");
            } else {
                passwordField.type = "password"
                eyePass.classList.remove("fa-eye-slash");
                eyePass.classList.toggle("fa-eye");
            }
        };
    </script>

    <!--Javascript for the show/hide password button for confirm password-->
    <script type="text/javascript">
        const conpasswordField = document.getElementById("conpassword-field");
        const eyeConPass = document.getElementById("eye-conpass");
            
        function showHideCon(){
            if (conpasswordField.type === "password"){
                conpasswordField.type = "text";
                conpasswordField.focus();
                eyeConPass.classList.remove("fa-eye");
                eyeConPass.classList.toggle("fa-eye-slash");
            } else {
                conpasswordField.type = "password"
                eyeConPass.classList.remove("fa-eye-slash");
                eyeConPass.classList.toggle("fa-eye");
            }
        };
    </script>
</body>
</html>