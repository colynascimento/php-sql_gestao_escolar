<?php
include("../conexao/conexao.php");
function listarTabela($conn, $nomeTabela) {
    $sql = "SELECT * FROM $nomeTabela";
    $resultado = $conn->query($sql);

    if ($resultado->num_rows > 0) {
        echo "<h2>Turmas Cadastradas</h2>";
        echo "<table border='1'><tr>";

        $campos = $resultado->fetch_fields();
        foreach ($campos as $campo) {
            echo "<th>" . $campo->name . "</th>";
        }
        echo "<th>Ações</th></tr>";

        $resultado->data_seek(0);

        while ($linha = $resultado->fetch_assoc()) {
            echo "<tr>";
            foreach ($linha as $valor) {
                echo "<td>$valor</td>";
            }//verifica ids
            echo "<td>
                    <a href='../api/turma/editarTurma.php?num_turma={$linha['num_turma']}'>Editar</a> | 
                    <a href='../api/turma/apagarTurma.php?tabela=turmas&num_turma={$linha['num_turma']}' 
                    onclick=\"return confirm('Tem certeza que deseja excluir?')\">Excluir</a>
                  </td>";
            echo "</tr>";
        }
        echo "</table><br>";
    } else {
        echo "<p>Nenhum registro encontrado.</p>";
    }
}
    // DELETE - se veio via GET
//     if (isset($_POST['deletar'])) {
//         $id = intval($_POST['deletar']);
//         $conn->query("DELETE FROM turmas WHERE id=$id");
//         header("Location: cadastro-turma.php");
//         exit;
//     }
// }
?>
