<?php
include('../conexao/conexao.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    $num_turma = $_POST['num_turma'] ?? '';


    if (!$num_turma) {
        echo "Erro: Número da turma não informado.";
        exit; // Interrompe a execução caso número da turma esteja vazio
    }


  // Prepara turma a ser deletada
    $stmt = $conn->prepare("DELETE FROM turmas WHERE num_turma = ?");
    $stmt->bind_param("i", $num_turma); // 's' indica que o parâmetro é string


    // Executa a query
    if ($stmt->execute()) {
        echo "Turma apagada com sucesso!";
    } else {
        echo "Erro ao apagar turma: " . $stmt->error;
    }


    // Fecha o statement e a conexão com o banco
    $stmt->close();
    $conn->close();
}
