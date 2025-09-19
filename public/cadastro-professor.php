<?php
include('../conexao/conexao.php');  // abre a conexão
include('../inludes/header.php');   // cabeçalho
include('../conexao/conexao.php');
include('../api/exibir.php');
include('../api/adicionar.php');
include('../api/apagar.php');
?>

<!-- ================================ Formulario Principal ================================ -->
<form id="formProfessor">
    <fieldset>
        <legend id='legendaFormProfessores'>Cadastrar Professor</legend>
        <div class="formBox">
            <label for="cpf">CPF:</label>
            <input type="text" name="cpf" minlength="11" maxlength="11" required>
        </div>
        <div class="formBox">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" minlength="3" required>
        </div>
    </fieldset>
    
    <fieldset>
        <div class="formBox">
            <label for="data_nasc">Data Nascimento:</label>
            <input type="date" name="data_nasc" min="1960-01-01" max="2025-12-31" required>
        </div>

        <div class="formBox">
            <label for="titulo">Titulo:</label>
            <input type="text" name="titulo"required>
        </div>
    </fieldset>

    <button type="submit">Enviar</button>
</form>

<!-- Div para exibir mensagens (sucesso, erro, etc.) -->
<div id="mensagem"></div>

<!-- ================================ Formulario para editar o Professor ================================ -->
<!-- Por padrão, fica escondido (display:none) -->
<form id="formEditarProfessor" style="display: none;">
    <fieldset>
        <legend>Editar Professor</legend>

        <div class="formBox">
            <label for="cpf">CPF:</label>
            <input type="text" name="cpf" minlength="11" maxlength="11" required>
        </div>

        <div class="formBox">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" minlength="3" required>
        </div>
    </fieldset>
    
    <fieldset>
        <div class="formBox">
            <label for="data_nasc">Data Nascimento:</label>
            <input type="date" name="data_nasc" min="1960-01-01" max="2025-12-31" required>
        </div>

        <div class="formBox">
            <label for="titulo">Titulo:</label>
            <input type="text" name="titulo"required>
        </div>
    </fieldset>

    <div class="btnBox">
        <!-- Botões para salvar ou cancelar a edição -->
        <button type="button" onclick="salvarEdicao()">Salvar Alterações</button>
        <button type="button" onclick="cancelarEdicao()">Cancelar</button>
    </div>
</form>

<!-- ================================ Tabela de alunos ================================ -->
<h2>Lista de Professores</h2>
<table id="tabelaProfessor">
    <thead>
        <tr class='cor-tabela1'>
            <th>CPF</th>
            <th>Nome</th>
            <th>Data Nascimento</th>
            <th>Titulo</th>
            <th>Ações</th> <!-- Editar / Apagar -->
        </tr>
    </thead>
    <tbody>
        <!-- O JavaScript preenche dinamicamente com os professores -->
    </tbody>
</table>


<!-- Script de manipulação de registros (CRUD via AJAX/Fetch) -->
<script src="../js/manipularRegistroProfessor.js"></script>

<script>
// Intercepta o envio do formulário de cadastro
document.getElementById('formProfessor').addEventListener('submit', e => {
    e.preventDefault(); // Impede o reload da página
    // Chama a função salvarAluno (definida em manipularRegistro.js)
    salvarProfessor('formProfessor', '/php-sql_gestao_escolar/api/professor/adicionarProfessor.php', atualizarTabelaProfessor);
});
</script>

<?php
include("../inludes/footer.php") // Inclui o rodapé
?>
