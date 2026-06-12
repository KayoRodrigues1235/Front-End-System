<?php
require 'includes/funcoes.php';
verificar_sessao();
require 'includes/conexao.php';

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome  = sanitizar($_POST['nome']  ?? '');
    $email = sanitizar($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';

    if (empty($nome) || empty($email) || empty($senha)) {
        $erro = 'Preencha todos os campos.';
    } elseif (strlen($senha) < 6) {
        $erro = 'A senha deve ter no mínimo 6 caracteres.';
    } else {
        $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);

        if ($stmt->fetch()) {
            $erro = 'Este e-mail já está cadastrado.';
        } else {
            $hash = password_hash($senha, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
            $stmt->execute([$nome, $email, $hash]);
            header('Location: usuario_listar.php?msg=Usuário+cadastrado+com+sucesso');
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo Usuário - Kayo Sistemas</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="container">

    <?php include 'includes/cabecalho.html'; ?>
    <?php include 'includes/menu.php'; ?>

    <main class="main-content">
        <div class="form-container">
            <h2>Novo Usuário</h2>
            <p>Preencha os dados para cadastrar um novo usuário.</p>

            <?php if ($erro): ?>
                <div class="alert alert-danger"><?= $erro ?></div>
            <?php endif; ?>

            <form method="POST">
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome" required placeholder="Nome completo"
                           value="<?= sanitizar($_POST['nome'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label for="email">E-mail:</label>
                    <input type="email" id="email" name="email" required placeholder="email@exemplo.com"
                           value="<?= sanitizar($_POST['email'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label for="senha">Senha:</label>
                    <input type="password" id="senha" name="senha" required minlength="6"
                           placeholder="Mínimo 6 caracteres">
                </div>
                <div class="form-actions">
                    <a href="usuario_listar.php" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn">Cadastrar</button>
                </div>
            </form>
        </div>
    </main>

    <?php include 'includes/rodape.html'; ?>
</div>
</body>
</html>
