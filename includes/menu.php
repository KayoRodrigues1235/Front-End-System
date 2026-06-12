<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<nav class="menu">
    <span>Olá, <?= sanitizar($_SESSION['usuario_nome'] ?? '') ?></span>
    <div>
        <a href="principal.php">Início</a>
        <a href="usuario_listar.php">Usuários</a>
        <a href="logout.php">Sair</a>
    </div>
</nav>
