<?php

session_start();

// 若沒有登入狀態導向登入頁面
if (empty($_SESSION['isLogin'])) {
    header('location: login.php');
}

require_once 'db.php';
$connection = getDBConnection();

// 取資料
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (empty($_GET['id']) || !is_numeric($_GET['id'])) {
        header('location: index.php');
    }

    $messageId = $_GET['id'];
    $sql = 'SELECT * from messages where id = ' . $messageId . ' and user_id = ' . $_SESSION['userId'];

    if ($result = mysqli_query($connection, $sql)) {
        // 如果有找到
        if (mysqli_num_rows($result) === 1) {
            $message = mysqli_fetch_assoc($result);

            $title = $message['title'];
            $content =  $message['content'];
        }
        else {
            header('location: post.php');
        }
    }
}

// 更新資料
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];

    if (empty($_POST['messageId'])) {
        echo 'sdokasopdk';
    }

    $messageId = $_POST['messageId'];

    $sql = "UPDATE messages SET title = '" . $title . "', content = '" . $content . "' where id = " . $messageId . " and user_id = " . $_SESSION['userId'];

    if ($result = mysqli_query($connection, $sql)) {
        // 更新成功
        if (mysqli_affected_rows($connection) === 1) {
            header('location: edit.php?id=' . $messageId);
        }
        // 失敗
        else {

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
    <link rel="stylesheet" href="./public/css/main.css?a=4">
    <title>Document</title>
</head>
<body>
    <?php require_once 'navbar.php' ?>
    <div class="form">
        <h2>編輯留言</h2>

        <form action="edit.php" method="POST">
            <input type="hidden" name="messageId" value="<?php echo $_GET['id'] ?>">
            <div class="form-group">
                <label for="title">標題</label>
                <input type="text" class="form-control" name="title" id="title" value="<?php echo !empty($title) ? $title : '' ?>"></input>
            </div>
            <div class="form-group">
                <label for="content">內容</label>
                <textarea class="form-control" name="content" id="content" rows="3"><?php echo !empty($content) ? $content : '' ?></textarea>
            </div>
            <input type="submit" value="修改" class="btn btn-primary">
        </form>
    </div>
</body>
</html>