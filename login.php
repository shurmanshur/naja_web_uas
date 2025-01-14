<?php
session_start();
require 'functions.php';

if(isset($_POST['loginBtn']) == true){
    if (login($_POST)>0) {
        echo "<script>alert('Login berhasil ! ')
        document.location.href = 'index.php';
        </script>";
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['password'] = $_POST['password'];
    }else{
        echo "<script>alert('Login gagal ! ')
        document.location.href = 'login.php';
        </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
    <div class="wrapper fadeInDown">
        <div id="formContent">
            <!-- Tabs Titles -->
            <h2 class="active"> Sign In </h2>

            <!-- Icon -->
            <div class="fadeIn first">
            <img src="https://img.freepik.com/premium-vector/illustration-programmer-computer-vector-technology-concept-web-digital-design-programming_1013341-205245.jpg" id="icon" alt="User Icon" />
            </div>

            <!-- Login Form -->
            <form method="post" action="">
            <input type="text" id="login" class="fadeIn second" name="username" placeholder="username">
            <input type="password" id="login" class="fadeIn third" name="password" placeholder="password">
            <input type="submit" class="fadeIn fourth" value="Login" name="loginBtn">
            </form>

            <!-- Remind Passowrd -->
            <div id="formFooter">
            <a class="underlineHover" href="register.php">Register?</a>
            </div>

        </div>
    </div>
    </div>
</body>
</html>