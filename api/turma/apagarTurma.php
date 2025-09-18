<?php
include("../../conexao/conexao.php");
// Verifica se recebeu o ID
if (!isset($_GET['num_turma'])) {
    die("Turma não encontrada.");
    }   

$num_turma = intval($_GET['num_turma']);

// Busca os dados da turma
$sql = "DELETE FROM turmas WHERE num_turma = $num_turma";
$result = mysqli_query($conn, $sql);

if (mysqli_query($conn, $sql)) {
        header("Location: ../../public/cadastro-turma.php?msg=Turma excluída com sucesso");
        exit;
    } else {
        echo "Erro ao excluir: " . mysqli_error($conn);
    }