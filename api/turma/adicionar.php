<?php
//define que a resposta do servidor será enviada via JSON
header("Content-Type: application/json");
// conexão com o banco de dados
include("../../conexao/conexao.php");


//lê a requisição e converte de JSON para array associativo
$dados = json_decode(file_get_contents("php://input"), true);

// vê se os dados foram recebidos
if (!$dados){
    echo json_encode(["sucesso" => false, "erro" => "Nenhum dado recebido"]);//se não tiver recebido nada, a "variavel" sucesso recebe "false" e a "variavel" erro recebe "Nenhum...."
    exit;
}
//se tudo der certo:
$num_turma = $conn->real_escape_string($dados["num_turma"]);
$nomeTurma = $conn->real_escape_string($dados["nomeTurma"]);
$turno = $conn->real_escape_string($dados["turno"]);
$sala = $conn->real_escape_string($dados["sala"]);

//monta comando sql para inserir a turma na tabela turmas

$sql = "INSERT INTO turmas (num_turma, nome, turno, sala) VALUES ('$num_turma', '$nomeTurma', '$turno', '$sala')";

        
if ($conn->query($sql) === TRUE) {
    echo json_encode(["sucesso"=> true]);
} else {
    echo json_encode(["sucesso"=> false, "erro" => $conn->error]);
}
$conn->close();
    
 
?>