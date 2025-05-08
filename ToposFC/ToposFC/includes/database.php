<?php
// // Database connection settings
// $host = "localhost";
// $dbname = "TC2005B_601_09";
// // $username = "pruebas";
// $username = "TC2005B_601_09";
// // $password = "pruebas123"; // Note the escaping of special characters
// $password = "2&Oa\$NQ?m3f,"; // Note the escaping of special characters

// try {
//     // Connect to the database
//     $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

//     // Set error mode to exception
//     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// } catch (PDOException $e) {
//     // Error message
//     echo "Connection failed: " . $e->getMessage();
// }


// <?php
// Database connection settings
// $host = "localhost";
// $dbname = "TC2005B_601_09";
// $username = "TC2005B_601_09";
// $password = "2&Oa\$NQ?m3f,"; // Note the escaping of special characters


// $config = [
//     'host' => 'localhost',
//     'dbname' => 'TC2005B_601_09',
//     'username' => 'TC2005B_601_09',
//     'password' => '2&Oa\$NQ?m3f,',
// ];

// $dsn = "mysql:host={$config['host']};dbname={$config['dbname']}";
// $username = $config['username'];
// $password = $config['password'];
$host = "localhost";
$dbname = "TC2005B_601_09";
$username = "TC2005B_601_09";
$password = "2&Oa\$NQ?m3f,"; // Note the escaping of special characters

// 
try {
    // Connect to the database
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // $pdo = new PDO($dsn, $username, $password);

    // Set error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    // Error message
    echo "Connection failed: " . $e->getMessage();
}

