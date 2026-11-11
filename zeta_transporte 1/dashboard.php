<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}
$produtos = [
    ['nome'=>'Entrega Expressa','linha'=>'Linha 01 · Entregas','preco'=>89.90,'descricao'=>'Coleta e entrega rápida para encomendas.','imagem'=>'https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&w=900&q=80'],
    ['nome'=>'Transporte Urbano','linha'=>'Linha 01 · Entregas','preco'=>129.90,'descricao'=>'Transporte de mercadorias dentro da cidade.','imagem'=>'https://images.unsplash.com/photo-1601584115197-04ecc0da31d7?auto=format&fit=crop&w=900&q=80'],
    ['nome'=>'Carga Regional','linha'=>'Linha 02 · Cargas','preco'=>249.90,'descricao'=>'Solução para cargas entre cidades próximas.','imagem'=>'https://images.unsplash.com/photo-1519003722824-194d4455a60c?auto=format&fit=crop&w=900&q=80'],
    ['nome'=>'Armazenagem','linha'=>'Linha 03 · Armazenagem','preco'=>179.90,'descricao'=>'Organização e armazenamento de produtos.','imagem'=>'https://images.unsplash.com/photo-1553413077-190dd305871c?auto=format&fit=crop&w=900&q=80'],
    ['nome'=>'Logística Completa','linha'=>'Linha 04 · Soluções','preco'=>399.90,'descricao'=>'Planejamento de transporte e distribuição.','imagem'=>'https://images.unsplash.com/photo-1566576912321-d58c7a7a7a1a?auto=format&fit=crop&w=900&q=80'],
    ['nome'=>'Coleta Programada','linha'=>'Linha 04 · Soluções','preco'=>99.90,'descricao'=>'Agendamento de coleta conforme sua necessidade.','imagem'=>'https://images.unsplash.com/photo-1580674285054-bed31e145f59?auto=format&fit=crop&w=900&q=80']
];
function dinheiro($valor) { return 'R$ ' . number_format($valor, 2, ',', '.'); }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Painel | Zeta Transporte</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark zeta-nav">
    <div class="container">
        <a class="navbar-brand fw-bold" href="dashboard.php"><span class="brand-mini">ZT</span> ZETA TRANSPORTE</a>
        <div class="d-flex align-items-center gap-3">
            <span class="text-white small d-none d-sm-inline">Olá, <?= htmlspecialchars($_SESSION['username']) ?></span>
            <a class="btn btn-outline-light btn-sm" href="curriculos.php">Trabalhe conosco</a>
            <a class="btn btn-light btn-sm" href="logout.php">Sair</a>
        </div>
    </div>
</nav>

<header class="hero">
    <div class="container hero-content">
        <span class="hero-tag">LOGÍSTICA • TRANSPORTE • CONFIANÇA</span>
        <h1>Movemos sua empresa<br><span>para frente.</span></h1>
        <p>Soluções de transporte e logística para conectar pessoas, produtos e oportunidades.</p>
        <a href="#servicos" class="btn btn-zeta">Conheça nossos serviços</a>
    </div>
</header>

<main class="container py-5" id="servicos">
    <div class="section-heading">
        <div><span class="eyebrow">NOSSAS SOLUÇÕES</span><h2>Serviços em destaque</h2></div>
        <p>Escolha a opção que combina com sua necessidade.</p>
    </div>

    <div class="row g-4">
    <?php foreach ($produtos as $produto): ?>
        <div class="col-md-6 col-lg-4">
            <article class="product-card h-100">
                <img src="<?= htmlspecialchars($produto['imagem']) ?>" alt="<?= htmlspecialchars($produto['nome']) ?>">
                <div class="product-info">
                    <span class="product-line"><?= htmlspecialchars($produto['linha']) ?></span>
                    <h3><?= htmlspecialchars($produto['nome']) ?></h3>
                    <p><?= htmlspecialchars($produto['descricao']) ?></p>
                    <div class="d-flex justify-content-between align-items-center mt-auto">
                        <strong class="price"><?= dinheiro($produto['preco']) ?></strong>
                        <a class="btn btn-zeta btn-sm" href="compra.php?produto=<?= urlencode($produto['nome']) ?>&preco=<?= $produto['preco'] ?>">Comprar</a>
                    </div>
                </div>
            </article>
        </div>
    <?php endforeach; ?>
    </div>

    <section class="career-banner mt-5">
        <div><span class="eyebrow">FAÇA PARTE DA EQUIPE</span><h2>Seu próximo caminho pode começar aqui.</h2><p>Envie seu currículo para a equipe da Zeta Transporte.</p></div>
        <a href="curriculos.php" class="btn btn-light">Enviar currículo</a>
    </section>
</main>

<footer class="footer">
    <div class="container">
        <strong>ZETA TRANSPORTE</strong>
        <p>Avenida dos Gansos Pretos, 10040 — Nova Esperança, Belém — Pará — Brasil</p>
        <p>Telefone: 31 3201-1527 · CNPJ: 45.345.496/0001-05</p>
        <small>© <?= date('Y') ?> Zeta Transporte. Projeto acadêmico.</small>
    </div>
</footer>
</body>
</html>
