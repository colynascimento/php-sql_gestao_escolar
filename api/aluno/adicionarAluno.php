<?php
include('../../conexao/conexao.php'); // Inclui o arquivo de conexão com o banco de dados

header('Content-Type: text/plain'); // Define o tipo de conteúdo da resposta como texto puro

// ================================ Verifica se a requisição é POST ================================
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Captura os dados enviados pelo formulário via POST
    $cpf = $_POST['cpf'] ?? '';
    $nome = $_POST['nome'] ?? '';
    $data_nasc = $_POST['data_nasc'] ?? '';
    $num_turma = $_POST['num_turma'] ?? '';

    // ================================ Validação básica ================================
    // Verifica se algum campo obrigatório está vazio
    if (!$cpf || !$nome || !$data_nasc || !$num_turma) {
        echo "<script>console.log('PHP: $cpf, $nome ,$data_nasc ,$num_turma');</script>";
        echo "Erro: Todos os campos são obrigatórios.";
        exit; // Interrompe a execução do script
    }

    // ================================ Verifica duplicidade de CPF ================================
    // Prepara a query para verificar se o CPF já existe
    $check = $conn->prepare("SELECT cpf FROM alunos WHERE cpf = ?");
    $check->bind_param("s", $cpf); // 's' indica que o parâmetro é string
    $check->execute();
    $check->store_result(); // Armazena o resultado da consulta

    if ($check->num_rows > 0) { // Se já existe um aluno com o mesmo CPF
        echo "Erro: Já existe um aluno com este CPF.";
        exit; // Interrompe a execução
    }

    // ================================ Insere aluno no banco ================================
    // Prepara a query de inserção
    $stmt = $conn->prepare("INSERT INTO alunos (cpf, nome, data_nasc, num_turma) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $cpf, $nome, $data_nasc, $num_turma);
    // "sssi" indica: string, string, string, integer

    // Executa a inserção e verifica se funcionou
    if ($stmt->execute()) {
        echo "Aluno cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar aluno: " . $stmt->error;
    }

    // Fecha o statement e a conexão com o banco
    $stmt->close();
    $conn->close();
}
