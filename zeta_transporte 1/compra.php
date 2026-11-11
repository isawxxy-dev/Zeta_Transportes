<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}
$catalogo = [
    'Entrega Expressa'=>89.90, 'Transporte Urbano'=>129.90,
    'Carga Regional'=>249.90, 'Armazenagem'=>179.90,
    'Logística Completa'=>399.90, 'Coleta Programada'=>99.90
];
$nome = $_GET['produto'] ?? '';
$preco = isset($catalogo[$nome]) ? $catalogo[$nome] : 0;
if ($preco <= 0) { header('Location: dashboard.php'); exit; }
$promocao = $preco * 0.90;
function dinheiro($valor) { return 'R$ ' . number_format($valor, 2, ',', '.'); }
$mensagem = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $metodo = $_POST['metodo'] ?? '';
    if (in_array($metodo, ['pix','cartao','mercadopago','paypal','santander'], true)) {
        $mensagem = 'Demonstração: forma de pagamento selecionada. Para receber pagamentos reais, é necessário configurar a conta e a integração oficial do provedor.';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>Compra | Zeta Transporte</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"><link rel="stylesheet" href="assets/style.css">
</head>
<body>
<nav class="navbar navbar-dark zeta-nav"><div class="container"><a class="navbar-brand fw-bold" href="dashboard.php">← ZETA TRANSPORTE</a></div></nav>
<main class="container py-5 checkout-wrap">
    <span class="eyebrow">FINALIZAR PEDIDO</span><h1>Resumo da compra</h1>
    <div class="checkout-card mt-4">
        <h2><?= htmlspecialchars($nome) ?></h2>
        <p class="muted">Serviço selecionado</p>
        <div class="price-line"><span>Preço original</span><strong><?= dinheiro($preco) ?></strong></div>
        <div class="price-line"><span>Promoção de 10%</span><strong class="discount">- <?= dinheiro($preco-$promocao) ?></strong></div>
        <div class="price-line total"><span>Total promocional</span><strong><?= dinheiro($promocao) ?></strong></div>
        <hr>
        <?php if ($mensagem): ?><div class="alert alert-info"><?= htmlspecialchars($mensagem) ?></div><?php endif; ?>
        <h3 class="h5 mb-3">Escolha a forma de pagamento</h3>
        <form method="POST">
            <label class="payment-option"><input type="radio" name="metodo" value="pix" required> <span><b>PIX</b><small>À vista. Opção de PIX parcelado em até 12x depende de serviço de crédito parceiro.</small></span></label>
            <label class="payment-option"><input type="radio" name="metodo" value="cartao"> <span><b>Cartão de crédito</b><small>Até 6 parcelas sem juros, sujeito à configuração da operadora.</small></span></label>
            <label class="payment-option"><input type="radio" name="metodo" value="mercadopago"> <span><b>Mercado Pago</b><small>Integração demonstrativa; requer credenciais oficiais.</small></span></label>
            <label class="payment-option"><input type="radio" name="metodo" value="paypal"> <span><b>PayPal</b><small>Integração demonstrativa; requer credenciais oficiais.</small></span></label>
            <label class="payment-option"><input type="radio" name="metodo" value="santander"> <span><b>Banco Santander</b><small>Integração demonstrativa; requer contrato e credenciais bancárias.</small></span></label>
            <button class="btn btn-zeta w-100 mt-3" type="submit">Continuar</button>
        </form>
        <p class="security-note mt-3">Não informe dados reais de cartão nesta demonstração escolar.</p>
        <a href="dashboard.php" class="back-link">Voltar aos serviços</a>
    </div>
</main>
</body></html>
