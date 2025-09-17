<?php
include('../../conexao/conexao.php');
header('Content-Type: application/json');

$dados = json_decode(file_get_contents('php://input'), true);

if (!$dados) { echo json_encode(['erro' => 'Dados inválidos']); exit; }

$sql = "UPDATE alunos SET nome = ?, data_nasc = ?, num_turma = ? WHERE cpf = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ssis', $dados['nome'], $dados['data_nasc'], $dados['num_turma'], $dados['cpf']);

if ($stmt->execute()) {
    echo json_encode(['sucesso' => true]);
} else {
    echo json_encode(['erro' => $stmt->error]);
}

$stmt->close();
$conn->close();
?>
