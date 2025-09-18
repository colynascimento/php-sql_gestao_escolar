<?php
// ================================ Conexão com o banco ================================
include('../../conexao/conexao.php');  // Inclui a conexão com o banco de dados
header('Content-Type: application/json'); // Define que a resposta será em JSON

// ================================ Inicializa array de alunos ================================
$alunos = [];

// ================================ Busca todos os alunos ================================
if ($conn) { // Verifica se a conexão existe
    $result = $conn->query("SELECT cpf, nome, data_nasc, titulo FROM professores"); 
    // Executa a query para buscar todos os alunos
    
    if ($result) { // Se a consulta retornou resultados
        while ($row = $result->fetch_assoc()) { 
            // Adiciona cada registro ao array $alunos
            $alunos[] = $row;
        }
    }
}

// ================================ Retorna JSON ================================
echo json_encode($alunos); // Converte o array de alunos em JSON e envia para o front-end
?>
