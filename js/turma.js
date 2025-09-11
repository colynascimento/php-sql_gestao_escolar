// função para enviar os dados para o PHP
async function cadastrarTurma(dados, msgX){
    const resposta = await fetch("../api/turma/adicionar.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(dados)
    }
    );

    const resultado = await resposta.json();

    if (resultado.sucesso) {
        msgX.innerText = "Turma cadastrada com sucesso!";
        document.getElementById("cadTurma").reset();
    }else{
        msgX.innerText = "Erro: "+ resultado.erro;
    }
    };
// inicializando a tela de cadastro
function inicializaCadastroTurma(){
    const btn = document.getElementById("btnCadTurma");
    const msg = document.getElementById("msg");

    btn.onclick = async() => {
        const num_turma = document.getElementById("num_turma").value.trim();
        const nomeTurma = document.getElementById("nomeTurma").value.trim();
        const turno = document.getElementById("turno").value.trim();
        const sala = document.getElementById("sala").value.trim();

        //validar de novo?

        await cadastrarTurma({num_turma, nomeTurma, turno, sala}, msg);
    };
}
document.addEventListener("DOMContentLoaded", inicializaCadastroTurma);