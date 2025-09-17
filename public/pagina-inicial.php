<?php include '../inludes/header.php';
    require_once __DIR__ . "/../conexao/conexao.php";
    include '../api/principal/exibir.php';

    listarTurmas($conn);

    $conn->close();
?>
    <script src="../js/tabela-dinamica.js"></script>

<?php include '../inludes/footer.php'; ?>