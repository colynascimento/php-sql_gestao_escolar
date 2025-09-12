<?php
include('../conexao/conexao.php');

function apagarRegistro($conn,$nomeTabela,$coluna ,$PK) {

    $conn->query("DELETE FROM $tabela WHERE $coluna=$pk");
    $conn->close();

    header("Location: index.php");
}
?>

