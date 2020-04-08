<?php

require_once 'db.php';

$connection = getDBConnection();

$userSchemaSql = "CREATE TABLE messages (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT(6) UNSIGNED NOT NULL,
    title VARCHAR(100),
    content TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
)";

if (mysqli_query($connection, $userSchemaSql)) {
    echo 'Create Successfully';
}
else {
    echo mysqli_error($connection);
}