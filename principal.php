<?php
require 'includes/funcoes.php';
verificar_sessao();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Principal - Kayo Sistemas</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="container">

    <?php include 'includes/cabecalho.html'; ?>
    <?php include 'includes/menu.php'; ?>

    <main class="main-content">
        <div class="welcome-box">
            <h2>Bem-vindo, <?= sanitizar($_SESSION['usuario_nome']) ?>!</h2>
            <p>Você está logado no sistema com sucesso.</p>
            <div class="info">
                <p>Kayo Sistemas - Uninassau</p>
            </div>
        </div>
    </main>

    <?php include 'includes/rodape.html'; ?>
</div>
</body>
</html>
