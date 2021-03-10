<?php
    $SERVER = 'localhost';
    $USER_NAME = 'root';
    $PASSWORD = '';
    $DB_NAME = 'basic_php_crud';
    
    $conn = mysqli_connect($SERVER, $USER_NAME, $PASSWORD, $DB_NAME);
    
    if (!$conn) die('Error: '. mysqli_connect_error($conn));
?>