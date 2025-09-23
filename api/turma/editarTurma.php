<?php
include('../../conexao/conexao.php'); 
header('Content-Type: application/json');

// error_reporting(0);
// ini_set('display_errors', 0);

// $dados = json_decode(file_get_contents('php://input'), true); 
$dados = $_POST;
// Lê o corpo da requisição como JSON e converte para array associativo

if (!$dados) {
    // Retorna erro caso os dados não sejam válidos
    echo json_encode(['erro' => 'Dados inválidos']);
    exit;
}

// ================================ Prepara a query de atualização ================================
$sql = "UPDATE turmas SET nome = ?, turno = ?, sala = ? WHERE num_turma = ?";
$stmt = $conn->prepare($sql); 
// Prepara a query

// Bind dos parâmetros: 'ssis' indica string, string, integer, string
$stmt->bind_param('sssi', $dados['nome'], $dados['turno'], $dados['sala'], $dados['num_turma']);

if ($stmt->execute()) {
    echo json_encode(['sucesso' => true]);
} else {
    // Retorna erro detalhado em JSON
    echo json_encode(['erro' => $stmt->error]);
}

$stmt->close(); // Fecha o statement
$conn->close(); // Fecha a conexão com o banco
?>
