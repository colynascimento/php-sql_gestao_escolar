<?php
include('../conexao/conexao.php');

function inserirRegistro($conn, $tabela, $coluna, $PK, $dados) {

    // Verifica se já existe
    $check = $conn->query("SELECT 1 FROM $tabela WHERE $coluna = $PK");

    if ($check && $check->num_rows > 0) {
        return "<span style='color:red;'>Erro: já existe um registro com este valor ($PK).</span>";
    }

    // Monta campos e valores
    $campos = implode(", ", array_keys($dados));
    $valores = implode("', '", array_map([$conn, 'real_escape_string'], array_values($dados)));

    $sql = "INSERT INTO $tabela ($campos) VALUES ('$valores')";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return "Erro SQL: " . $conn->error;
    }
}
?>