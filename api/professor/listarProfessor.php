<?php
// ================================ Conexão com o banco ================================
include('../../conexao/conexao.php');  // Inclui a conexão com o banco de dados
header('Content-Type: application/json'); // Define que a resposta será em JSON

// ================================ Inicializa array de professores ================================
$professores = [];

// ================================ Busca todos os professores ================================
if ($conn) { // Verifica se a conexão existe
    $result = $conn->query("SELECT cpf, nome, data_nasc, cod_disc FROM professores"); 
    // Executa a query para buscar todos os professores
    
    if ($result) { // Se a consulta retornou resultados
        while ($row = $result->fetch_assoc()) { 
            // Adiciona cada registro ao array $professores
            $professores[] = $row;
        }
    }
}

// ================================ Retorna JSON ================================
echo json_encode($professores); // Converte o array de professores em JSON e envia para o front-end
?>
