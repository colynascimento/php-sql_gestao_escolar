<?php include("../inludes/header.php")?> <!-- Inclui o cabeçalho (menu, estilos, etc.) -->
<?php include('../conexao/conexao.php')?> <!-- Faz a conexão com o banco de dados -->

<!-- ================================ Formulario Principal ================================ -->
<form id="formAluno">
    <fieldset>
        <legend id="legendaFormAlunos">Cadastrar Aluno</legend>
        <div class="formBox">
            <!-- Campo para CPF (11 caracteres fixos) -->
            <label for='cpfAluno'>CPF:</label>
            <input type="text" name="cpfAluno" minlength="11" maxlength="11" name='cpf' required>
        </div>

        <div class="formBox">
            <!-- Campo para Nome (mínimo 3 letras) -->
            <label for="nome">Nome:</label>
            <input type="text" name="nomeAluno" minlength="3" name="nomeAluno" required>
        </div>
    </fieldset>
    
    <fieldset>
        <div class="formBox">
            <!-- Campo para Data de Nascimento, com limites definidos -->
            <label>Data Nascimento:</label>
            <input type="date" name="data_nasc" min="2007-01-01" max="2025-12-31" required>
        </div>

        <div class="formBox">
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
        </div>
    </fieldset>
    
    <!-- Botão para enviar o formulário (cadastrar aluno) -->
    <button type="submit">Cadastrar Aluno</button>
</form>
<!-- Div para exibir mensagens (sucesso, erro, etc.) -->
<div id="mensagem"></div>

<!-- ================================ Formulario para editar o aluno ================================ -->
<!-- Por padrão, fica escondido (display:none) -->
<form id="formEditarAluno" style="display: none;">
    
    <fieldset>
        <legend>Editar Aluno</legend>
        <div class="formBox">
            <!-- Mesmo layout do formulário principal -->
            <label>CPF:</label>
            <input type="text" name="cpf" minlength="11" maxlength="11" required>
        </div>

        <div class="formBox">
            <label>Nome:</label>
            <input type="text" name="nome" minlength="3" required>
        </div>
    </fieldset>

    <fieldset>
        <div class="formBox">
            <label>Data Nascimento:</label>
            <input type="date" name="data_nasc" min="2007-01-01" max="2025-12-31" required>
        </div>        

        <div class="formBox">
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
        </div>
    </fieldset>

    <div class='btnBox'>
        <!-- Botões para salvar ou cancelar a edição -->
        <button type="button" onclick="salvarEdicao()">Salvar Alterações</button>
        <button type="button" onclick="cancelarEdicao()">Cancelar</button>
    </div>
</form>

<!-- ================================ Tabela de alunos ================================ -->
<h2>Lista de Alunos</h2>
<table id="tabelaAlunos">
    <thead>
        <tr class='cor-tabela1'>
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
