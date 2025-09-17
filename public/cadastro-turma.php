<?php
include("../conexao/conexao.php");
include('../inludes/header.php');   // cabeçalho
include('../api/exibir.php');
include('../api/apagar.php');
include('../api/turma/adicionar.php');

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro-Turmas</title>
    <link rel = "stylesheet" href = "../css/style.css">
</head>
<body>
    <h1>Cadastro de Turmas </h1>
    <form id="cadTurma" method = "POST" action = "">
        <label>Numero da turma: </label>
        <input type = "number" id = "num_turma" name = "num_turma" required>
        <label>Nome da turma: </label>
        <input type = "text" id = "nomeTurma" name = "nomeTurma" required>
        <label>Turno: </label>
        <select name = "turno" id = "turno" required>
            <option value = ""disabled selected>Selecione</option>
            <option value = "manha">Manhã</option>
            <option value = "tarde">Tarde</option>
            <option value = "noite">Noite</option>
        </select>
        <label>Sala:</label>
        <input type = "text" id = "sala" name = "sala" required><br>
        <button type="button" name="btnCadTurma" id="btnCadTurma" >Cadastrar</button>
        <!-- <button onclick="apagarTurma()">Apagar Turma</button> -->
        
        <div id = "msg"></div>

    </form>
    <script src = "../js/turma.js"></script>
</body>
</html>

<?php
// Exibe a tabela de tumas cadastrados
listarTabela($conn, "turmas");

include('../inludes/footer.php');
?>


