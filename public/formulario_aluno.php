<?php
include('../conexao/conexao.php');  // abre a conexão
include('../inludes/header.php');   // cabeçalho
include('../api/exibir.php');
include('../api/adicionar.php');
?>

<form action="" method="POST">
    <h2>Cadastrar alunos</h2>

    <label for="CPF_aluno">CFP do aluno</label>
    <input type="number" name="CPF_aluno" placeholder="ex:1234567891011" required>

    <label for="nome_aluno">Nome do aluno</label>
    <input type="string" name="nome_aluno" placeholder="ex:Luiz Inacio Lula da Silva" required>

    <label for="data_nascimento">Data de nascimento</label>
    <input type="date" name="data_nascimento"required>

    <label for="num_turma">Numero da turma</label>
    <input type="number" name="num_turma" required>


    <div id="btn-container">
        <button type="submit">Mandar formulario</button>
    </div>
</form> 

<?php
adicionarTabela($conn, "alunos",$colunas,$valores);
listarTabela($conn,"alunos");
include('../inludes/footer.php');
?>
