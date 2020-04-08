<?php

require_once 'db.php';

session_start();

// 若是已經登入狀態下直接導向到index.php
if (!empty($_SESSION['isLogin']) && $_SESSION['isLogin']) {
    header('location: index.php');
}

// if (!empty($_POST['name']) && ) {
    
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <title>註冊頁面</title>
</head>
<body>
    <form action="/register.php" method="POST">
        姓名：<input type="text" name="name"><br>
        Email：<input type="text" name="email"><br>
        密碼：<input type="text" name="password"><br>
        <input type="submit" value="註冊" class="btn btn-primary">
    </form>
</body>
</html>