<?php
include('../conexao/conexao.php');

function apagarRegistro($conn, $tabela, $campoPk, $valorPk) {
    $tabela = $conn->real_escape_string($tabela);
    $campoPk = $conn->real_escape_string($campoPk);
    $valorPk = $conn->real_escape_string($valorPk);

    $sql = "DELETE FROM $tabela WHERE $campoPk = '$valorPk'";

    if ($conn->query($sql) === TRUE) {
        return "Dado apagado com sucesso";
    } else {
        return "<span style='color:red;'>Erro ao apagar registro ($valorPk): " . $conn->error . "</span>";
    }
}

// Processa requisição AJAX
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tabela  = $_POST['tabela'] ?? '';
    $campoPk = $_POST['campoPK'] ?? '';
    $valorPk = $_POST['valorPK'] ?? '';

    if ($tabela && $campoPk && $valorPk) {
        echo apagarRegistro($conn, $tabela, $campoPk, $valorPk);
    } else {
        echo "<span style='color:red;'>Dados insuficientes para apagar registro.</span>";
    }
}
?>
