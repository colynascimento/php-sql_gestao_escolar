<?php
include('../../conexao/conexao.php'); // Inclui a conexão com o banco de dados

header('Content-Type: text/plain'); // Define que a resposta será texto puro

// ================================ Verifica se a requisição é POST ================================
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Captura o cod_disc enviado pelo formulário
    $cod_disc = $_POST['cod_disc'] ?? '';

    // ================================ Validação básica ================================
    // Verifica se o cod_disc foi informado
    if (!$cod_disc) {
        echo "Erro: cod_disc não informado.";
        exit; // Interrompe a execução caso cod_disc esteja vazio
    }

    // ================================ Deleta aluno ================================
    // Prepara a query para deletar o aluno com o cod_disc informado
    $stmt = $conn->prepare("DELETE FROM disciplinas WHERE cod_disc = ?");
    $stmt->bind_param("s", $cod_disc); // 's' indica que o parâmetro é string

    // Executa a query e verifica se deu certo
    if ($stmt->execute()) {
        echo "Disciplina apagad=a com sucesso!";
    } else {
        echo "Erro ao apagar disciplina: " . $stmt->error;
    }

    // Fecha o statement e a conexão com o banco
    $stmt->close();
    $conn->close();
}
