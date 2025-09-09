<?php
include('../inludes/header.php');
?>

<form action="" method="POST">
    <h2>Cadastrar alunos</h2>

    <label for="CPF_aluno">CFP do aluno</label>
    <input type="number" name="CPF_aluno" placeholder="1234567891011 (exemplo)" min="11" max="11" required>

    <label for="nome_aluno">Nome do aluno</label>
    <input type="string" name="nome_aluno" placeholder="Luiz Inacio Lula da Silva (exemplo)" required>

    <label for="data_nascimento">Data de nascimento</label>
    <input type="date" name="data_nascimento" placeholder="1234567891011 (exemplo)" min="11" max="11" required>

    <label for="num_turma">Numero da turma</label>
    <input type="number" name="num_turma" required>


    <div id="btn-container">
        <button type="submit">Mandar formulario</button>
    </div>
</form> 

<?php
include('exibir.php');
listarTabela()
include('../inludes/footer.php');
?>
