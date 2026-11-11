<?php
session_start();
require_once 'config.php';
if (!isset($_SESSION['usuario_id'])) { header('Location: login.php'); exit; }
$mensagem = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $telefone = trim($_POST['telefone'] ?? '');
    $cargo = trim($_POST['cargo'] ?? '');
    if ($nome === '' || !filter_var($email, FILTER_VALIDATE_EMAIL) || $cargo === '') {
        $mensagem = 'Confira os campos obrigatórios e informe um e-mail válido.';
    } elseif (!isset($_FILES['curriculo']) || $_FILES['curriculo']['error'] !== UPLOAD_ERR_OK) {
        $mensagem = 'Anexe seu currículo em PDF.';
    } else {
        $arquivo = $_FILES['curriculo'];
        $ext = strtolower(pathinfo($arquivo['name'], PATHINFO_EXTENSION));
        if ($ext !== 'pdf' || $arquivo['size'] > 3 * 1024 * 1024) {
            $mensagem = 'Envie somente arquivo PDF de até 3 MB.';
        } else {
            $pasta = __DIR__ . '/uploads';
            if (!is_dir($pasta)) { mkdir($pasta, 0750, true); }
            $nomeSeguro = bin2hex(random_bytes(12)) . '.pdf';
            if (move_uploaded_file($arquivo['tmp_name'], $pasta . '/' . $nomeSeguro)) {
                $stmt = $pdo->prepare('INSERT INTO curriculos (nome, email, telefone, cargo, arquivo) VALUES (?, ?, ?, ?, ?)');
                $stmt->execute([$nome, $email, $telefone, $cargo, $nomeSeguro]);
                $mensagem = 'Currículo enviado com sucesso!';
            } else {
                $mensagem = 'Não foi possível salvar o arquivo. Verifique a permissão da pasta uploads.';
            }
        }
    }
}
?>
<!DOCTYPE html><html lang="pt-br"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>Trabalhe Conosco | Zeta Transporte</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"><link rel="stylesheet" href="assets/style.css"></head>
<body><nav class="navbar navbar-dark zeta-nav"><div class="container"><a class="navbar-brand fw-bold" href="dashboard.php">← ZETA TRANSPORTE</a></div></nav>
<main class="container py-5 form-wrap"><span class="eyebrow">OPORTUNIDADES</span><h1>Trabalhe conosco</h1><p class="muted">Preencha seus dados e envie seu currículo em PDF.</p>
<div class="checkout-card mt-4">
<?php if ($mensagem): ?><div class="alert alert-info"><?= htmlspecialchars($mensagem) ?></div><?php endif; ?>
<form method="POST" enctype="multipart/form-data">
<label class="form-label">Nome completo *</label><input class="form-control mb-3" name="nome" required>
<label class="form-label">E-mail *</label><input class="form-control mb-3" name="email" type="email" required>
<label class="form-label">Telefone</label><input class="form-control mb-3" name="telefone">
<label class="form-label">Cargo pretendido *</label><input class="form-control mb-3" name="cargo" required>
<label class="form-label">Currículo (PDF, até 3 MB) *</label><input class="form-control mb-4" type="file" name="curriculo" accept="application/pdf" required>
<button class="btn btn-zeta w-100">Enviar currículo</button>
</form></div></main></body></html>
