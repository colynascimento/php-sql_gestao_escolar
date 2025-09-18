<?php
include('../conexao/conexao.php');  // abre a conexão
include('../inludes/header.php');   // cabeçalho
include('../conexao/conexao.php');
include('../api/exibir.php');
include('../api/adicionar.php');
include('../api/apagar.php');
?>

<h2>Cadastrar Professor</h2>
<!-- ================================ Formulario Principal ================================ -->
<form id="formProfessor">

    <label for="cpf">CPF:</label>
    <input type="text" name="cpf" minlength="11" maxlength="11" required>
    
    <label for="nome">Nome:</label>
    <input type="text" name="nome" minlength="3" required>
    
    <label for="data_nasc">Data Nascimento:</label>
    <input type="date" name="data_nasc" max="2025-12-31" required>

    <label for="titulo">Titulo:</label>
    <input type="text" name="titulo"required>
    >
    <button type="submit">Cadastrar Aluno</button>
</form>

<!-- Div para exibir mensagens (sucesso, erro, etc.) -->
<div id="mensagem"></div>

<!-- ================================ Formulario para editar o Professor ================================ -->
<!-- Por padrão, fica escondido (display:none) -->
<form id="formEditarProfessor" style="display: none;">
    <h2>Editar Professor</h2>
    
    <label>CPF:</label>
    <input type="text" name="cpf" minlength="11" maxlength="11" required>

    <label>Nome:</label>
    <input type="text" name="nome" minlength="3" required>

    <label>Data Nascimento:</label>
    <input type="date" name="data_nasc" min="2007-01-01" max="2025-12-31" required>
    
    <label for="titulo">Titulo:</label>
    <input type="text" name="titulo"required>

    <!-- Botões para salvar ou cancelar a edição -->
    <button type="button" onclick="salvarEdicao()">Salvar Alterações</button>
    <button type="button" onclick="cancelarEdicao()">Cancelar</button>
</form>

<!-- ================================ Tabela de alunos ================================ -->
<h2>Lista de Professor</h2>
<table id="tabelaProfessor">
    <thead>
        <tr>
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
