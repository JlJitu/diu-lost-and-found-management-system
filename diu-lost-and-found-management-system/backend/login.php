<?php
session_start();
include 'db.php';

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $res = $conn->query("SELECT * FROM users WHERE email='$email'");
    $user = $res->fetch_assoc();
    if($user && password_verify($pass, $user['password'])){
        $_SESSION['user'] = $user;
        header("Location: dashboard.php");
    } else {
        echo "<script>alert('Invalid Login')</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>DIU Login Portal</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Segoe UI', sans-serif; }
        .login-body {
            background-color: #f3f3f3;
            background-image: linear-gradient(0deg, transparent 24%, #fff 25%, #fff 26%, transparent 27%, transparent 74%, #fff 75%, #fff 76%, transparent 77%, transparent), 
                              linear-gradient(90deg, transparent 24%, #fff 25%, #fff 26%, transparent 27%, transparent 74%, #fff 75%, #fff 76%, transparent 77%, transparent);
            background-size: 50px 50px;
            height: 100vh; display: flex; justify-content: center; align-items: center;
        }
        .login-container { width: 100%; max-width: 400px; text-align: center; }
        .diu-logo { max-height: 80px; margin-bottom: 20px; }
        .login-card {
            background: white; border-radius: 4px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            position: relative; overflow: hidden; text-align: left;
        }
        .blue-bar { width: 100%; height: 6px; background: #2e3192; }
        .content { padding: 30px; }
        .content h2 { text-align: center; font-size: 19px; color: #333; margin-bottom: 25px; }
        .input-group { margin-bottom: 15px; }
        .input-group input {
            width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 4px; background: #fafafa;
        }
        .options { display: flex; justify-content: space-between; font-size: 13px; margin-bottom: 25px; color: #666; }
        .btn-login {
            width: 100%; padding: 12px; background: #2e3192; color: white; border: none;
            border-radius: 4px; font-weight: bold; cursor: pointer; font-size: 16px;
        }
        .btn-login:hover { background: #1a1c6a; }
    </style>
</head>
<body class="login-body">

<div class="login-container">
    <img src="images/logo.png" alt="DIU Logo" class="diu-logo">

    <div class="login-card">
        <div class="blue-bar"></div>
        <div class="content">
            <h2>Sign in to your account</h2>
            <form method="POST">
                <div class="input-group">
                    <input type="email" name="email" placeholder="Student ID or Registration ID" required>
                </div>
                <div class="input-group">
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <div class="options">
                    <label><input type="checkbox"> Remember me</label>
                    <a href="#" style="color:#2e3192; text-decoration:none;">Forgot Password?</a>
                </div>
                <button name="login" class="btn-login">Sign In</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>