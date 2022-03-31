<?php include("register-stud.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="signup.css">
    <link rel="icon" href="Images/LE_Favicon.png">
    <script src="https://kit.fontawesome.com/8e94eefdff.js" crossorigin="anonymous"></script>
    <title>Sign Up</title>
</head>
<body> 
    <?php include("visitor-nav.php"); ?>

 <div class="container-register">
    <section class="registration-form">
        <?php include("backBtn.php");?>
        <p class="registration-title">Sign Up and Start Learning!</p>
            <form action="register-stud.php" method="POST" id="signup">
                    <div class="details">
                        <label for="first-name">
                            <span>First Name :</span>
                        </label>
                        <input type="text" name="stud_first_name" id="first-name" required>
                    </div>
                    <div class="details">
                        <label for="last-name">
                            <span>Last Name :</span>
                        </label>
                        <input type="text" name="stud_last_name" id="last-name" required>
                    </div>
                    <div class="details">
                        <label for="username">
                            <span>Username :</span>
                        </label>
                        <input type="text" name="stud_username" id="username" required>
                    </div>
                    <div class="details">
                        <label for="email">
                            <span>Email :</span>
                        </label>
                        <input type="email" name="stud_email" id="email" required>
                    </div>
                    <div class="details">
                        <label for="password">
                             <span>Password :</span>
                        </label>
                        <div class="password-showhide">
                             <input type="password" name="stud_password" id="password-field" minlength="8" required>
                             <button type="button"><i id="eye-pass"  onclick="showHide()" id="show-hide-pass"  class="fas fa-eye"></i></button>
                        </div>
                    </div>
                    <div class="details">
                        <label for="confirm-password">
                             <span>Confirm Password :</span>
                        </label>
                        <div class="password-showhide">
                             <input type="password" name="stud_confirm_password" id="conpassword-field" minlength="8" required>
                             <button type="button"><i id="eye-conpass" onclick="showHideCon()" id="show-hide-conpass" class="fas fa-eye"></i></button>
                        </div>
                    </div>
                        <div class="terms-conditions">
                            <input type="checkbox" required>
                            <label for="tc">
                                Agree to <a href="https://elearningindustry.com/legal/platform-terms-and-conditions" target="_NEW">Terms & Conditions</a>
                            </label>
                        </div>
                        <div class="signup-button">
                            <input type="submit" value="sign up" name="stud-reg">
                        </div>
                        <div class="have-account">
                            <label for="have-an-account">
                                Already have an account? <a href="Student-SignIn.php">Sign In</a>
                            </label>
                        </div>
            </form>
    </section>

    <div class="illustration">
        <img src="Images/student-signup.png">
    </div>

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
 </div>

    <?php include ("footer.php"); ?>
                    
</body>
</html>


  
