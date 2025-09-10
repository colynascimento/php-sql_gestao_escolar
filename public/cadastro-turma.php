<?php
include("../conexao/conexao.php");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro-Turmas</title>
    <link rel = "stylesheet" href = "../css/style.css">
</head>
<body>
    <h1>Cadastro de Turmas </h1>
    <form id="cadTurma" method = "POST" action = "">
        <label>Numero da turma: </label>
        <input type = "number" id = "num_turma" name = "num_turma" required>
        <label>Nome da turma: </label>
        <input type = "text" id = "nomeTurma" name = "nomeTurma" required>
        <label>Turno: </label>
        <select name = "turno" id = "turno" required>
            <option value = ""disabled selected>Selecione</option>
            <option value = "manha">Manhã</option>
            <option value = "tarde">Tarde</option>
            <option value = "noite">Noite</option>
        </select>
        <label>Sala:</label>
        <input type = "text" id = "sala" name = "sala" required>
        <button type="button" name="btnCadTurma" id="btnCadTurma" >Cadastrar</button>
        
        <div id = "msg"></div>

    </form>
<script>
    // java script depóis modulariza
    document.getElementById("btnCadTurma").onclick = async () =>{
        const num_turma = document.getElementById("num_turma").value.trim();
        const nomeTurma = document.getElementById("nomeTurma").value.trim();
        const turno = document.getElementById("turno").value.trim();
        const sala = document.getElementById("sala").value.trim();

    //ver se vai validar de novo a questão do tipo e campos vazios

    // enviando para PHP

      const resposta = await fetch("../api/turma/adicionar.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({
          num_turma,
          nomeTurma,
          turno,
          sala
        })
      });

      const resultado = await resposta.json();

      if (resultado.sucesso) {
        document.getElementById("msg").innerText = "✅ Turma cadastrada com sucesso!";
        document.getElementById("num_turma").value = "";
        document.getElementById("nomeTurma").value = "";
        document.getElementById("turno").value = "";
        document.getElementById("sala").value = "";
      } else {
        document.getElementById("msg").innerText = "❌ Erro: " + resultado.erro;
      }
    };
        

</script>

</body>
</html>


