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
async function salvarDisciplina(formId, url, callback = null) {
    console.log('Chegou na função salvarDisciplina'); // Log para indicar chamada da função

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
        console.log(erro); // Log indicando conclusão
        mostrarMensagem("Erro: " + erro.message, "erro"); // Captura erro de requisição
    }
    console.log('Passou pela função salvarDisciplina'); // Log indicando conclusão
}

// ================================ Atualiza tabela de alunos ================================
// Função para buscar os alunos do backend e preencher a tabela HTML
async function atualizarTabelaDisciplina() {
    console.log('Chegou na função atualizarTabelaDisciplina');

    try {
        const resp = await fetch('/php-sql_gestao_escolar/api/Disciplina/listarDisciplina.php');
        const texto = await resp.text(); // Lê o corpo da resposta como texto
        console.log("Resposta bruta do PHP:", texto);

        const Disciplinas = JSON.parse(texto); // Converte o texto em JSON
        console.log(Disciplinas);

        // Seleciona o tbody da tabela e limpa conteúdo antigo
        const tbody = document.querySelector('#tabelaDisciplinas tbody');
        tbody.innerHTML = '';

        // Itera sobre cada aluno retornado e cria linhas na tabela
        Disciplinas.forEach(Disciplina => {
            const tr = document.createElement('tr');
            console.log('Print Disciplina');

            tr.innerHTML = `
                <td>${Disciplina.cod_disc}</td> <!-- CPF do Disciplina -->
                <td>${Disciplina.nome_disciplina}</td> <!-- Nome do Disciplina -->
                <td>${Disciplina.carga_horaria}</td> <!-- Data de nascimento -->
                <td>
                    <!-- Botão para editar -->
                    <button onclick="editarDisciplina('${Disciplina.cod_disc}')">Editar</button>
                    <!-- Botão para apagar -->
                    <button onclick="apagarDisciplina('${Disciplina.cod_disc}')">Apagar</button>
                </td>
            `;
            tbody.appendChild(tr); // Adiciona a linha à tabela
        });
    } catch (erro) {
        console.log('Rodando mensagem de erro');
        console.log(erro);
        mostrarMensagem("Erro ao carregar Disciplinas", "erro"); // Mostra erro se algo falhar
    }

    console.log('Passou pela função atualizarTabelaDisciplina'); // Indica conclusão
}

// ================================ Apaga aluno ================================
// Função para apagar aluno do banco
async function apagarDisciplina(cpf) {
    if (!confirm(`Deseja apagar o Disciplina ${cpf}?`)) return; // Confirmação com o usuário
    const formData = new FormData();
    formData.append('cpf', cpf); // Adiciona o CPF ao formData

    try {
        const resp = await fetch('/php-sql_gestao_escolar/api/Disciplina/apagarDisciplina.php', { method: "POST", body: formData });
        const texto = await resp.text();
        mostrarMensagem(texto, texto.toLowerCase().includes("erro") ? "erro" : "sucesso");
        atualizarTabelaDisciplina(); // Atualiza a tabela após apagar
    } catch (erro) {
        mostrarMensagem("Erro ao apagar: " + erro.message, "erro");
    }
}

// ================================ Editar ================================
// Função para salvar alterações de um aluno já existente
async function salvarEdicao() {
    const form = document.querySelector('#formEditarDisciplina');

    const Disciplina = {
        cpf: form.cpf.value,
        nome: form.nome.value,
        data_nasc: form.data_nasc.value,
        titulo: form.titulo.value
    };

    try {
        const resp = await fetch('/php-sql_gestao_escolar/api/Disciplina/editarDisciplina.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(Disciplina)
        });

        const resultado = await resp.json();

        if (resultado.sucesso) {
            mostrarMensagem("Disciplina atualizado com sucesso!", "sucesso");
            form.style.display = 'none'; // Oculta o formulário após salvar
            atualizarTabelaDisciplina(); // Atualiza tabela com dados novos
        } else {
            mostrarMensagem("Erro ao atualizar Disciplina: " + resultado.erro, "erro");
        }
    } catch (erro) {
        mostrarMensagem("Erro na requisição: " + erro.message, "erro");
    }
}

// ================================ Preenche formulário para edição ================================
// Função para preencher o formulário de edição com os dados do aluno selecionado
async function editarDisciplina(cpf) {
    try {
        const resp = await fetch(`/php-sql_gestao_escolar/api/Disciplina/buscarDisciplina.php?cpf=${cpf}`);
        const aluno = await resp.json();
        const dados = Array.isArray(aluno) ? aluno[0] : aluno; // Se retornar array, pega o primeiro item

        const form = document.querySelector('#formEditarDisciplina');
        form.style.display = 'block'; // Mostra o formulário

        // Preenche os campos com os dados do aluno
        form.cpf.value = dados.cpf || '';
        form.nome.value = dados.nome || '';
        form.data_nasc.value = dados.data_nasc || '';
        form.titulo.value = dados.titulo || '';
    } catch (erro) {
        mostrarMensagem("Erro ao carregar Disciplina: " + erro.message, "erro");
    }
}

// ================================ Cancelar edição ================================
// Função para cancelar edição, limpa e oculta o formulário
function cancelarEdicao() {
    const form = document.querySelector('#formEditarDisciplina');
    form.style.display = 'none';
    form.reset();
}

// ================================ Inicialização ================================
// Atualiza a tabela automaticamente ao carregar a página
document.addEventListener('DOMContentLoaded', atualizarTabelaDisciplina);