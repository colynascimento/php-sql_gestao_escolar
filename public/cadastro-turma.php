<?php
include("../conexao/conexao.php");
include('../inludes/header.php');   // cabeçalho
include('../api/turma/exibirTurma.php');
// include('../api/turma/apagarTurma.php');
// include('../api/turma/editarTurma.php');

?>
<body>
    <form id="formTurmas" method = "POST" action = "">
        <fieldset>
            <legend id="legendaFormTurmas">Cadastrar Turma</legend>

            <div class="formBox">
                <label>Numero da turma: </label>
                <input type = "number" id = "num_turma" name = "num_turma" required>
            </div>

            <div class="formBox">
                <label>Nome da turma: </label>
                <input type = "text" id = "nomeTurma" name = "nomeTurma" required>
            </div>
        </fieldset>

        <fieldset>
            <div class="formBox">
                <label>Turno: </label>
                <select name = "turno" id = "turno" required>
                    <option value = ""disabled selected>Selecione</option>
                    <option value = "manha">Manhã</option>
                    <option value = "tarde">Tarde</option>
                    <option value = "noite">Noite</option>
                </select>
            </div>
        

            <div class="formBox">
                <label>Sala:</label>
                <input type = "text" id = "sala" name = "sala" required><br>
            </div>
        </fieldset>

        <button type="button" name="btnCadTurma" id="btnCadTurma">Enviar</button>
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


