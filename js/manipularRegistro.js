// ================================ Exibe mensagens no HTML ================================
// Função que mostra uma mensagem na div #mensagem
// 'texto' é o conteúdo da mensagem, 'tipo' define a cor: sucesso (verde) ou erro (vermelho)
function mostrarMensagem(texto, tipo) {
    const div = document.getElementById('mensagem');
    if (!div) return; // Se a div não existir, não faz nada
    div.textContent = texto;
    div.style.color = tipo === "sucesso" ? "green" : "red";
}

// ================================ Adiciona ================================
// Função para cadastrar um aluno via AJAX
async function salvarAluno(formId, url, callback = null) {
    console.log('Chegou na função salvarAluno'); // Log para indicar chamada da função

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
    
    console.log('Passou pela função salvarAluno'); // Log indicando conclusão
}

// ================================ Atualiza tabela de alunos ================================
// Função para buscar os alunos do backend e preencher a tabela HTML
async function atualizarTabelaAlunos() {
    console.log('Chegou na função atualizarTabelaAlunos');

    try {
        const resp = await fetch('/php-sql_gestao_escolar/api/aluno/listarAlunos.php');
        const texto = await resp.text(); // Lê o corpo da resposta como texto
        console.log("Resposta bruta do PHP:", texto);

        const alunos = JSON.parse(texto); // Converte o texto em JSON
        console.log(alunos);

        // Seleciona o tbody da tabela e limpa conteúdo antigo
        const tbody = document.querySelector('#tabelaAlunos tbody');
        tbody.innerHTML = '';

        // Itera sobre cada aluno retornado e cria linhas na tabela
        alunos.forEach(aluno => {
            const tr = document.createElement('tr');
            console.log('Print aluno');

            tr.innerHTML = `
                <td>${aluno.cpf}</td> <!-- CPF do aluno -->
                <td>${aluno.nome}</td> <!-- Nome do aluno -->
                <td>${aluno.data_nasc}</td> <!-- Data de nascimento -->
                <td>${aluno.num_turma}</td> <!-- Número da turma -->
                <td>
                    <!-- Botão para editar -->
                    <button onclick="editarAluno('${aluno.cpf}')">Editar</button>
                    <!-- Botão para apagar -->
                    <button onclick="apagarAluno('${aluno.cpf}')">Apagar</button>
                </td>
            `;
            tbody.appendChild(tr); // Adiciona a linha à tabela
        });
    } catch (erro) {
        console.log('Rodando mensagem de erro');
        mostrarMensagem("Erro ao carregar alunos", "erro"); // Mostra erro se algo falhar
    }

    console.log('Passou pela função atualizarTabelaAlunos'); // Indica conclusão
}

// ================================ Apaga aluno ================================
// Função para apagar aluno do banco
async function apagarAluno(cpf) {
    if (!confirm(`Deseja apagar o aluno ${cpf}?`)) return; // Confirmação com o usuário
    const formData = new FormData();
    formData.append('cpf', cpf); // Adiciona o CPF ao formData

    try {
        const resp = await fetch('/php-sql_gestao_escolar/api/aluno/apagarAluno.php', { method: "POST", body: formData });
        const texto = await resp.text();
        mostrarMensagem(texto, texto.toLowerCase().includes("erro") ? "erro" : "sucesso");
        atualizarTabelaAlunos(); // Atualiza a tabela após apagar
    } catch (erro) {
        mostrarMensagem("Erro ao apagar: " + erro.message, "erro");
    }
}

// ================================ Editar ================================
// Função para salvar alterações de um aluno já existente
async function salvarEdicao() {
    const form = document.querySelector('#formEditarAluno');

    const aluno = {
        cpf: form.cpf.value,
        nome: form.nome.value,
        data_nasc: form.data_nasc.value,
        num_turma: form.num_turma.value
    };

    try {
        const resp = await fetch('/php-sql_gestao_escolar/api/aluno/editarAluno.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(aluno)
        });

        const resultado = await resp.json();

        if (resultado.sucesso) {
            mostrarMensagem("Aluno atualizado com sucesso!", "sucesso");
            form.style.display = 'none'; // Oculta o formulário após salvar
            atualizarTabelaAlunos(); // Atualiza tabela com dados novos
        } else {
            mostrarMensagem("Erro ao atualizar aluno: " + resultado.erro, "erro");
        }
    } catch (erro) {
        mostrarMensagem("Erro na requisição: " + erro.message, "erro");
    }
}

// ================================ Preenche formulário para edição ================================
// Função para preencher o formulário de edição com os dados do aluno selecionado
async function editarAluno(cpf) {
    try {
        const resp = await fetch(`/php-sql_gestao_escolar/api/aluno/buscarAluno.php?cpf=${cpf}`);
        const aluno = await resp.json();
        const dados = Array.isArray(aluno) ? aluno[0] : aluno; // Se retornar array, pega o primeiro item

        const form = document.querySelector('#formEditarAluno');
        form.style.display = 'block'; // Mostra o formulário

        // Preenche os campos com os dados do aluno
        form.cpf.value = dados.cpf || '';
        form.nome.value = dados.nome || '';
        form.data_nasc.value = dados.data_nasc || '';
        form.num_turma.value = dados.num_turma || '';
    } catch (erro) {
        mostrarMensagem("Erro ao carregar aluno: " + erro.message, "erro");
    }
}

// ================================ Cancelar edição ================================
// Função para cancelar edição, limpa e oculta o formulário
function cancelarEdicao() {
    const form = document.querySelector('#formEditarAluno');
    form.style.display = 'none';
    form.reset();
}

// ================================ Inicialização ================================
// Atualiza a tabela automaticamente ao carregar a página
document.addEventListener('DOMContentLoaded', atualizarTabelaAlunos);