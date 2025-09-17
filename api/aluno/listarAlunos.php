<?php
// Exibe erros para depuração 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('../../conexao/conexao.php'); 
header('Content-Type: application/json');

$alunos = [];

if ($conn) {
    $result = $conn->query("SELECT cpf, nome, data_nasc, num_turma FROM alunos");
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $alunos[] = $row;
        }
    }
}

echo json_encode($alunos);
