<?php
include('../conexao/conexao.php');
include('../inludes/header.php');

// Consulta todos os alunos
$sql = "SELECT * FROM alunos";
$result = $conn->query($sql);

echo "<h2>Registros da tabela Alunos</h2>";

if ($result->num_rows > 0) {
    echo "<table border='1' cellpadding='5' cellspacing='0'>";
    echo "<tr>";
    
    // Pega os nomes das colunas dinamicamente
    while ($fieldinfo = $result->fetch_field()) {
        echo "<th>" . htmlspecialchars($fieldinfo->name) . "</th>";
    }
    echo "</tr>";

    // Exibe os dados
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        foreach($row as $value) {
            echo "<td>" . htmlspecialchars($value) . "</td>";
        }
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "<p>Nenhum registro encontrado.</p>";
}

include('../inludes/footer.php');
?>
