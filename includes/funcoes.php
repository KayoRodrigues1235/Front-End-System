<?php
function verificar_sessao() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (empty($_SESSION['usuario_id'])) {
        header('Location: login.php');
        exit;
    }
}

function sanitizar($valor) {
    return htmlspecialchars(trim($valor), ENT_QUOTES, 'UTF-8');
}
