function validarFormularioAluno(formId) {
    console.log("Função validarFormularioAluno chamada");

    const form = document.getElementById(formId);
    if (!form) {
        console.log("Formulário não encontrado");
        return false;
    }

    const cpf = form.querySelector('#cpf').value.trim();
    const nome = form.querySelector('#nome').value.trim();
    const dataNascimento = form.querySelector('#data_nascimento').value.trim();
    const turma = form.querySelector('#num_turma').value.trim();

    console.log("Valores capturados:", { cpf, nome, dataNascimento, turma });

    if (!cpf || !nome || !dataNascimento || !turma) {
        alert("Todos os campos são obrigatórios!");
        console.log("Passou pela validação de campos");
        return false;
    }

    if (cpf.length !== 11 || isNaN(cpf)) {
        alert("CPF deve conter 11 números.");
        console.log("Passou pela validação de CPF");
        return false;
    }

    return true; // passou na validação
}
