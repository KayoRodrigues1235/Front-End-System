<?php
require 'includes/funcoes.php';
verificar_sessao();
require 'includes/conexao.php';

$id = (int)($_GET['id'] ?? 0);

if (!$id) {
    header('Location: usuario_listar.php');
    exit;
}

if ($id === (int)$_SESSION['usuario_id']) {
    header('Location: usuario_listar.php?erro=Você+não+pode+excluir+seu+próprio+usuário');
    exit;
}

$stmt = $pdo->prepare("DELETE FROM usuarios WHERE id = ?");
$stmt->execute([$id]);

header('Location: usuario_listar.php?msg=Usuário+excluído+com+sucesso');
exit;
