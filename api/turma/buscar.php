<?php

include('../../conexao/conexao.php');
header('Content-Type: application/json'); 

$num_turma = $_GET['num_turma'] ?? ''; // Se não vier CPF, assume string vazia

// Validação
if ($num_turma === '') {
    echo json_encode(['erro' => 'Número da turma não informado']);
    exit;
}

$stmt = $conn->prepare($sql); // Prepara a query para evitar SQL Injection
$stmt->bind_param('i', $num_turma); // 's' indica que o parâmetro é string
$stmt->execute();

$result = $stmt->get_result(); // Obtém o resultado da execução

if ($result->num_rows > 0) {
    $turma = $result->fetch_assoc();
    echo json_encode($turma);        // Retorna os dados do aluno em JSON
} else {
    // Caso não encontre, retorna erro em JSON
    echo json_encode(['erro' => 'Turma não encontrada']);
}

$stmt->close();
$conn->close();
?>
