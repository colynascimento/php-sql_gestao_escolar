<?php
//define que a resposta do servidor será enviada via JSON
header("Content-Type: application/json");
// conexão com o banco de dados
include("../conexao/conexao.php");


//lê a requisição e converte de JSON para array associativo
$dados = json_decode(file_get_contents("php://input"), true);

// vê se os dados foram recebidos
if (!$dados){
    echo json_encode = (["sucesso" = > false, "erro" => "Nenhum dado recebido"]);//se não tiver recebido nada, a "variavel" sucesso recebe "false" e a "variavel" erro recebe "Nenhum...."
    exit;
}
//se tudo der certo:
$nomeTurma = $conn->real_escape_string($dados["nomeTurma"]);
$turno = $conn->real_escape_string($dados["turno"]);
$sala = $conn->real_escape_string($dados["sala"]);

//monta comando sql para inserir a turma na tabela turmas

$sql = "INSERT INTO Turmas (nomeTurma, turno, sala) VALUES ('$nomeTurma', '$turno', '$sala')";

        
if ($conn->query($sql) === TRUE) {
    echo "<p>Turma cadastrada com sucesso!</p>";
} else {
    echo "<p>Erro: " . $conn->error . "</p>";
}
    
 
?>