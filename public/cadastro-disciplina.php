<?php
include("../conexao/conexao.php");
include('../inludes/header.php');   // cabeçalho
include('../api/exibir.php');
include('../api/apagar.php');

?>

<body>
    <form id="formDisciplina" method = "POST" action = "">
        <fieldset>
            <legend id='legendaFormDisciplinas'> Cadastrar Disciplinas</legend>
            <div class="formBox">
                <label>Código da disciplina: </label>
                <input type = "text" id = "cod_disc" name = "cod_disc" required>
            </div>

            <div class="formBox">
                <label>Nome da disciplina: </label>
                <input type = "text" id = "nomeDisc" name = "nomeDisc" required>
            </div>

            <div class="formBox">
                <label>Carga horária: </label>
                <input type = "number" id = "cargaHora" name = "cargaHora" required><label> horas</label>
            </div>
        </fieldset>

            <button type="button" name="btnCadDisciplina" id="btnCadDisciplina" >Cadastrar</button>
            <!-- <button onclick="apagarDisciplina()">Apagar Disciplina</button> -->
        
        <div id = "msg"></div>
    </form>
    <script src = "../js/disciplina.js"></script>
</body>

<?php
// Exibe a tabela de tumas cadastrados
listarTabela($conn, "disciplinas");

include('../inludes/footer.php');
?>


