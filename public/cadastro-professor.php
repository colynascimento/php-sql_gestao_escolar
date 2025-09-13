<?php
include('../conexao/conexao.php');  // abre a conexão
include('../inludes/header.php');   // cabeçalho
include('../api/exibir.php');
include('../api/adicionar.php');
include('../api/apagar.php');
?>

<h2>Cadastrar Professor</h2>
<form method="POST" onsubmit="return validarFormulario()">

    <label>CPF:</label>
    <input type="text" name="cpf" id="cpf" required maxlength="11" placeholder="Somente números"><br><br>

    <label>Nome:</label>
    <input type="text" name="nomeProf" id="nomeProf" required><br><br>

    <label>Data de Nascimento:</label>
    <input type="date" name="data_nasc" id="data_nasc" required><br><br>

    <label>Título:</label>
    <input type="text"  name = "titulo" id="titulo"><br><br>

    <input type="submit" value="Cadastrar">

    <!-- <button onclick="apagarProfessor()">Apagar Professor</button> -->
   
</form>

<script> 

    function validarFormulario() {
        let cpf = document.getElementById("cpf").value;
        let nomeProf = document.getElementById("nomeProf").value;
        let data_nasc = document.getElementById("data_nasc").value;
        let titulo = document.getElementById("titulo").value;

        // Validação do CPF: 11 dígitos numéricos
        if (!/^\d{11}$/.test(cpf)) {
            alert("CPF deve conter exatamente 11 números.");
            return false;
        }

        if (nomeProf.trim().length < 3) {
            alert("Nome deve ter pelo menos 3 caracteres.");
            return false;
        }

        if (!data_nasc) {
            alert("Informe a data de nascimento.");
            return false;
        }
        return true;
    }
</script>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dados = [
        "cpf"        => $_POST['cpf'] ?? null,
        "nome"       => $_POST['nomeProf'] ?? null,
        "data_nasc"  => $_POST['data_nasc'] ?? null,
        "titulo"  => $_POST['titulo'] ?? null
    ];

    // var_dump($_POST);
    $resultado = inserirRegistro($conn, "professores", $dados);
    
    if ($resultado === true) {
        echo "<p>Registro adicionado com sucesso!</p>";
    } else {
        echo "<p>$resultado</p>"; // já mostra se for duplicata ou erro
    }
}

// Exibe a tabela de alunos cadastrados
listarTabela($conn, "professores");

include('../inludes/footer.php');
?>


