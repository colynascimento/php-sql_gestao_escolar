<?php
// Inclui o arquivo de conexão com o banco de dados
include('../conexao/conexao.php');

function listarTabela($conn, $nomeTabela) {
    // Monta a query SQL para selecionar todos os registros da tabela
    $sql = "SELECT * FROM $nomeTabela ";

    // Executa a consulta no banco
    $resultado = $conn->query($sql);

    // Verifica se encontrou algum registro
    if ($resultado->num_rows > 0) {
        echo "<h2>Tabela: $nomeTabela</h2>";
        echo "<table border='1'><tr>";

        // Obtém os nomes das colunas da tabela
        $campos = $resultado->fetch_fields();

        // Exibe o cabeçalho da tabela com os nomes das colunas
        foreach ($campos as $campo) {
            echo "<th>" . $campo->name . "</th>";
        }
        echo "</tr>";

        // Volta o ponteiro do resultado para o início (importante)
        $resultado->data_seek(0);

        // Percorre todos os registros retornados
        while ($linha = $resultado->fetch_assoc()) {
            echo "<tr>";

            // Para cada valor da linha (cada coluna do registro)
            foreach ($linha as $valor) {
                echo "<td>" . $valor . "</td>";
            }

            echo "</tr>";
        }
        echo "</table><br>";
    } else {
        // Caso não tenha registros
        echo "<p>Nenhum registro encontrado na tabela $nomeTabela.</p>";
    }
}

// Captura a tabela enviada via GET (ex: listar.php?tabela=usuarios)
// Caso não seja passado nada, define 'usuarios' como padrão
$tabela = $_GET['tabela'] ?? 'usuarios';

?>
