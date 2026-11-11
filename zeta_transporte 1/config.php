<?php
// Conexão com MariaDB usando PDO.
$host = 'localhost';
$db   = 'zeta_transporte';
$user = 'root';
$pass = ''; // Altere se seu MariaDB tiver senha.

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$db;charset=utf8mb4",
        $user,
        $pass,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
         PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]
    );
} catch (PDOException $e) {
    die('Não foi possível conectar ao banco. Confira o arquivo config.php e importe database.sql.');
}
