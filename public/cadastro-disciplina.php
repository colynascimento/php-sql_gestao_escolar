<?php
include("../conexao/conexao.php");
include('../inludes/header.php');   // cabeçalho
include('../api/exibir.php');
include('../api/apagar.php');

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro-Disciplinas</title>
    <link rel = "stylesheet" href = "../css/style.css">
</head>
<body>
    <h1>Cadastro de Disciplinass </h1>
    <form id="cadDisciplina" method = "POST" action = "">
        <label>Código da disciplina: </label>
        <input type = "text" id = "cod_disc" name = "cod_disc" required>
        <label>Nome da disciplina: </label>
        <input type = "text" id = "nomeDisc" name = "nomeDisc" required>
        <label>Carga horária: </label>
        <input type = "number" id = "cargaHora" name = "cargaHora" required><label> horas</label>
        <br>
        <button type="button" name="btnCadDisciplina" id="btnCadDisciplina" >Cadastrar</button>
        <!-- <button onclick="apagarDisciplina()">Apagar Disciplina</button> -->
        
        <div id = "msg"></div>

    </form>
    <script src = "../js/disciplina.js"></script>
</body>
</html>

<?php
// Exibe a tabela de tumas cadastrados
listarTabela($conn, "disciplinas");

include('../inludes/footer.php');
?>


