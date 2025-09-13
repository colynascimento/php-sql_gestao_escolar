function adicionarRegistro(formId, url) {
    const form = document.getElementById(formId);
    const mensagemDiv = document.getElementById('mensagemStatus');
    mensagemDiv.innerHTML = '';

    const formData = new FormData(form);
    const dataToSend = {};

    formData.forEach((value, key) => {
        if (value.trim() !== "") {
            dataToSend[key] = value.trim(); // envia valor preenchido
        } else {
            dataToSend[key] = ""; // envia vazio, PHP tratará como NULL
        }
    });

    fetch(url, {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams(dataToSend)
    })
    .then(response => response.text())
    .then(data => {
        if (!data) data = "Registro processado com sucesso ou falha no servidor.";
        mensagemDiv.innerHTML = `<p style="color:${data.toLowerCase().includes('sucesso') ? 'green' : 'red'}">${data}</p>`;
        if (data.toLowerCase().includes("sucesso")) form.reset();
    })
    .catch(error => {
        mensagemDiv.innerHTML = `<p style="color:red">Erro ao adicionar: ${error}</p>`;
    });
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
