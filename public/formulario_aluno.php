<?php include("../inludes/header.php")?>
<?php include('../conexao/conexao.php')?>

<form id="formAluno">
    <label>CPF:</label>
    <input type="text" name="cpf" minlength="11" maxlength="11"required>

    <label>Nome:</label>
    <input type="text" name="nome" minlength="3" required>

    <label>Data Nascimento:</label>
    <input type="date" name="data_nasc"  min="2007-01-01" max="2025-12-31" required>
    
    <label for="num_turma">Turma:</label>
    <select name="num_turma" id="num_turma" required>
        <option value="">-- Selecione uma turma --</option>
        <?php
        if ($conn) {
            $sql = "SELECT num_turma, nome, turno, sala FROM turmas";
            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // Gera cada opção
                    echo '<option value="' . $row['num_turma'] . '">';
                    echo $row['nome'] . ' - ' . $row['turno'] . ' - Sala ' . $row['sala'];
                    echo '</option>';
                }
            }
        }
        ?>
    </select>


    <button type="submit">Cadastrar Aluno</button>
</form>

<!-- Botão Editar na tabela chama a função editarAluno(cpf) -->
<form id="formEditarAluno" style="display: none;">
    <h2>Editar Aluno</h2>
    <label>CPF:</label>
    <input type="text" name="cpf" minlength="11" maxlength="11"required>

    <label>Nome:</label>
    <input type="text" name="nome" minlength="3" required>

    <label>Data Nascimento:</label>
    <input type="date" name="data_nasc"  min="2007-01-01" max="2025-12-31" required>
    
    <label for="num_turma">Turma:</label>
    <select name="num_turma" id="num_turma" required>
        <option value="">-- Selecione uma turma --</option>
        <?php
        if ($conn) {
            $sql = "SELECT num_turma, nome, turno, sala FROM turmas";
            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // Gera cada opção
                    echo '<option value="' . $row['num_turma'] . '">';
                    echo $row['nome'] . ' - ' . $row['turno'] . ' - Sala ' . $row['sala'];
                    echo '</option>';
                }
            }
        }
        ?>
    </select>

    <button type="button" onclick="salvarEdicao()">Salvar Alterações</button>
    <button type="button" onclick="cancelarEdicao()">Cancelar</button>
</form>

<script src="../js/validarFormulario.js"></script>

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
