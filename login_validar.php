<?php
session_start();
require 'includes/conexao.php';
require 'includes/funcoes.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: login.php');
    exit;
}

$email = sanitizar($_POST['email'] ?? '');
$senha = $_POST['senha'] ?? '';

if (empty($email) || empty($senha)) {
    header('Location: login.php?erro=Preencha+todos+os+campos');
    exit;
}

$stmt = $pdo->prepare("SELECT id, nome, senha FROM usuarios WHERE email = ?");
$stmt->execute([$email]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario || !password_verify($senha, $usuario['senha'])) {
    header('Location: login.php?erro=Email+ou+senha+inválidos');
    exit;
}

$_SESSION['usuario_id']   = $usuario['id'];
$_SESSION['usuario_nome'] = $usuario['nome'];

header('Location: principal.php');
exit;
