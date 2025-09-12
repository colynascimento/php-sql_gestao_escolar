<!-- adicionar disciplinas -->
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
$cod_disc = $conn->real_escape_string($dados["cod_disc"]);
$nomeDisc = $conn->real_escape_string($dados["nomeDisc"]);
$cargaHora = $conn->real_escape_string($dados["cargaHora"]);

//monta comando sql para inserir a disciplina na tabela disciplinas

$sql = "INSERT INTO disciplinas (cod_disc, nome_disciplina, carga_horaria) VALUES ('$cod_disc', '$nomeDisc', '$cargaHora')";

        
if ($conn->query($sql) === TRUE) {
    echo json_encode(["sucesso"=> true]);
} else {
    echo json_encode(["sucesso"=> false, "erro" => $conn->error]);
}
$conn->close();
    
 
?>