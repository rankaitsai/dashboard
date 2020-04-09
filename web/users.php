<?php

// DB連線
require_once 'db.php';
$connection = getDBConnection();

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

