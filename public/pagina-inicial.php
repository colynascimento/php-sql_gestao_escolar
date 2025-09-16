<?php include '../inludes/header.php'; ?>

    <section>
        <table>
            <thead>
                <tr>
                    <th scope='col' colspan='2' class='cor-tabela1'>Turma: </th> <!-- Preencher com nome da turma -->
                    <th scope='col' colspan='2' class='cor-tabela1'></th>
                </tr>
                <tr>
                    <th scope='col' colspan='2' class='cor-tabela1'>Professor: </th> <!-- Preencher com nome do professor -->
                    <th scope='col' colspan='2' class='cor-tabela1'></th>
                </tr>
                <tr>
                    <th scope='col' colspan='2' class='cor-tabela2'>Disciplina: </th> <!-- Preencher com nome da disciplina -->
                    <th scope='col' colspan='2' class='cor-tabela2'>Código da Disciplina: </th> <!-- Preencher com código da disciplina -->
                </tr>
                <tr>
                    <th scope='col' colspan='1' class='cor-tabela2'>Turno: </th>
                    <th scope='col' colspan='1' class='cor-tabela2'></th> <!-- Preencher com turno -->
                    <th scope='col' colspan='1' class='cor-tabela2'>Sala: </th>
                    <th scope='col' colspan='1' class='cor-tabela2'></th> <!-- Preencher com número da sala -->
                </tr>
                <tr>
                    <th scope='col' colspan='1' class='cor-tabela3'>Nome</th>
                    <th scope='col' colspan='1' class='cor-tabela3'>Data de Nascimento</th>
                    <th scope='col' colspan='1' class='cor-tabela3'>CPF</th>
                    <th scope='col' colspan='1' class='cor-tabela3'>Ações</th>
                </tr>
                <tr>
                    <th scope='col' colspan='4'><button id="exibir-ocultar-tabela">Exibir Alunos</button></th>
                </tr>
            </thead>
                <!-- tbody começa vazio, será preenchido pelo JS -->
                <tbody id="corpo-tabela-principal"></tbody>
                        <!-- <a href="editar.php?id=">Editar</a>
                        <a href="excluir.php?id=" onclick="return confirm('Deseja realmente excluir?')">Excluir</a> -->
        </table>
    </section>

    <script src="../js/tabela-dinamica.js"></script>

<?php include '../inludes/footer.php'; ?>