<?php

session_start();

// 若沒有登入狀態導向登入頁面
if (empty($_SESSION['isLogin'])) {
    header('location: login.php');
}

require_once 'db.php';
$sql = 'SELECT * FROM messages';

$connection = getDBConnection();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="./public/css/main.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php if ($results = mysqli_query($connection, $sql)) { ?>
                    <?php if (mysqli_num_rows($results) > 0)  { ?>
                        <?php foreach(mysqli_fetch_assoc($results) as $message) { ?>
                            <div class="card">
                                <div class="title"><?php  $message['content'] ?></div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div>
                                            姓名：
                                        </div>

                                        <div>
                                            Email：
                                        </div>

                                        <div>
                                            建立日期：
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        留言內容：
                                    </div>
                                </div>
                                <div style="float:right">
                                    <a class="btn btn-primary" href="/edit">編輯</a>
                                    <form action="">
                                        <input class="btn btn-danger" type="submit" value="刪除">
                                    </form>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
    </div>
</body>
</html>