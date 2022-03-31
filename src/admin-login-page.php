<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin-login.css">
    <link rel="icon" type="image/png" href="Images/Learneasy_favicon.png">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <title>Admin Login</title>
</head>
<body>
    <!--Login Content Information-->
    <div class="login-container">
        <div class="left-content">
            <form class="login-box" method="POST" action="admin-login.php">
                <h2>Learn<b>easy</b></h2>
                <h3>Admin Login</h3>
                    <div class="acc-details">
                         <i class="fas fa-user-circle"></i>
                        <input type="text" placeholder="Username" name="adm_username" required>
                    </div>
                    <div class="acc-details">
                        <i class="fas fa-unlock-alt icon"></i>
                        <input type="password" id="myInput" placeholder="Password" minlength="8" name="adm_password" required >
                    </div>
                    <div class="showpass">
                        <input type="checkbox" onclick="showPass()">
                            <label for="terms">
                                View your password
                            </label>
                    </div>
                    <div class="sign-in-btn">
                        <input type="submit" value="SIGN IN" name="submit">
                    </div>
            </form>
        </div>
        <div class="right-content">
            <div class="pic-box">
                <img src="Images/admin-login-illustration.png">
            </div>
        </div>
    </div>
 <!--Show password function-->
    <script>
    function showPass() {
        var x = document.getElementById("myInput");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
    </script>

</body>
</html>
