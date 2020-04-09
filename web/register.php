<?php

session_start();

// 若是已經登入狀態下直接導向到index.php
if (!empty($_SESSION['isLogin']) && $_SESSION['isLogin']) {
    header('location: index.php');
}

require_once 'db.php';
$connection = getDBConnection();

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($name)) {
        array_push($errors, '姓名不可為空');
    }

    if (empty($email)) {
        array_push($errors, 'Email不可為空');
    }
    else {
        // 檢查是否已經被註冊
        $sql = "SELECT email from users where email = '" . $email . "'";
        if ($result = mysqli_query($connection, $sql)) {
            if (mysqli_num_rows($result) >= 1) {
                array_push($errors, '此email已經被註冊');
            }
        }
    }
    

    if (empty($password)) {
        array_push($errors, '密碼不可為空');
    }

    // 若無錯誤新增到DB
    if (empty($errors)) {
        $sql = "INSERT INTO users (name, email, password) VALUES ('" . $name . "','" . $email . "','" . $password . "')";

        if ($result = mysqli_query($connection, $sql)) {
            $_SESSION['isLogin'] = true;
            $_SESSION['userId'] = mysqli_insert_id($connection);
            $_SESSION['email'] = $email;
            $_SESSION['name'] = $name;
            header('location: index.php');
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($connection);
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
    <title>註冊頁面</title>
</head>
<body>
    <?php require_once 'navbar.php' ?>
    <div class="form">
        <h2>歡迎註冊</h2>
        <form action="" method="POST">
            <div class="form-group">
                <label for="name">姓名：</label>
                <input type="name" name="name" class="form-control" id="name" placeholder="Enter name">
            </div>
            <div class="form-group">
                <label for="email">Email：</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Enter email">
            </div>
            <div class="form-group">
                <label for="password">密碼：</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Password">
            </div>
            <div>
                <span>已經有帳號了？<a href="/login.php">登入</a></span>
            </div>
            <div>
                <?php if (!empty($errors)) { ?>
                    <?php foreach($errors as $error) { ?>
                        <span style="color:red; font-size:8px;"><?php echo $error; ?></span><br>
                    <?php } ?>
                <?php } ?>
            </div>
            <input type="submit" value="註冊" class="btn btn-primary">
        </form>
    </div>
</body>
</html>