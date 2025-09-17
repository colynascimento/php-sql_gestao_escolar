<?php
    require 'usuarios.php';
    include 'alerta.php';

    $email = $_POST['usuario-email'] ?? '';
    $senha = $_POST['usuario-senha'] ?? '';

    $login_valido = false;

    foreach($usuarios as $u) {
        if ($u['email'] === $email && $u['senha'] === $senha) {
            $login_valido = true;
        }
    }

    if ($login_valido) {
        header("Location: pagina-inicial.php");
        exit();
    } else {
        alert('Usuário os senha incorretos!', '../public/index.php');
        exit();
    }
?>