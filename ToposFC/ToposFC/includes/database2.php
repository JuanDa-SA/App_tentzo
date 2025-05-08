<?php
$dsn = "mysql:host=localhost;dbname='TC2005B_601_09',;charset=utf8mb4";
$username = 'TC2005B_601_09';
$password = '2&Oa\$NQ?m3f,';

try {
    $conn = new PDO($dsn, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    die();
}

