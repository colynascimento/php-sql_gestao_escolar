<?php
include('../../conexao/conexao.php'); // Inclui a conexão com o banco de dados

header('Content-Type: text/plain'); // Define que a resposta será texto puro

// ================================ Verifica se a requisição é POST ================================
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Captura o CPF enviado pelo formulário
    $cpf = $_POST['cpf'] ?? '';

    // ================================ Validação básica ================================
    // Verifica se o CPF foi informado
    if (!$cpf) {
        echo "Erro: CPF não informado.";
        exit; // Interrompe a execução caso CPF esteja vazio
    }

    // ================================ Deleta aluno ================================
    // Prepara a query para deletar o aluno com o CPF informado
    $stmt = $conn->prepare("DELETE FROM professores WHERE cpf = ?");
    $stmt->bind_param("s", $cpf); // 's' indica que o parâmetro é string

    // Executa a query e verifica se deu certo
    if ($stmt->execute()) {
        echo "Professor apagado com sucesso!";
    } else {
        echo "Erro ao apagar professor: " . $stmt->error;
    }

    // Fecha o statement e a conexão com o banco
    $stmt->close();
    $conn->close();
}
