<?php
include('../conexao/conexao.php');  // abre a conexão
include('../inludes/header.php');   // cabeçalho
include('../api/exibir.php');
include('../api/adicionar.php');

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
        echo "<p>$resultado</p>"; // já mostra se for duplicata
    }
}
?>

<script>
function validarFormulario() {
    let cpf = document.getElementById("cpf").value;
    let nome = document.getElementById("nome").value;
    let nascimento = document.getElementById("data_nascimento").value;
    let turma = document.getElementById("turma").value;

    if (cpf.length !== 11 || isNaN(cpf)) {
        alert("CPF deve conter 11 números.");
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
    if (turma <= 0) {
        alert("Turma deve ser um número positivo.");
        return false;
    }

    return true;
}
</script>

<form method="POST" onsubmit="return validarFormulario()">
    <label>CPF:</label>
    <input type="number" name="cpf" id="cpf" required><br><br>

    <label>Nome:</label>
    <input type="text" name="nome" id="nome" required><br><br>

    <label>Data de Nascimento:</label>
    <input type="date" name="data_nascimento" id="data_nascimento" required><br><br>

    <label>Turma:</label>
    <input type="text" name="turma" id="turma" required><br><br>

    <input type="submit" value="Cadastrar">
</form>

<?php
listarTabela($conn,"alunos");
include('../inludes/footer.php');
?>
