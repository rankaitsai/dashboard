<?php

session_start();

if (empty($_SESSION['isLogin']) || !$_SESSION['isLogin'] || empty($_SESSION['userId']) || empty($_SESSION['name']) || empty($_SESSION['email'])) {
    header('location: login.php');
}

require_once 'db.php';
$connection = getDBConnection();

// 當前使用者id
$userId = $_SESSION['userId'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['messageId'])) {
        exit;
    }

    $tips = [];
    $messageId = $_POST['messageId'];

    // 確認該留言是不是當前使用者
    $findSql = "SELECT * from messages where id = " . $messageId . " and user_id = " . $userId;

    // 若成功且影響數量為一筆
    if ($result = mysqli_query($connection, $findSql)) {
        if (mysqli_num_rows($result) === 1) {
            // 刪除
            $deleteSql = "DELETE FROM messages where id = " . $messageId;
    
            if ($result = mysqli_query($connection, $deleteSql)) {
                if (mysqli_affected_rows($connection) === 1) {
                    array_push($tips, '刪除成功');
                }
                else {
                    array_push($tips, '刪除失敗');
                }
            }
            else {
                array_push($tips, '錯誤');
            }
        }
    }
}

header('location: index.php');