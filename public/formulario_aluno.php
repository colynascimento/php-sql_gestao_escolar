<?php include("../inludes/header.php")?> <!-- Inclui o cabeçalho (menu, estilos, etc.) -->
<?php include('../conexao/conexao.php')?> <!-- Faz a conexão com o banco de dados -->

<!-- ================================ Formulario Principal ================================ -->
<form id="formAluno">
    <!-- Campo para CPF (11 caracteres fixos) -->
    <label>CPF:</label>
    <input type="text" name="cpf" minlength="11" maxlength="11" required>

    <!-- Campo para Nome (mínimo 3 letras) -->
    <label>Nome:</label>
    <input type="text" name="nome" minlength="3" required>

    <!-- Campo para Data de Nascimento, com limites definidos -->
    <label>Data Nascimento:</label>
    <input type="date" name="data_nasc" min="2007-01-01" max="2025-12-31" required>
    
    <!-- Campo de seleção da turma -->
    <label for="num_turma">Turma:</label>
    <select name="num_turma" id="num_turma" required>
        <option value="">-- Selecione uma turma --</option>
        <?php
        // Busca todas as turmas cadastradas no banco
        if ($conn) {
            $sql = "SELECT num_turma, nome, turno, sala FROM turmas";
            $result = $conn->query($sql);

            // Se houver resultados, gera cada <option>
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // Cada opção tem como value o número da turma
                    // E exibe: Nome - Turno - Sala
                    echo '<option value="' . $row['num_turma'] . '">';
                    echo $row['nome'] . ' - ' . $row['turno'] . ' - Sala ' . $row['sala'];
                    echo '</option>';
                }
            }
        }
        ?>
    </select>

    <!-- Botão para enviar o formulário (cadastrar aluno) -->
    <button type="submit">Cadastrar Aluno</button>
</form>

<!-- ================================ Formulario para editar o aluno ================================ -->
<!-- Por padrão, fica escondido (display:none) -->
<form id="formEditarAluno" style="display: none;">
    <h2>Editar Aluno</h2>
    
    <!-- Mesmo layout do formulário principal -->
    <label>CPF:</label>
    <input type="text" name="cpf" minlength="11" maxlength="11" required>

    <label>Nome:</label>
    <input type="text" name="nome" minlength="3" required>

    <label>Data Nascimento:</label>
    <input type="date" name="data_nasc" min="2007-01-01" max="2025-12-31" required>
    
    <!-- Select de turmas (mesmo código do formulário principal) -->
    <label for="num_turma">Turma:</label>
    <select name="num_turma" id="num_turma" required>
        <option value="">-- Selecione uma turma --</option>
        <?php
        if ($conn) {
            $sql = "SELECT num_turma, nome, turno, sala FROM turmas";
            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<option value="' . $row['num_turma'] . '">';
                    echo $row['nome'] . ' - ' . $row['turno'] . ' - Sala ' . $row['sala'];
                    echo '</option>';
                }
            }
        }
        ?>
    </select>

    <!-- Botões para salvar ou cancelar a edição -->
    <button type="button" onclick="salvarEdicao()">Salvar Alterações</button>
    <button type="button" onclick="cancelarEdicao()">Cancelar</button>
</form>

<!-- ================================ Tabela de alunos ================================ -->
<h2>Lista de Alunos</h2>
<table id="tabelaAlunos">
    <thead>
        <tr>
            <th>CPF</th>
            <th>Nome</th>
            <th>Data Nascimento</th>
            <th>Turma</th>
            <th>Ações</th> <!-- Editar / Apagar -->
        </tr>
    </thead>
    <tbody>
        <!-- O JavaScript preenche dinamicamente com os alunos -->
    </tbody>
</table>

<!-- Div para exibir mensagens (sucesso, erro, etc.) -->
<div id="mensagem"></div>

<!-- Script de manipulação de registros (CRUD via AJAX/Fetch) -->
<script src="../js/manipularRegistro.js"></script>

<script>
// Intercepta o envio do formulário de cadastro
document.getElementById('formAluno').addEventListener('submit', e => {
    e.preventDefault(); // Impede o reload da página
    // Chama a função salvarAluno (definida em manipularRegistro.js)
    salvarAluno('formAluno', '/php-sql_gestao_escolar/api/aluno/adicionarAluno.php', atualizarTabelaAlunos);
});
</script>

<?php
include("../inludes/footer.php") // Inclui o rodapé
?>
