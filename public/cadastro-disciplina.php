<?php
include("../conexao/conexao.php");
include('../inludes/header.php');
?>

<!-- ================================ Formulario Principal ================================ -->
<form id="formDisciplina" method = "POST" action = "">
    <fieldset>
        <legend id='legendaFormDisciplinas'> Cadastrar Disciplinas</legend>
        <div class="formBox">
            <label>Código da disciplina: </label>
            <input type = "text" id = "cod_disc" name = "cod_disc" required>
        </div>

        <div class="formBox">
            <label>Nome da disciplina: </label>
            <input type = "text" id = "nome_disciplina" name = "nome_disciplina" required>
        </div>

        <div class="formBox">
            <label>Carga horária: </label>
            <input type = "number" id = "carga_horaria" name = "carga_horaria" required>
        </div>
    </fieldset>

    <button type="submit">Enviar</button>
</form>

<div id="mensagem"></div>

<!-- ================================ Formulario editção de registro ================================ -->
<form id="formEditarDisciplina" style="display: none;">
    
    <fieldset>
        <legend id='legendaFormDisciplinas'> Cadastrar Disciplinas</legend>
        <div class="formBox">
            <label>Código da disciplina: </label>
            <input type = "text" id = "cod_disc" name = "cod_disc" required>
        </div>

        <div class="formBox">
            <label>Nome da disciplina: </label>
            <input type = "text" id = "nome_disciplina" name = "nome_disciplina" required>
        </div>

        <div class="formBox">
            <label>Carga horária: </label>
            <input type = "number" id = "carga_horaria" name = "carga_horaria" required>
        </div>
    </fieldset>

    <div class='btnBox'>
        <!-- Botões para salvar ou cancelar a edição -->
        <button type="button" onclick="salvarEdicao()">Salvar Alterações</button>
        <button type="button" onclick="cancelarEdicao()">Cancelar</button>
    </div>
</form>

<!-- ================================ Tabela de alunos ================================ -->
<h2>Lista de Disciplinas</h2>
<table id="tabelaDisciplinas">
    <thead>
        <tr class='cor-tabela1'>
            <th>Codigo Disciplina</th>
            <th>Nome da Disciplina</th>
            <th>Carga Horaria</th>
            <th>Ações</th> <!-- Editar / Apagar -->
        </tr>
    </thead>
    <tbody>
        <!-- O JavaScript preenche dinamicamente com os alunos -->
    </tbody>
</table>


<!-- Script de manipulação de registros (CRUD via AJAX/Fetch) -->
<script src="../js/manipularRegistroDisciplina.js"></script>

<script>
// Intercepta o envio do formulário de cadastro
document.getElementById('formDisciplina').addEventListener('submit', e => {
    e.preventDefault(); // Impede o reload da página
    // Chama a função salvarAluno (definida em manipularRegistro.js)
    salvarDisciplina('formDisciplina', '/php-sql_gestao_escolar/api/disciplina/adicionarDisciplina.php', atualizarTabelaDisciplina);
});
</script>
<?php
include('../inludes/footer.php');
?>


