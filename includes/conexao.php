<?php
/*
    SQL para criar a tabela de usuários:

    CREATE DATABASE IF NOT EXISTS kayo_sistema CHARACTER SET utf8 COLLATE utf8_general_ci;
    USE kayo_sistema;

    CREATE TABLE IF NOT EXISTS usuarios (
        id       INT AUTO_INCREMENT PRIMARY KEY,
        nome     VARCHAR(100)  NOT NULL,
        email    VARCHAR(150)  NOT NULL UNIQUE,
        senha    VARCHAR(255)  NOT NULL
    );

    -- Inserir usuário de teste (senha: 123456):
    INSERT INTO usuarios (nome, email, senha)
    VALUES ('Admin', 'admin@sistema.com', '$2y$10$samplehashhere');
    -- Use password_hash('123456', PASSWORD_DEFAULT) para gerar o hash correto.
*/

$host    = 'savir099bd.vpshost12372.mysql.dbaas.com.br';
$banco   = 'savir099bd';
$usuario = 'savir099bd';
$senha   = 'savir099#BD';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$banco;charset=utf8", $usuario, $senha);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Erro de conexão com o banco: ' . $e->getMessage());
}
