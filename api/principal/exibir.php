<?php
    include('../conexao/conexao.php');

    function listarTurmas($conn) {
        $sql = "SELECT 
                    turmas.num_turma AS num_turma,
                    turmas.nome AS nome_turma,
                    turmas.turno AS turno,
                    turmas.sala AS sala,
                    professores.nome AS professor,
                    disciplinas.cod_disc AS cod_disc,
                    disciplinas.nome_disciplina AS disciplina
                    FROM turmas
                    JOIN turma_disciplina ON turmas.num_turma = turma_disciplina.num_turma
                    JOIN disciplinas ON turma_disciplina.cod_disc = disciplinas.cod_disc
                    JOIN professor_disciplina ON disciplinas.cod_disc = professor_disciplina.cod_disc
                    JOIN professores ON professor_disciplina.cpf = professores.cpf
                    ORDER BY turmas.num_turma";

        $resultado = $conn->query($sql);

        if ($resultado->num_rows > 0) {
            echo "<h2>Lista de Turmas</h2>";

            // Para cada turma encontrada, cria uma tabela separada
            while ($turma = $resultado->fetch_assoc()) {
                echo "<table><thead>";
                echo "<tr>
                        <th scope='col' colspan='4' class='cor-tabela1'>Turma: " . $turma['nome_turma'] . "</th>
                    </tr>
                    <tr>
                        <th scope='col' colspan='4' class='cor-tabela1'>Professor: " . $turma['professor'] . "</th>
                    </tr>
                    <tr>
                        <th scope='col' colspan='2' class='cor-tabela2'>Disciplina: " . $turma['disciplina'] . "</th>
                        <th scope='col' colspan='2' class='cor-tabela2'>Código da Disciplina: " . $turma['cod_disc'] . "</th>
                    </tr>
                    <tr>
                        <th scope='col' colspan='2' class='cor-tabela2'>Turno: " . $turma['turno'] . "</th>
                        <th scope='col' colspan='2' class='cor-tabela2'>Sala: " . $turma['sala'] . "</th>
                    </tr>
                    <tr>
                        <th scope='col' colspan='1' class='cor-tabela3'>Nome</th>
                        <th scope='col' colspan='1' class='cor-tabela3'>Data de Nascimento</th>
                        <th scope='col' colspan='1' class='cor-tabela3'>CPF</th>
                        <th scope='col' colspan='1' class='cor-tabela3'>Ações</th>
                    </tr>
                    <tr>
                        <th scope='col' colspan='4'><button class='exibir-ocultar-tabela'>Exibir Alunos</button></th>
                    </tr>";


                echo "</thead>";

                // Exibir os alunos da turma (supondo tabela `alunos` com coluna turma_id)
                $sqlAlunos = "SELECT nome, cpf, data_nasc FROM alunos WHERE num_turma = " . $turma['num_turma'];
                $resAlunos = $conn->query($sqlAlunos);

                if ($resAlunos->num_rows > 0) {
                    echo "<tbody class='corpo-tabela-principal'>";
                    while ($aluno = $resAlunos->fetch_assoc()) {
                        echo "<tr>
                                <th scope='row' colspan='1'>" . $aluno['nome'] . "</tr>
                                <th scope='row' colspan='1'>" . $aluno['data_nasc'] . "</tr>
                                <th scope='row' colspan='1'>" . $aluno['cpf'] . "</tr>
                                <th scope='row' colspan='1'><a href='editar.php?id='>Editar</a><a href='excluir.php?id=' onclick='return confirm('Deseja realmente excluir?')'>Excluir</a></th>
                            </tr>";
                    }
                    echo "</tbody></table>";
                } else {
                    echo "<tbody>";
                    echo "<tr><th scope='row' colspan='4'>Nenhum aluno cadastrado nessa turma.</th></tr>";
                    echo "</tbody>";
                }

                echo "<hr>";
            }
        } else {
            echo "<p>Nenhuma turma cadastrada.</p>";
        }
    }

    listarTurmas($conn)

?>

