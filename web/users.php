<?php

// DB連線
$connection = mysqli_connect('192.168.99.101:3309', 'root', '140813');

if (!$connection) {
    die('Connection failed');
}

if (!mysqli_select_db($connection, 'dashboards')) {
    die('Database error');
}

$userSchemaSql = "CREATE TABLE users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(30) NOT NULL,
    email VARCHAR(50),
    password VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if (mysqli_query($connection, $userSchemaSql)) {
    echo 'Create Successfully';
}
else {
    echo mysqli_error($connection);
}

