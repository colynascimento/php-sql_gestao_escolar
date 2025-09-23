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
async function salvarProfessor(formId, url, callback = null) {
    console.log('Chegou na função salvarProfessor'); // Log para indicar chamada da função

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
    console.log('Passou pela função salvarProfessor'); // Log indicando conclusão
}

// ================================ Atualiza tabela de professores ================================
// Função para buscar os professores do backend e preencher a tabela HTML
async function atualizarTabelaProfessor() {
    console.log('Chegou na função atualizarTabelaProfessor');

    try {
        const resp = await fetch('/php-sql_gestao_escolar/api/professor/listarProfessor.php');
        const texto = await resp.text(); // Lê o corpo da resposta como texto
        console.log("Resposta bruta do PHP:", texto);

        const professores = JSON.parse(texto); // Converte o texto em JSON
        console.log(professores);

        // Seleciona o tbody da tabela e limpa conteúdo antigo
        const tbody = document.querySelector('#tabelaProfessor tbody');
        tbody.innerHTML = '';

        // Itera sobre cada aluno retornado e cria linhas na tabela
        professores.forEach(professor => {
            const tr = document.createElement('tr');
            console.log('Print professor');

            tr.innerHTML = `
                <td>${professor.cpf}</td> <!-- CPF do professor -->
                <td>${professor.nome}</td> <!-- Nome do professor -->
                <td>${professor.data_nasc}</td> <!-- Data de nascimento -->
                <td>${professor.cod_disc}</td> <!-- cod disciplina -->
                <td>
                    <!-- Botão para editar -->
                    <button onclick="editarProfessor('${professor.cpf}')">Editar</button>
                    <!-- Botão para apagar -->
                    <button onclick="apagarProfessor('${professor.cpf}')">Apagar</button>
                </td>
            `;
            tbody.appendChild(tr); // Adiciona a linha à tabela
        });
    } catch (erro) {
        console.log('Rodando mensagem de erro');
        console.log(erro);
        mostrarMensagem("Erro ao carregar professores", "erro"); // Mostra erro se algo falhar
    }

    console.log('Passou pela função atualizarTabelaProfessor'); // Indica conclusão
}

// ================================ Apaga aluno ================================
// Função para apagar aluno do banco
async function apagarProfessor(cpf) {
    if (!confirm(`Deseja apagar o Professor ${cpf}?`)) return; // Confirmação com o usuário
    const formData = new FormData();
    formData.append('cpf', cpf); // Adiciona o CPF ao formData

    try {
        const resp = await fetch('/php-sql_gestao_escolar/api/professor/apagarProfessor.php', { method: "POST", body: formData });
        const texto = await resp.text();
        mostrarMensagem(texto, texto.toLowerCase().includes("erro") ? "erro" : "sucesso");
        atualizarTabelaProfessor(); // Atualiza a tabela após apagar
    } catch (erro) {
        mostrarMensagem("Erro ao apagar: " + erro.message, "erro");
    }
}

// ================================ Editar ================================
// Função para salvar alterações de um aluno já existente
async function salvarEdicao() {
    const form = document.querySelector('#formEditarProfessor');

    const professor = {
        cpf: form.cpf.value,
        nome: form.nome.value,
        data_nasc: form.data_nasc.value,
        cod_disc: form.cod_disc.value
    };

    try {
        const resp = await fetch('/php-sql_gestao_escolar/api/professor/editarProfessor.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(professor)
        });

        const resultado = await resp.json();

        if (resultado.sucesso) {
            mostrarMensagem("Professor atualizado com sucesso!", "sucesso");
            form.style.display = 'none'; // Oculta o formulário após salvar
            atualizarTabelaProfessor(); // Atualiza tabela com dados novos
        } else {
            mostrarMensagem("Erro ao atualizar professor: " + resultado.erro, "erro");
        }
    } catch (erro) {
        mostrarMensagem("Erro na requisição: " + erro.message, "erro");
    }
}

// ================================ Preenche formulário para edição ================================VERIFICAR
// Função para preencher o formulário de edição com os dados do aluno selecionado
async function editarProfessor(cpf) {
    try {
        const resp = await fetch(`/php-sql_gestao_escolar/api/professor/buscarProfessor.php?cpf=${cpf}`);
        const aluno = await resp.json();
        const dados = Array.isArray(aluno) ? aluno[0] : aluno; // Se retornar array, pega o primeiro item

        const form = document.querySelector('#formEditarProfessor');
        form.style.display = 'block'; // Mostra o formulário

        // Preenche os campos com os dados do aluno
        form.cpf.value = dados.cpf || '';
        form.nome.value = dados.nome || '';
        form.data_nasc.value = dados.data_nasc || '';
        form.cod_disc.value = dados.cod_disc || '';
    } catch (erro) {
        mostrarMensagem("Erro ao carregar professor: " + erro.message, "erro");
    }
}

// ================================ Cancelar edição ================================
// Função para cancelar edição, limpa e oculta o formulário
function cancelarEdicao() {
    const form = document.querySelector('#formEditarProfessor');
    form.style.display = 'none';
    form.reset();
}

// ================================ Inicialização ================================
// Atualiza a tabela automaticamente ao carregar a página
document.addEventListener('DOMContentLoaded', atualizarTabelaProfessor);