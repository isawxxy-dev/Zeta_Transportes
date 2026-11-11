<?php
session_start();
require_once 'config.php';

if (isset($_SESSION['usuario_id'])) {
    header('Location: dashboard.php');
    exit;
}

$erro = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $password === '') {
        $erro = 'Preencha o usuário e a senha.';
    } else {
        $stmt = $pdo->prepare('SELECT id, username, password FROM usuarios WHERE username = ?');
        $stmt->execute([$username]);
        $usuario = $stmt->fetch();

        if ($usuario && password_verify($password, $usuario['password'])) {
            session_regenerate_id(true);
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['username'] = $usuario['username'];
            header('Location: dashboard.php');
            exit;
        }
        $erro = 'Usuário ou senha inválidos.';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Zeta Transporte</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/style.css">
</head>
<body class="login-page">
<main class="login-card">
    <div class="brand-mark">ZT</div>
    <p class="eyebrow">ZETA TRANSPORTE</p>
    <h1>Acesse sua conta</h1>
    <p class="muted">Entre para acessar o painel da empresa.</p>

    <?php if ($erro): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($erro) ?></div>
    <?php endif; ?>

    <form method="POST" action="login.php">
        <label class="form-label" for="username">Usuário</label>
        <input class="form-control mb-3" id="username" name="username" type="text" required autocomplete="username">

        <label class="form-label" for="password">Senha</label>
        <input class="form-control mb-4" id="password" name="password" type="password" required autocomplete="current-password">

        <button class="btn btn-zeta w-100" type="submit">Entrar no sistema</button>
    </form>
    <small class="login-foot">Logística com confiança e responsabilidade.</small>
</main>
</body>
</html>
