<?php

session_start();

// 若是已經登入狀態下直接導向到index.php
if (!empty($_SESSION['isLogin']) && $_SESSION['isLogin']) {
    header('location: index.php');
}

require_once 'db.php';
$connection = getDBConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
    
        $sql = "SELECT * FROM users WHERE email = '" . $email . "' AND password = '" . $password . "'";

        if ($result = mysqli_query($connection, $sql)) {
            $user = mysqli_fetch_assoc($result);
            if (!empty($user)) {
                $_SESSION['isLogin'] = true;
                $_SESSION['userId'] = $user['id'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['name'] = $user['name'];
                header('location: index.php');
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="./public/css/main.css">
    <title>登入頁面</title>
</head>
<body>
    <div class="form">
        <h2>登入</h2>

        <form action="/login.php" method="post">
            <div class="form-group">
                <label for="email">Email：</label>
                <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
            </div>
            <div class="form-group">
                <label for="password">密碼：</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Password">
            </div>
            <div>
                <span>沒有帳號嗎？<a href="/register.php">註冊</a></span>
            </div>
            <input type="submit" value="登入" class="btn btn-primary">
        </form>
    </div>
</body>
</html>