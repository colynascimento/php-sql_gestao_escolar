function validarFormularioAluno(formId) {
    const form = document.getElementById(formId);
    const cpf = form.querySelector("[name='cpf']").value;
    const nome = form.querySelector("[name='nome']").value;
    const nascimento = form.querySelector("[name='data_nascimento']").value;

    if (!/^\d{11}$/.test(cpf)) {
        alert("CPF deve conter exatamente 11 números.");
        return false;
    }

    if (nome.trim().length < 3) {
        alert("Nome deve ter pelo menos 3 caracteres.");
        return false;
    }

    if (!nascimento) {
        alert("Informe a data de nascimento.");
        return false;
    }

    // turma opcional
    return true;
}

// exporta globalmente
window.validarFormularioAluno = validarFormularioAluno;
