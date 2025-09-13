async function adicionarRegistro(formId, url) {
    const form = document.getElementById(formId);
    const formData = new FormData(form);

    try {
        const resposta = await fetch(url, {
            method: "POST",
            body: formData
        });

        const texto = await resposta.text();
        mostrarMensagem(texto, "sucesso");

        // recarrega a página para atualizar a tabela
        setTimeout(() => location.reload(), 1500);
    } catch (erro) {
        mostrarMensagem("Erro ao cadastrar aluno: " + erro.message, "erro");
    }
}

function mostrarMensagem(msg, tipo) {
    const div = document.getElementById("mensagemStatus");
    div.innerHTML = msg;
    div.style.color = tipo === "erro" ? "red" : "green";
}

function apagarRegistro(tabela, campoPK) {
    const valorPK = prompt(`Digite o valor de ${campoPK} para apagar:`);
    const mensagemDiv = document.getElementById('mensagemStatus');
    mensagemDiv.innerHTML = '';

    if (!valorPK) return;

    fetch('../api/apagar.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `tabela=${tabela}&campoPK=${campoPK}&valorPK=${encodeURIComponent(valorPK)}`
    })
    .then(response => response.text())
    .then(data => {
        if (!data) data = "Registro processado.";
        mensagemDiv.innerHTML = `<p style="color:${data.toLowerCase().includes('sucesso') ? 'green' : 'red'}">${data}</p>`;
        if (data.toLowerCase().includes("sucesso")) location.reload();
    })
    .catch(error => {
        mensagemDiv.innerHTML = `<p style="color:red">Erro ao apagar: ${error}</p>`;
    });
}

window.adicionarRegistro = adicionarRegistro;
window.apagarRegistro = apagarRegistro;
