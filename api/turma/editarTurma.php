<?php
include("../../conexao/conexao.php");

// Verifica se recebeu o ID
if (!isset($_GET['num_turma'])) {
    die("Turma não encontrada.");
}

$num_turma = intval($_GET['num_turma']);

// Busca os dados da turma
$sql = "SELECT * FROM turmas WHERE num_turma = $num_turma";
$result = mysqli_query($conn, $sql);

if (!$result || mysqli_num_rows($result) == 0) {
    die("Turma não encontrada.");
}

$turma = mysqli_fetch_assoc($result);

// Se enviou o formulário de edição
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // $num_turma = $_POST['num_turma'];
    $nome = $_POST['nome'];
    $turno = $_POST['turno'];
    $sala = $_POST['sala'];

    $update = "UPDATE turmas 
               SET nome='$nome', turno='$turno', sala='$sala' 
               WHERE num_turma='$num_turma'";

    if (mysqli_query($conn, $update)) {
        header("Location: ../../public/cadastro-turma.php?msg=Turma atualizada com sucesso");
        exit;
    } else {
        echo "Erro ao atualizar: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Turma</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1>Editar Turma</h1>
    <form method="POST">
        

        <label>Nome da turma:</label>
        <input type="text" name="nome" value="<?= $turma['nome'] ?>" required>

        <label>Turno:</label>
        <select name="turno" required>
            <option value="manha" <?= ($turma['turno']=="manha"?"selected":"") ?>>Manhã</option>
            <option value="tarde" <?= ($turma['turno']=="tarde"?"selected":"") ?>>Tarde</option>
            <option value="noite" <?= ($turma['turno']=="noite"?"selected":"") ?>>Noite</option>
        </select>

        <label>Sala:</label>
        <input type="text" name="sala" value="<?= $turma['sala'] ?>" required>

        <button type="submit">Salvar Alterações</button>
        <a href="cadastro-turma.php">Cancelar</a>
    </form>
</body>
</html>
