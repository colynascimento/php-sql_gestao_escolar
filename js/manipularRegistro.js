// ================================ Exibe mensagens no HTML ================================
function mostrarMensagem(texto, tipo) {
    const div = document.getElementById('mensagem');
    if (!div) return;
    div.textContent = texto;
    div.style.color = tipo === "sucesso" ? "green" : "red";
}

// ================================ Adiciona ou edita aluno ================================
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

// ================================ Preenche formulário para edição ================================
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
