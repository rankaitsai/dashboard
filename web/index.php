<?php

session_start();

// 若沒有登入狀態導向登入頁面
if (empty($_SESSION['isLogin'])) {
    header('location: login.php');
}

require_once 'db.php';
$sql = 'SELECT messages.*, users.id as user_id, users.name, users.email FROM messages LEFT JOIN users on messages.user_id = users.id';

$connection = getDBConnection();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="./public/css/main.css?a=4">
    <title>列表</title>
</head>
<body>
    <?php require_once 'navbar.php' ?>
    <div class="container">
        <?php if (!empty($tips)) { ?>
            <?php foreach($tips as $tip) { ?>
                <span><?php echo $tip ?></span><br>
            <?php } ?>
        <?php }?>
        <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">姓名</th>
                        <th scope="col">Email</th>
                        <th scope="col">標題</th>
                        <th scope="col">建立時間</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($results = mysqli_query($connection, $sql)) { ?>
                        <?php if (mysqli_num_rows($results) > 0)  { ?>
                            <?php while($row = mysqli_fetch_array($results)) { ?>
                            <tr>
                                <th scope="row"><?php echo $row['id'] ?></th>
                                <td><?php echo $row['name'] ?></td>
                                <td><?php echo $row['email'] ?></td>
                                <td><?php echo $row['title'] ?></td>
                                <td><?php echo $row['created_at'] ?></td>
                                <td >
                                    <?php if ($_SESSION['userId'] === (int)$row['user_id']) { ?>
                                        <a class="btn btn-primary" href="edit.php?id=<?php echo $row['id'] ?>">Edit</a>
                                        <form style="display:inline" method="POST" action="delete.php">
                                            <input type="hidden" name="messageId" value=<?php echo $row['id'] ?>>
                                            <input type="submit" class="btn btn-danger" value="Delete">
                                        </form>
                                    <?php } ?>
                                </td>
                            </tr>
                                <?php } ?>
                        <?php } ?>
                    <?php } ?>
                </tbody>
            </table>
    </div>
</body>
</html>