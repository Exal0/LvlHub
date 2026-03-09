<?php
$host = 'mysql-server';
$dbname = 'LvlHub';
$username = 'root';
$password = 'root';

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
   $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password, $options);
}catch (Exception $e) {
    echo "Erreur : " . $e->getMessage();
}


?>