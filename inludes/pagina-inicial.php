<?php include 'header.php'; ?>

    <section>
        <table>
            <thead>
                <tr>
                    <th scope='col' colspan='4'>Turma: </th> <!-- Preencher com nome da turma -->
                </tr>
                <tr>
                    <th scope='col' colspan='4'>Professor: </th> <!-- Preencher com nome do professor -->
                </tr>
                <tr>
                    <th scope='col' colspan='2'>Disciplina: </th> <!-- Preencher com nome da disciplina -->
                    <th scope='col' colspan='2'>Código da Disciplina: </th> <!-- Preencher com código da disciplina -->
                </tr>
                <tr>
                    <th scope='col' colspan='1'>Turno: </th>
                    <th scope='col' colspan='1'></th> <!-- Preencher com turno -->
                    <th scope='col' colspan='1'>Sala: </th>
                    <th scope='col' colspan='1'></th> <!-- Preencher com número da sala -->
                </tr>
                <tr>
                    <th scope='col' colspan='1'>Nome</th>
                    <th scope='col' colspan='1'>Data de Nascimento</th>
                    <th scope='col' colspan='1'>CPF</th>
                    <th scope='col' colspan='1'>Ações</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td scope='row' colspan='1'></td> <!-- Preencher com nome do aluno -->
                    <td scope='row' colspan='1'></td> <!-- Preencher data de nascimento -->
                    <td scope='row' colspan='1'></td> <!-- Preencher CPF -->
                    <td scope='row' colspan='1'>
                        <a href="editar.php?id=">Editar</a> |
                        <a href="excluir.php?id=" onclick="return confirm('Deseja realmente excluir?')">Excluir</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </section>

<?php include 'footer.php'; ?>