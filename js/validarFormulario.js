function validarFormularioAluno(formId) {
    const form = document.getElementById(formId);
    const cpf = form.querySelector("[name='cpf']").value.trim();
    const nome = form.querySelector("[name='nome']").value.trim();
    const nascimento = form.querySelector("[name='data_nascimento']").value.trim();
    const turma = form.querySelector("[name='turma']").value;

    if (!/^\d{11}$/.test(cpf)) {
        mostrarMensagem("CPF deve conter exatamente 11 números.", "erro");
        return false;
    }

    if (nome.length < 3) {
        mostrarMensagem("Nome deve ter pelo menos 3 caracteres.", "erro");
        return false;
    }

    if (!nascimento) {
        mostrarMensagem("Informe a data de nascimento.", "erro");
        return false;
    }

    if (!turma) {
        mostrarMensagem("Selecione uma turma para o aluno.", "erro");
        return false;
    }

    return true;
}
