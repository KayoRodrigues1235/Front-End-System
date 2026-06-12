<?php
require 'includes/funcoes.php';
verificar_sessao();
require 'includes/conexao.php';

$id = (int)($_GET['id'] ?? 0);

if (!$id) {
    header('Location: usuario_listar.php');
    exit;
}

$stmt = $pdo->prepare("SELECT id, nome, email FROM usuarios WHERE id = ?");
$stmt->execute([$id]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    header('Location: usuario_listar.php?erro=Usuário+não+encontrado');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Usuário - Kayo Sistemas</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="container">

    <?php include 'includes/cabecalho.html'; ?>
    <?php include 'includes/menu.php'; ?>

    <main class="main-content">
        <div class="form-container" style="max-width: 500px; text-align: center;">
            <h2>Excluir Usuário</h2>
            <p>Tem certeza que deseja excluir o usuário abaixo?</p>

            <div class="confirm-box">
                <p><strong>Nome:</strong> <?= sanitizar($usuario['nome']) ?></p>
                <p><strong>E-mail:</strong> <?= sanitizar($usuario['email']) ?></p>
            </div>

            <div class="form-actions" style="justify-content: center; margin-top: 25px;">
                <a href="usuario_listar.php" class="btn btn-secondary">Cancelar</a>
                <a href="usuario_excluir.php?id=<?= $usuario['id'] ?>" class="btn btn-danger">Confirmar Exclusão</a>
            </div>
        </div>
    </main>

    <?php include 'includes/rodape.html'; ?>
</div>
</body>
</html>
