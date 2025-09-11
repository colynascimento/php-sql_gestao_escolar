<?php
include('../conexao/conexao.php');  // abre a conexão
include('../inludes/header.php');   // cabeçalho
include('../api/exibir.php');
include('../api/adicionar.php');
include('../api/apagar.php');
?>

<h2>Cadastrar Aluno</h2>
<form method="POST" onsubmit="return validarFormulario()">

    <label>CPF:</label>
    <input type="text" name="cpf" id="cpf" required maxlength="11" placeholder="Somente números"><br><br>

    <label>Nome:</label>
    <input type="text" name="nome" id="nome" required><br><br>

    <label>Data de Nascimento:</label>
    <input type="date" name="data_nascimento" id="data_nascimento" required><br><br>

    <label for="turma">Turma:</label>
    <input type="text"  id="turma"><br><br>

    <input type="submit" value="Cadastrar">

    <button onclick="apagarAluno()">Apagar Aluno</button>
    <?php
        // Consulta apenas a tabela turma
        $sql = "SELECT * FROM turmas";
        $resultado = $conn->query($sql);
        
        if ($resultado && $resultado->num_rows > 0) {
            while ($linha = $resultado->fetch_assoc()) {
                echo "<option value='" . htmlspecialchars($linha['num_turma']) . "'>" 
                . htmlspecialchars($linha['nome_turma']) . "</option>";
            }
        } else {
            echo "<option value=''>Nenhuma turma cadastrada</option>";
        }
        ?>    
</form>

<script> 

    function validarFormulario() {
        let cpf = document.getElementById("cpf").value;
        let nome = document.getElementById("nome").value;
        let nascimento = document.getElementById("data_nascimento").value;
        let turma = document.getElementById("turma").value;

        // Validação do CPF: 11 dígitos numéricos
        if (!/^\d{11}$/.test(cpf)) {
            alert("CPF deve conter exatamente 11 números.");
            return false;
        }

        if (nome.trim().length < 3) {
            alert("Nome deve ter pelo menos 3 caracteres.");
            return false;
        }

        if (!nascimento) {
            alert("Informe a data de nascimento.");
            return false;
        }
        
        return true;
    }
</script>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dados = [
        "cpf" => $_POST['cpf'] ?? null,
        "nome" => $_POST['nome'] ?? null,
        "data_nasc" => $_POST['data_nascimento'] ?? null,
        "num_turma" => $_POST['turma'] ?? null
    ];
    
    $resultado = inserirRegistro($conn, "alunos", $dados);
    
    if ($resultado === true) {
        echo "<p>Registro adicionado com sucesso!</p>";
    } else {
        echo "<p>$resultado</p>"; // já mostra se for duplicata ou erro
    }
}

// Exibe a tabela de alunos cadastrados
listarTabela($conn, "alunos");

include('../inludes/footer.php');
?>
