<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('../../conexao/conexao.php');


header('Content-Type: text/plain');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cpf = $_POST['cpf'] ?? '';
    $nome = $_POST['nome'] ?? '';
    $data_nasc = $_POST['data_nasc'] ?? '';
    $num_turma = $_POST['num_turma'] ?? '';

    if (!$cpf || !$nome || !$data_nasc || !$num_turma) {
        echo "Erro: Todos os campos são obrigatórios.";
        exit;
    }

    $check = $conn->prepare("SELECT cpf FROM alunos WHERE cpf = ?");
    $check->bind_param("s", $cpf);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        echo "Erro: Já existe um aluno com este CPF.";
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO alunos (cpf, nome, data_nasc, num_turma) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $cpf, $nome, $data_nasc, $num_turma);

    if ($stmt->execute()) {
        echo "Aluno cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar aluno: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
}