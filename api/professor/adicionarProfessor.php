<?php
include('../../conexao/conexao.php'); // Inclui o arquivo de conexão com o banco de dados

header('Content-Type: text/plain'); // Define o tipo de conteúdo da resposta como texto puro

// ================================ Verifica se a requisição é POST ================================
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Captura os dados enviados pelo formulário via POST
    $cpf = $_POST['cpf'] ?? '';
    $nome = $_POST['nome'] ?? '';
    $data_nasc = $_POST['data_nasc'] ?? '';
    $titulo = $_POST['titulo'] ?? '';
    // ================================ Verifica duplicidade de CPF ================================
    // Prepara a query para verificar se o CPF já existe
    $check = $conn->prepare("SELECT cpf FROM professores WHERE cpf = ?");
    $check->bind_param("s", $cpf); // 's' indica que o parâmetro é string
    $check->execute();
    $check->store_result(); // Armazena o resultado da consulta

    if ($check->num_rows > 0) { // Se já existe um aluno com o mesmo CPF
        echo "Erro: Já existe um professor com este CPF.";
        exit; // Interrompe a execução
    }

    // ================================ Insere professor no banco ================================
    // Prepara a query de inserção
    $stmt = $conn->prepare("INSERT INTO professores (cpf, nome, data_nasc, titulo) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $cpf, $nome, $data_nasc, $titulo);
    // "sssi" indica: string, string, string, integer

    // Executa a inserção e verifica se funcionou
    if ($stmt->execute()) {
        echo "Professor cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar professor: " . $stmt->error;
    }

    // Fecha o statement e a conexão com o banco
    $stmt->close();
    $conn->close();
}
