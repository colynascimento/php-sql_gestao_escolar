// Exibe mensagens no HTML
function mostrarMensagem(texto, tipo) {
    const div = document.getElementById('mensagem');
    if (!div) return;
    div.textContent = texto;
    div.style.color = tipo === "sucesso" ? "green" : "red";
}

// Adiciona ou edita aluno
async function salvarAluno(formId, url, callback = null) {
    const form = document.getElementById(formId);
    if (!form) return mostrarMensagem("Formulário não encontrado!", "erro");

    const formData = new FormData(form);

    try {
        const resposta = await fetch(url, { method: "POST", body: formData });
        const texto = await resposta.text();
        mostrarMensagem(texto, texto.toLowerCase().includes("erro") ? "erro" : "sucesso");

        if (!texto.toLowerCase().includes("erro")) {
            form.reset();
            if (callback) callback();
        }
    } catch (erro) {
        mostrarMensagem("Erro: " + erro.message, "erro");
    }
}

// Atualiza tabela de alunos
async function atualizarTabelaAlunos() {
    try {
        const resp = await fetch('/php-sql_gestao_escolar/api/aluno/listarAlunos.php');
        const alunos = await resp.json();
        const tbody = document.querySelector('#tabelaAlunos tbody');
        tbody.innerHTML = '';

        alunos.forEach(aluno => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td>${aluno.cpf}</td>
                <td>${aluno.nome}</td>
                <td>${aluno.data_nascimento}</td>
                <td>${aluno.num_turma}</td>
                <td>
                    <button onclick="editarAluno('${aluno.cpf}')">Editar</button>
                    <button onclick="apagarAluno('${aluno.cpf}')">Apagar</button>
                </td>
            `;
            tbody.appendChild(tr);
        });
    } catch (erro) {
        mostrarMensagem("Erro ao carregar alunos", "erro");
    }
}

// Apaga aluno
async function apagarAluno(cpf) {
    if (!confirm(`Deseja apagar o aluno ${cpf}?`)) return;
    const formData = new FormData();
    formData.append('cpf', cpf);

    try {
        const resp = await fetch('/php-sql_gestao_escolar/api/aluno/apagarAluno.php', { method: "POST", body: formData });
        const texto = await resp.text();
        mostrarMensagem(texto, texto.toLowerCase().includes("erro") ? "erro" : "sucesso");
        atualizarTabelaAlunos();
    } catch (erro) {
        mostrarMensagem("Erro ao apagar: " + erro.message, "erro");
    }
}

// Preenche formulário para edição
async function editarAluno(cpf) {
    try {
        const resp = await fetch(`/php-sql_gestao_escolar/api/aluno/buscarAluno.php?cpf=${cpf}`);
        const aluno = await resp.json();

        document.querySelector('#formAluno input[name="cpf"]').value = aluno.cpf;
        document.querySelector('#formAluno input[name="nome"]').value = aluno.nome;
        document.querySelector('#formAluno input[name="data_nascimento"]').value = aluno.data_nascimento;
        document.querySelector('#formAluno input[name="num_turma"]').value = aluno.num_turma;
    } catch (erro) {
        mostrarMensagem("Erro ao carregar aluno: " + erro.message, "erro");
    }
}

// Inicializa tabela ao carregar página
document.addEventListener('DOMContentLoaded', atualizarTabelaAlunos);
