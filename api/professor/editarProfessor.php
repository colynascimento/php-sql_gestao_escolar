<?php
// ================================ Conexão com o banco ================================
include('../../conexao/conexao.php');  // Inclui a conexão com o banco
header('Content-Type: application/json'); // Define que a resposta será em JSON

// ================================ Captura dados enviados pelo JavaScript ================================
$dados = json_decode(file_get_contents('php://input'), true); 
// Lê o corpo da requisição como JSON e converte para array associativo

// ================================ Validação ================================
if (!$dados) {
    // Retorna erro caso os dados não sejam válidos
    echo json_encode(['erro' => 'Dados inválidos']);
    exit; // Interrompe execução
}

// ================================ Prepara a query de atualização ================================
$sql = "UPDATE professores SET nome = ?, data_nasc = ?, cod_disc = ? WHERE cpf = ?";
$stmt = $conn->prepare($sql); 
// Prepara a query para evitar SQL Injection
// Atualiza nome, data de nascimento e turma baseado no CPF

// Bind dos parâmetros: 'ssis' indica string, string, integer, string
$stmt->bind_param('ssss', $dados['nome'], $dados['data_nasc'], $dados['cod_disc'], $dados['cpf']);

// ================================ Executa e verifica ================================
if ($stmt->execute()) {
    // Retorna sucesso em JSON
    echo json_encode(['sucesso' => true]);
} else {
    // Retorna erro detalhado em JSON
    echo json_encode(['erro' => $stmt->error]);
}

// ================================ Finaliza ================================
$stmt->close(); // Fecha o statement
$conn->close(); // Fecha a conexão com o banco
?>
