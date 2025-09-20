
<?php
include('../conexao/conexao.php');


header('Content-Type: text/plain'); // Define o tipo de conteúdo da resposta como texto puro


// Verifica se a requisição é POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Captura os dados enviados pelo formulário via POST
    $num_turma = $_POST['num_turma'] ?? '';
    $nome = $_POST['nome'] ?? '';
    $turno = $_POST['turno'] ?? '';
    $sala = $_POST['sala'] ?? '';

    // Validação duplicidade turma
    $check = $conn->prepare("SELECT cpf FROM turmas WHERE num_turma = ?");
    $check->bind_param("s", $num_turma); // 's' indica que o parâmetro é string
    $check->execute();
    $check->store_result(); // Armazena o resultado da consulta

    if ($check->num_rows > 0) {
        echo "Erro: Já existe uma turma com este número.";
        exit;
    }

    // Insere aluno no banco
    $stmt = $conn->prepare("INSERT INTO alunos (num_turma, nome, turno, sala) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $num_turma, $nome, $turno, $sala);
    // "isss" indica: integer, string, string, string

    // Executa a inserção e verifica se funcionou
    if ($stmt->execute()) {
        echo "Turma cadastrada com sucesso!";
    } else {
        echo "Erro ao cadastrar turma: " . $stmt->error;
    }

    // Fecha o statement e a conexão com o banco
    $stmt->close();
    $conn->close();
}

function inserirRegistro($conn, $tabela, $coluna, $PK, $dados) {
    // Verifica se já existe
    $check = $conn->query("SELECT 1 FROM $tabela WHERE $coluna = $PK");

    if ($check && $check->num_rows > 0) {
        return "<span style='color:red;'>Erro: já existe um registro com este valor ($PK).</span>";
    }

    // Monta campos e valores
    $campos = implode(", ", array_keys($dados));
    $valores = implode("', '", array_map([$conn, 'real_escape_string'], array_values($dados)));

    $sql = "INSERT INTO $tabela ($campos) VALUES ('$valores')";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return "Erro SQL: " . $conn->error;
    }
}
?>
