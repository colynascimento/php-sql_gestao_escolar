function mostrarMensagem(texto, tipo) {
    const div = document.getElementById('mensagem');
    if (!div) return; // Se a div não existir, não faz nada
    div.textContent = texto;
    div.style.color = tipo === "sucesso" ? "green" : "red";
}

async function salvarTurma(formId, url, callback = null) {
    const form = document.getElementById(formId);
    if (!form) return mostrarMensagem("Formulário não encontrado!", "erro");

    const formData = new FormData(form); // Captura os dados do formulário

    try {
        // Envia os dados via POST para o backend
        const resposta = await fetch(url, { method: "POST", body: formData });
        const texto = await resposta.text();
        
        // Mostra mensagem de sucesso ou erro dependendo do retorno
        mostrarMensagem(texto, texto.toLowerCase().includes("erro") ? "erro" : "sucesso");

        if (!texto.toLowerCase().includes("erro")) {
            form.reset(); // Limpa o formulário após sucesso
            if (callback) callback(); // Chama função de callback se fornecida (ex.: atualizar tabela)
        }
    } catch (erro) {
        mostrarMensagem("Erro: " + erro.message, "erro"); // Captura erro de requisição
    }
}

async function atualizarTabelaTurmas() {
    try {
        const resp = await fetch('/php-sql_gestao_escolar/api/turma/exibir.php');
        const texto = await resp.text();

        const turmas = JSON.parse(texto); // Converte o texto em JSON

        const tbody = document.querySelector('#tabelaTurmas tbody');
        tbody.innerHTML = '';

        // Itera sobre cada turma retornada e cria linhas na tabela
        turmas.forEach(turma => {
            const tr = document.createElement('tr');

            tr.innerHTML = `
                <td>${turma.num_turma}</td>
                <td>${turma.nome}</td>
                <td>${turma.turno}</td>
                <td>${turma.sala}</td>
                <td>
                    <button onclick="editarTurma('${turma.num_turma}')">Editar</button>
                    <button onclick="apagarTurma('${turma.num_turma}')">Apagar</button>
                </td>
            `;
            tbody.appendChild(tr); // Adiciona a linha à tabela
        });
    } catch (erro) {
        console.log('Rodando mensagem de erro');
        mostrarMensagem("Erro ao carregar turmas", "erro");
    }
}

async function apagarTurma(num_turma) {
    if (!confirm(`Deseja apagar a turma ${num_turma}?`)) return; // Confirmação com o usuário
    const formData = new FormData();
    formData.append('num_turma', num_turma); // Adiciona o CPF ao formData

    try {
        const resp = await fetch('/php-sql_gestao_escolar/api/turma/apagar.php', { method: "POST", body: formData });
        const texto = await resp.text();
        mostrarMensagem(texto, texto.toLowerCase().includes("erro") ? "erro" : "sucesso");
        atualizarTabelaAlunos(); // Atualiza a tabela após apagar
    } catch (erro) {
        mostrarMensagem("Erro ao apagar: " + erro.message, "erro");
    }
}

async function salvarEdicao() {
    const form = document.querySelector('#formEditarTurma');

    const turma = {
        num_turma: form.num_turma.value,
        nome: form.nome.value,
        turno: form.turno.value,
        sala: form.sala.value
    };

    try {
        const resp = await fetch('/php-sql_gestao_escolar/api/turma/editar.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(turma)
        });

        const resultado = await resp.json();

        if (resultado.sucesso) {
            mostrarMensagem("Turma atualizada com sucesso!", "sucesso");
            form.style.display = 'none'; // Oculta o formulário após salvar
            atualizarTabelaTurmas(); // Atualiza tabela com dados novos
        } else {
            mostrarMensagem("Erro ao atualizar turma: " + resultado.erro, "erro");
        }
    } catch (erro) {
        mostrarMensagem("Erro na requisição: " + erro.message, "erro");
    }
}

async function editarTurma(num_turma) {
    try {
        const resp = await fetch(`/php-sql_gestao_escolar/api/turma/buscar.php?num_turma=${num_turma}`);
        const turma = await resp.json();
        const dados = Array.isArray(turma) ? turma[0] : turma;

        const form = document.querySelector('#formEditarTurma');
        form.style.display = 'block'; // Mostra o formulário

        form.num_turma.value = dados.num_turma || '';
        form.nome.value = dados.nome || '';
        form.turno.value = dados.turno || '';
        form.sala.value = dados.sala || '';
    } catch (erro) {
        mostrarMensagem("Erro ao carregar turma: " + erro.message, "erro");
    }
}

function cancelarEdicao() {
    const form = document.querySelector('#formEditarTurma');
    form.style.display = 'none';
    form.reset();
}

document.addEventListener('DOMContentLoaded', atualizarTabelaTurmas);