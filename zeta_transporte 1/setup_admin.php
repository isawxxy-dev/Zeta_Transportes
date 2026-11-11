<?php
// Execute este arquivo UMA VEZ no navegador depois de importar database.sql.
// Depois, apague setup_admin.php por segurança.
require_once 'config.php';
$username = 'admin';
$password = password_hash('admin123', PASSWORD_DEFAULT);
$stmt = $pdo->prepare('SELECT id FROM usuarios WHERE username = ?');
$stmt->execute([$username]);
if ($stmt->fetch()) {
    echo 'O usuário admin já existe. Apague este arquivo setup_admin.php.';
} else {
    $insert = $pdo->prepare('INSERT INTO usuarios (username, password) VALUES (?, ?)');
    $insert->execute([$username, $password]);
    echo 'Usuário criado! Login: admin | Senha inicial: admin123. Apague setup_admin.php e altere a senha depois.';
}
