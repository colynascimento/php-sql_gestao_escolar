<?php
ini_set('display_errors', 0);
error_reporting(0);
include('../conexao/conexao.php');

header('Content-Type: application/json');

$alunos = [];

if ($conn) {
    $result = $conn->query("SELECT cpf, nome, data_nascimento, num_turma FROM alunos");
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $alunos[] = $row;
        }
    }
}

echo json_encode($alunos);
