<?php include("../inludes/header.php")?>

<form id="formAluno">
    <label>CPF:</label>
    <input type="text" name="cpf" required>

    <label>Nome:</label>
    <input type="text" name="nome" required>

    <label>Data Nascimento:</label>
    <input type="date" name="data_nasc" required>

    <label>Turma:</label>
    <input type="number" name="num_turma" required min="1">

    <button type="submit">Cadastrar Aluno</button>
</form>

<!-- Botão Editar na tabela chama a função editarAluno(cpf) -->
<form id="formEditarAluno" style="display: none;">
    <h2>Editar Aluno</h2>
    <label>CPF:</label>
    <input type="text" name="cpf" readonly> <!-- CPF não pode ser alterado -->

    <label>Nome:</label>
    <input type="text" name="nome" required>

    <label>Data de Nascimento:</label>
    <input type="date" name="data_nasc" required>

    <label>Turma:</label>
    <input type="number" name="num_turma" required>

    <button type="button" onclick="salvarEdicao()">Salvar Alterações</button>
    <button type="button" onclick="cancelarEdicao()">Cancelar</button>
</form>


<h2>Lista de Alunos</h2>
<table id="tabelaAlunos">
    <thead>
        <tr>
            <th>CPF</th>
            <th>Nome</th>
            <th>Data Nascimento</th>
            <th>Turma</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        
    </tbody>
</table>

<div id="mensagem"></div>

<script src="../js/manipularRegistro.js"></script>
<script>
document.getElementById('formAluno').addEventListener('submit', e => {
    e.preventDefault();
    salvarAluno('formAluno', '/php-sql_gestao_escolar/api/aluno/adicionarAluno.php', atualizarTabelaAlunos);
});

</script>

<?php
include("../inludes/footer.php")
?>
