<?php
require 'includes/funcoes.php';
verificar_sessao();
require 'includes/conexao.php';

$msg  = sanitizar($_GET['msg']  ?? '');
$erro = sanitizar($_GET['erro'] ?? '');

$stmt    = $pdo->query("SELECT id, nome, email FROM usuarios ORDER BY nome");
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuários - Kayo Sistemas</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="container">

    <?php include 'includes/cabecalho.html'; ?>
    <?php include 'includes/menu.php'; ?>

    <main class="main-content" style="align-items: stretch;">
        <div class="table-container">

            <?php if ($msg): ?>
                <div class="alert alert-success"><?= $msg ?></div>
            <?php endif; ?>
            <?php if ($erro): ?>
                <div class="alert alert-danger"><?= $erro ?></div>
            <?php endif; ?>

            <div class="page-actions">
                <h2>Usuários</h2>
                <a href="cadastro_incluir.php" class="btn">+ Novo Usuário</a>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($usuarios)): ?>
                        <tr>
                            <td colspan="4" style="text-align:center; color:#7f8c8d;">
                                Nenhum usuário cadastrado.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($usuarios as $u): ?>
                        <tr>
                            <td><?= $u['id'] ?></td>
                            <td><?= sanitizar($u['nome']) ?></td>
                            <td><?= sanitizar($u['email']) ?></td>
                            <td>
                                <a href="cadastro_excluir.php?id=<?= $u['id'] ?>" class="btn btn-danger">Excluir</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>

        </div>
    </main>

    <?php include 'includes/rodape.html'; ?>
</div>
</body>
</html>
