<?php
    require_once __DIR__ . "/../conexao/conexao.php";
    include "../api/exibir.php"

    listarTabela($conn, "alunos");

    $conn->close();
?>