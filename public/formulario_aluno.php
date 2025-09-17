<?php
include("../conexao/conexao.php");
include('../inludes/header.php');   // cabeçalho
//include('../inludes/usuarios.php');  
//include('../api/exibir.php');
//include('../api/aluno/apagarAluno.php');
//include('../api/aluno/listarAlunos.php');
//include('../api/aluno/adicionarAluno.php');

?>

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

<h2>Lista de Alunos</h2>
<table id="tabelaAlunos" border="1">
    <thead>
        <tr>
            <th>CPF</th>
            <th>Nome</th>
            <th>Data Nascimento</th>
            <th>Turma</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody></tbody>
</table>

<div id="mensagem"></div>

<script src="../js/manipularRegistro.js"></script>
<script>
document.getElementById('formAluno').addEventListener('submit', e => {
    e.preventDefault();
    salvarAluno('formAluno', '/php-sql_gestao_escolar/api/aluno/adicionarAluno.php', atualizarTabelaAlunos);
});

// Carrega a tabela ao abrir a página
atualizarTabelaAlunos();
</script>

<?php
include("../inludes/footer.php")
?>
