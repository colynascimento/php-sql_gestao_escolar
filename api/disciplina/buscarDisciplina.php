<?php
// ================================ Conexão com o banco ================================
include('../../conexao/conexao.php');  // Inclui a conexão com o banco de dados
header('Content-Type: application/json'); // Define que a resposta será JSON

// ================================ Captura o CPF enviado via GET ================================
$cod_disc = $_GET['cod_disc'] ?? ''; // Se não vier CPF, assume string vazia

// ================================ Validação ================================
if ($cod_disc === '') {
    // Retorna um JSON indicando erro se CPF não for informado
    echo json_encode(['erro' => 'codigo da disciplina não informado']);
    exit; // Interrompe a execução
}

// ================================ Consulta no banco ================================
$sql = "SELECT cod_disc, nome_disciplina, carga_horaria FROM disciplinas WHERE cod_disc = ?";
$stmt = $conn->prepare($sql); // Prepara a query para evitar SQL Injection
$stmt->bind_param('s', $cod_disc); // 's' indica que o parâmetro é string
$stmt->execute();              // Executa a query

$result = $stmt->get_result(); // Obtém o resultado da execução

// ================================ Verifica se encontrou algum aluno ================================
if ($result->num_rows > 0) {
    $disciplina = $result->fetch_assoc(); // Pega o primeiro (único) registro
    echo json_encode($disciplina);        // Retorna os dados do aluno em JSON
} else {
    // Caso não encontre, retorna erro em JSON
    echo json_encode(['erro' => 'disciplina não encontrado']);
}

// ================================ Finaliza ================================
$stmt->close(); // Fecha o statement
$conn->close(); // Fecha a conexão com o banco
?>
