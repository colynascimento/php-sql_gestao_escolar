<?php
include('../../conexao/conexao.php'); // Inclui o arquivo de conexão com o banco de dados
header('Content-Type: text/plain'); // Define o tipo de conteúdo da resposta como texto puro

// ================================ Verifica se a requisição é POST ================================
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Captura os dados enviados pelo formulário via POST
    $cod_disc = $_POST['cod_disc'] ?? '';
    $nome_disciplina = $_POST['nome_disciplina'] ?? '';
    $carga_horaria = $_POST['carga_horaria'] ?? '';

    // ================================ Validação básica ================================
    // Verifica se algum campo obrigatório está vazio
    if (!$cod_disc || !$nome_disciplina || !$carga_horaria) {
        echo "Erro: Todos os campos são obrigatórios.";
        exit; // Interrompe a execução do script
    }

    // ================================ Verifica duplicidade de CPF ================================
    // Prepara a query para verificar se o CPF já existe
    $check = $conn->prepare("SELECT cod_disc FROM disciplinas WHERE cod_disc = ?");
    $check->bind_param("s", $cod_disc); // 's' indica que o parâmetro é string
    $check->execute();
    $check->store_result(); // Armazena o resultado da consulta

    if ($check->num_rows > 0) { // Se já existe um aluno com o mesmo CPF
        echo "Erro: Já existe um disciplina com este codigo.";
        exit; // Interrompe a execução
    }

    // ================================ Insere aluno no banco ================================
    // Prepara a query de inserção
    $stmt = $conn->prepare("INSERT INTO disciplinas (cod_disc, nome_disciplina, carga_horaria) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $cod_disc, $nome_disciplina, $carga_horaria);
    // "sssi" indica: string, string, string, integer

    // Executa a inserção e verifica se funcionou
    if ($stmt->execute()) {
        echo "Disciplina cadastrada com sucesso!";
    } else {
        echo "Erro ao cadastrar disciplina: " . $stmt->error;
    }

    // Fecha o statement e a conexão com o banco
    $stmt->close();
    $conn->close();
}
