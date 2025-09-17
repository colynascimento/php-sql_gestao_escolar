async function alternarTabela(btn) {
    const tabela = btn.closest('table');
    const tbody = tabela.querySelector('tbody');

    if (!tbody) return; 

    if (tbody.style.display === 'none' || tbody.style.display === '') {
      tbody.style.display = 'table-row-group';
      btn.innerText = 'Ocultar Alunos';
    } else {
      tbody.style.display = 'none';
      btn.innerText = 'Exibir Alunos';
    }
}

document.addEventListener('DOMContentLoaded', () => {
    const btn = document.getElementById('exibir-ocultar-tabela');
    if (btn) btn.addEventListener('click', alternarTabela(btn));
});
