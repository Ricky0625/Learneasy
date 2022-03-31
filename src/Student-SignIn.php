<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="sign-in.css">
    <link rel="icon" href="Images/LE_Favicon.png">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <title>Sign In</title>
</head>
<body> 
    <!--<?php include ("#"); ?>-->

    <!--Login Background-Form-->
    <div class="background-img">
        <div class="bottom-top-vertor">
            <img src="Images/vector_login.png">
        </div>
        <div class="bottom-left-ellipse">
            <img src="Images/ellipse_login.png">
        </div>
    </div>
    
    <!--Login Container Box-->
    <section class="container-login">
            <div class="login-form">
                <!--left container form-->
                 <div class="left-login-form">
                    <div class="web-name">
                        <p>Learn<b>easy</b></p>
                    </div>
                    <div class="login-title">
                        <h2>New to Learneasy?</h2>
                        <div class="sign-in-title">
                            <h3>Sign up a free account and start learning!</h3>
                            <button onclick="location.href='Student-SignUp.php';">Sign Up</button>
                        </div>
                    </div>
                    <div class="illustration-login-form">
                        <img src="Images/login-image.png">
                    </div>
                 </div>
                <!--Line between left and right container-login-form-->
                 <div class="line-middle-form">
                    <div class="seperateline"></div>
                 </div>
                <!--Right container form-->
                 <div class="right-login-form">
                     <div class="login-acc-title">
                        <h3>Login</h3>
                     </div>
                     <div class="account-login-information">
                         <!--Form to collect data when login, username and password-->
                        <form action="login.php" method="POST" id="signup">
                            <div class="selection">
                                <div class="selector-div">
                                    <input type="radio" id="roleStud" class ="role-selection" name="roleSelector" value="student" checked>
                                    <label class="selection-label" for="roleStud">Student</label>
                                </div>
                                <div class=seperateline-stu-and-tea></div>
                                <div class="selector-div">
                                    <input type="radio" id="roleTea" class ="role-selection" name="roleSelector" value="teacher">
                                    <label class="selection-label" for="roleTea">Teacher</label>
                                </div>
                            </div>
                                <div class="acc-details">
                                    <i class="fas fa-user-circle"></i>
                                    <input type="text" id="student" name="log_username" placeholder="Username" required >
                                </div>
                                <div class="acc-details">
                                    <i class="fas fa-unlock-alt icon"></i>
                                    <input type="password" id="password" name="log_password" placeholder="Password" required >
                                </div>
                                    <div class="showpass">
                                        <input type="checkbox" onclick="showPass()">
                                        <label for="terms">
                                             View your password
                                        </label>
                                    </div>
                                <div class="sign-in-btn">
                                    <input type="submit" name="stud_login">
                                </div>
                        </form>
                     </div>
                 </div>
            </div>
    </section>

    <!--Show password function-->
    <script>
    function showPass() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>
</body>
</html>