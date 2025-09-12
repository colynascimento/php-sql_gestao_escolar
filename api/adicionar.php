<?php
include('../conexao/conexao.php');

function inserirRegistro($conn, $tabela, $dados) {
    // Supondo que "cpf" seja a chave primária
    $cpf = $conn->real_escape_string($dados['cpf']);

    // Verifica se já existe
    $check = $conn->query("SELECT 1 FROM $tabela WHERE cpf = '$cpf'");
    if ($check && $check->num_rows > 0) {
       return "<span style='color:red;'>Erro: já existe um registro com este CPF ($cpf).</span>";

    }

    // Monta campos e valores
    $campos = [];
    $valores = [];

    foreach ($dados as $campo => $valor) {
        $campos[] = $campo;
        if (is_null($valor) || $valor === '') {
            $valores[] = "NULL"; // sem aspas
        } else {
            $valores[] = "'" . $conn->real_escape_string($valor) . "'";
        }
    }

    $sql = "INSERT INTO $tabela (" . implode(", ", $campos) . ") VALUES (" . implode(", ", $valores) . ")";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return "Erro SQL: " . $conn->error . " | Query: " . $sql;
    }
}

?>

