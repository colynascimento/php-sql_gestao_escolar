// ================================ Exibe mensagens no HTML ================================
function mostrarMensagem(texto, tipo) {
    const div = document.getElementById('mensagem');
    if (!div) return;
    div.textContent = texto;
    div.style.color = tipo === "sucesso" ? "green" : "red";
}

// ================================ Adiciona ================================
async function salvarAluno(formId, url, callback = null) {
    console.log('Chegou na função salvarAluno') // Log para indicar que a função foi chamada

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
    
    console.log('Passou pela função salvarAluno') // Log indicando que a função foi concluída
}

// ================================ Atualiza tabela de alunos ================================
async function atualizarTabelaAlunos() {
    console.log('Chegou na função atualizarTabelaAlunos') // Log para indicar que a função foi chamada

    try {
        const resp = await fetch('/php-sql_gestao_escolar/api/aluno/listarAlunos.php');
        const texto = await resp.text(); // lê o corpo como texto
        console.log("Resposta bruta do PHP:", texto);

        // Converte manualmente o texto para JSON
        const alunos = JSON.parse(texto); 
        console.log(alunos);


        // Seleciona o corpo da tabela onde os dados dos alunos serão exibidos
        const tbody = document.querySelector('#tabelaAlunos tbody');
        // Limpa qualquer conteúdo anterior da tabela, para evitar duplicações
        tbody.innerHTML = '';

        // Itera sobre cada aluno retornado do backend
        alunos.forEach(aluno => {
            
            // Cria uma nova linha da tabela
            const tr = document.createElement('tr');
            
            // Define as colunas da linha com os dados do aluno e botões de ação
            console.log('Print aluno') // Log para cada aluno encontrado
            tr.innerHTML =
            `
                <td>${aluno.cpf}</td> <!-- Exibe o CPF -->
                <td>${aluno.nome}</td> <!-- Exibe o Nome -->
                <td>${aluno.data_nasc}</td> <!-- Exibe a Data de Nascimento -->
                <td>${aluno.num_turma}</td> <!-- Exibe a Turma -->
                <td>
                    <!-- Botão para editar o aluno, chamando a função editarAluno -->
                    <button onclick="editarAluno('${aluno.cpf}')">Editar</button>

                    <!-- Botão para apagar o aluno, chamando a função apagarAluno -->
                    <button onclick="apagarAluno('${aluno.cpf}')">Apagar</button>
                </td>
            `;
            // Adiciona a linha criada dentro do corpo da tabela
            tbody.appendChild(tr);
        });
    } catch (erro) {
        console.log('Rodando mensagem de erro')
        // Caso haja erro na requisição ou processamento, exibe mensagem ao usuário
        mostrarMensagem("Erro ao carregar alunos", "erro");
    }

    console.log('Passou pela função atualizarTabelaAlunos') // Log indicando que a função foi concluída
}

// ================================ Apaga aluno ================================
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

// ================================ Editar ================================
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
            form.style.display = 'none';
            atualizarTabelaAlunos(); // atualiza tabela com dados novos
        } else {
            mostrarMensagem("Erro ao atualizar aluno: " + resultado.erro, "erro");
        }
    } catch (erro) {
        mostrarMensagem("Erro na requisição: " + erro.message, "erro");
    }
}

// ================================ Preenche formulário para edição ================================
async function editarAluno(cpf) {
    try {
        const resp = await fetch(`/php-sql_gestao_escolar/api/aluno/buscarAluno.php?cpf=${cpf}`);
        const aluno = await resp.json();
        const dados = Array.isArray(aluno) ? aluno[0] : aluno;

        const form = document.querySelector('#formEditarAluno');
        form.style.display = 'block'; // mostra o formulário

        form.cpf.value = dados.cpf || '';
        form.nome.value = dados.nome || '';
        form.data_nasc.value = dados.data_nasc || '';
        form.num_turma.value = dados.num_turma || '';
    } catch (erro) {
        mostrarMensagem("Erro ao carregar aluno: " + erro.message, "erro");
    }
}

// Botão cancelar
function cancelarEdicao() {
    const form = document.querySelector('#formEditarAluno');
    form.style.display = 'none';
    form.reset();
}


// Inicializa tabela ao carregar página
document.addEventListener('DOMContentLoaded', atualizarTabelaAlunos);
