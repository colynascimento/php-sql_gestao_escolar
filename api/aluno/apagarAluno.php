<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
include('../../conexao/conexao.php');

header('Content-Type: text/plain');

if (!$conn) {
    die("Erro: Conexão com o banco não foi estabelecida!");
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cpf = $_POST['cpf'] ?? '';

    if (!$cpf) {
        echo "Erro: CPF não informado.";
        exit;
    }

    $stmt = $conn->prepare("DELETE FROM alunos WHERE cpf = ?");
    $stmt->bind_param("s", $cpf);

    if ($stmt->execute()) {
        echo "Aluno apagado com sucesso!";
    } else {
        echo "Erro ao apagar aluno: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}