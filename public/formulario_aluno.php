<?php
include('../conexao/conexao.php');  // abre a conexão
include('../inludes/header.php');   // cabeçalho
include('../api/exibir.php');
include('../api/adicionar.php');
?>
<script src="../js/validarFormulario.js"></script>
<script src="../js/manipularRegistro.js"></script>

<h2>Cadastrar Aluno</h2>
<form id="formAluno" method="POST">

    <label>CPF:</label>
    <input type="text" name="cpf" id="cpf" required maxlength="11" placeholder="Somente números"><br><br>

    <label>Nome:</label>
    <input type="text" name="nome" id="nome" required><br><br>

    <label>Data de Nascimento:</label>
    <input type="date" name="data_nascimento" id="data_nascimento" required><br><br>
    
    <label for="turma">Turma:</label>
    <select name="turma" id="turma">
        <option value="">Selecione a turma</option>
        <?php
        $sql = "SELECT * FROM turmas";
        $resultado = $conn->query($sql);
        if ($resultado && $resultado->num_rows > 0) {
            while ($linha = $resultado->fetch_assoc()) {
                echo "<option value='" . htmlspecialchars($linha['num_turma']) . "'>"
                    . htmlspecialchars($linha['nome_turma']) . "</option>";
            }
        }
        ?>
    </select>

    </select><br><br>
    <input type="submit" value="Cadastrar">
    <button type="button" id="apagarDado">Apagar</button>

</form>
<!-- div para mostrar mensagens -->
<div id="mensagemStatus"></div>

<script>
    const form = document.getElementById('formAluno');

    // Validação e envio genérico
    form.addEventListener('submit', function(e) {
        e.preventDefault(); // previne envio padrão
        if (validarFormularioAluno('formAluno')) {
            adicionarRegistro('formAluno', '../api/adicionar.php');
        }
    });

    document.getElementById('apagarDado')
            .addEventListener('click', () => apagarRegistro('alunos', 'cpf'));
</script>
<?php
// Exibe a tabela de alunos cadastrados
listarTabela($conn, "alunos");

include('../inludes/footer.php');
?>