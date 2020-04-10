<?

function getDBConnection()
{
    // DB連線
    $connection = mysqli_connect('192.168.1.20:3309', 'root', '140813');
    
    if (!$connection) {
        die('Connection failed');
    }
    
    if (!mysqli_select_db($connection, 'dashboards')) {
        die('Database error');
    }

    return $connection;
}