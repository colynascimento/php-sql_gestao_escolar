// função para enviar os dados para o PHP
async function cadastrarDisciplina(dados, msgX){
    const resposta = await fetch("../api/disciplina/adicionar_disc.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(dados)
    }
    );

    const resultado = await resposta.json();

    if (resultado.sucesso) {
        msgX.innerText = "Disciplina cadastrada com sucesso!";
        document.getElementById("cadDisciplina").reset();
    }else{
        msgX.innerText = "Erro: "+ resultado.erro;
    }
    };
// inicializando a tela de cadastro
function inicializaCadastroDisciplina(){
    const btn = document.getElementById("btnCadDisciplina");
    const msg = document.getElementById("msg");

    btn.onclick = async() => {
        const cod_disc = document.getElementById("cod_disc").value.trim();
        const nomeDisc = document.getElementById("nomeDisc").value.trim();
        const cargaHora = document.getElementById("cargaHora").value.trim();

        //validar de novo?

        await cadastrarDisciplina({cod_disc, nomeDisc, cargaHora}, msg);
    };
}
document.addEventListener("DOMContentLoaded", inicializaCadastroDisciplina);