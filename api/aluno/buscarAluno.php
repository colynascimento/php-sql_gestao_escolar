<?php
// Conecta ao banco
include('../../conexao/conexao.php');  // ajuste o caminho conforme sua estrutura

header('Content-Type: application/json');

// Verifica se o CPF foi passado via GET
$cpf = $_GET['cpf'] ?? '';

if ($cpf === '') {
    echo json_encode(['erro' => 'CPF não informado']);
    exit;
}

// Prepara e executa a query para buscar o aluno
$sql = "SELECT cpf, nome, data_nasc, num_turma FROM alunos WHERE cpf = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $cpf);
$stmt->execute();

$result = $stmt->get_result();

// Verifica se encontrou algum aluno
if ($result->num_rows > 0) {
    $aluno = $result->fetch_assoc(); // pega o primeiro (e único) registro como objeto
    echo json_encode($aluno);        // retorna como objeto JSON
} else {
    echo json_encode(['erro' => 'Aluno não encontrado']);
}

$stmt->close();
$conn->close();
?>
