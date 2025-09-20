<?php

include('../../conexao/conexao.php');
header('Content-Type: application/json');

$turmas = [];

if ($conn) { // Verifica se a conexão existe
    $result = $conn->query("SELECT num_turma, nome, turno, sala FROM turmas");
   
    if ($result) { // Se a consulta retornar resultados
        while ($row = $result->fetch_assoc()) {
            // Adiciona cada registro ao array $turmas
            $turmas[] = $row;
        }
    }
}

echo json_encode($turmas);
?>
