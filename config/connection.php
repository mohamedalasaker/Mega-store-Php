<?php 
$connection = [
    'host' => 'localhost',
    'username' => 'root',
    'password' => '',
    'db_name' => 'mega store',
];
$conn = new mysqli(
    $connection['host'],
    $connection['username'],
    $connection['password'],
    $connection['db_name']
);
if($conn->connect_error){
    echo 'something gone wrond' . $conn->connect_error;
    die();
}