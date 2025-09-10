<?php

header("Content-Type: application/json");
include("../conexao/conexao.php");

function adicionarTabela($conexao, $nomeTabela,$colunas,$valores) {
    $dados = json_decode(file_get_contents("php://input"), true);

    $titulo = $conn->real_escape_string($dados[$colunas]);
    
    // Monta o comando SQL para inserir o novo titulo na tabela tarefas.
    $sql = "INSERT INTO  $nomeTabela ($colunas) VALUES ($valores)";
    // Executa o comando SQL no banco de dados.
    $conn->query($sql);
    
    echo json_encode([ "titulo" => $titulo, "concluida" => 0]);
}
?>