function validarFormularioAluno(formId) {
document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("formAluno");
    const cpf = document.getElementById("cpf");
    const nome = document.getElementById("nome");
    const turma = document.getElementById("num_turma");

    form.addEventListener("submit", function(e){
        e.preventDefault();
        console.log("Tentando enviar formulário...");
        console.log("CPF:", cpf.value);  // agora não dará erro
        console.log("Nome:", nome.value);
        console.log("Turma:", turma.value);

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
    })
})
}

