<?php
require 'includes/funcoes.php';
if (session_status() === PHP_SESSION_NONE) session_start();

if (!empty($_SESSION['usuario_id'])) {
    header('Location: principal.php');
    exit;
}

$erro = sanitizar($_GET['erro'] ?? '');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Kayo Sistemas</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="container">

    <?php include 'includes/cabecalho.html'; ?>

    <main class="main-content">
        <div class="login-container">
            <div class="login-box">
                <h2>Login</h2>
                <p>Digite suas credenciais para continuar</p>

                <?php if ($erro): ?>
                    <div class="alert alert-danger"><?= $erro ?></div>
                <?php endif; ?>

                <form method="POST" action="login_validar.php">
                    <div class="form-group">
                        <label for="email">E-mail:</label>
                        <input type="email" id="email" name="email" required
                               placeholder="seu.email@pessoal.com.br">
                    </div>
                    <div class="form-group">
                        <label for="senha">Senha:</label>
                        <input type="password" id="senha" name="senha" required
                               placeholder="Digite sua senha">
                    </div>
                    <button type="submit" class="btn btn-login">Entrar</button>
                </form>
            </div>

            <div class="login-info">
                <h3>Importante</h3>
                <ul>
                    <li>Use o email cadastrado</li>
                    <li>A senha deve ter no mínimo 6 caracteres</li>
                    <li>Mantenha suas credenciais em segurança</li>
                    <li>As credenciais são fornecidas pessoalmente</li>
                </ul>
            </div>
        </div>
    </main>

    <?php include 'includes/rodape.html'; ?>
</div>
</body>
</html>
