<?php
include("../conexao/conexao.php");
include('../inludes/header.php');   // cabeçalho

?>


<form id="formTurmas">
    <fieldset>
        <legend id="legendaFormTurmas">Cadastrar Turma</legend>
        <div class="formBox">
            <label>Número da turma:</label>
            <input type = "number" id = "num_turma" name = "num_turma" required>
        </div>

        <div class="formBox">
            <label>Nome da turma:</label>
            <input type = "text" id = "nome" name = "nome" required>
        </div>
    </fieldset>


    <fieldset>
        <div class="formBox">
            <label>Turno:</label>
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

    <button type="submit">Enviar</button>
   
    <div id = "mensagem"></div>
</form>

<form id="formEditarTurma" style="display: none;">
    <fieldset>
        <legend>Editar Turma</legend>
        <div class="formBox">
            <label>Numero da turma:</label>
            <input type = "number" id = "num_turma" name = "num_turma" required>
        </div>


        <div class="formBox">
            <label>Nome da turma: </label>
            <input type = "text" id = "nome" name = "nome" required>
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


    <div class='btnBox'>
        <!-- CRIAR ESSAS FUNÇÕES AINDA!!!!!!!!! -->
        <button type="button" onclick="salvarEdicao()">Salvar Alterações</button>
        <button type="button" onclick="cancelarEdicao()">Cancelar</button>
    </div>
</form>


<h2>Lista de Turmas</h2>
<table id="tabelaTurmas">
    <thead>
        <tr class='cor-tabela1'>
            <th>Número da turma</th>
            <th>Nome da turma</th>
            <th>Turno</th>
            <th>Sala</th>
            <th>Ações</th> <!-- Editar / Apagar -->
        </tr>
    </thead>
    <tbody>
        <!-- O JavaScript preenche dinamicamente com os alunos -->
    </tbody>
</table>


<script src = "../js/manipularRegistroTurma.js"></script>


<script>
// Intercepta o envio do formulário de cadastro
document.getElementById('formTurmas').addEventListener('submit', e => {
    e.preventDefault(); // Impede o reload da página
    // Chama a função salvarAluno (definida em manipularRegistro.js)
    salvarTurma('formTurmas', '/php-sql_gestao_escolar/api/turma/adicionarTurma.php', atualizarTabelaTurmas);
});
</script>

<?php include('../inludes/footer.php'); ?>