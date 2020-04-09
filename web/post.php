<?php

session_start();

// 若沒有登入狀態導向登入頁面
if (empty($_SESSION['isLogin']) || empty($_SESSION['userId']) || empty($_SESSION['email'])) {
    header('location: login.php');
}

require_once 'db.php';
$connection = getDBConnection();

$userId = $_SESSION['userId'];
$email = $_SESSION['email'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];

    $sql = "INSERT INTO messages (user_id, title, content) VALUES ('" . $userId . "','" . $title . "','" . $content . "')";
    
    if ($result = mysqli_query($connection, $sql)) {
        header('location: index.php');
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($connection);
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
    <title>留言</title>
</head>
<body>
    <?php require_once 'navbar.php' ?>
    <div class="form">
        <h2>留言功能</h2>

        <form action="post.php" method="POST">
            <div class="form-group">
                <label for="title">標題</label>
                <input type="text" class="form-control" name="title" id="title"></input>
            </div>
            <div class="form-group">
                <label for="content">內容</label>
                <textarea class="form-control" name="content" id="content" rows="3"></textarea>
            </div>
            <input type="submit" value="送出" class="btn btn-primary">
        </form>
    </div>
</body>
</html>