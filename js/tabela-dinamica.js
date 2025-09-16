async function carregarTabela() {
    const response = await fetch('../inludes/carrega_tabela.php');
    const html = await response.text();
    document.getElementById('container-tabela').innerHTML = html;

    const tbody = document.querySelector('#container-tabela table tbody');
    if (tbody) {
      tbody.id = "corpo-tabela-principal";
    }
}

async function alternarTabela() {
    const tbody = document.getElementById('corpo-tabela-principal');
    const btn = document.getElementById('exibir-ocultar-tabela');

    if (!tbody) return; 

    if (tbody.style.display === 'none' || tbody.style.display === '') {
      tbody.style.display = 'table-row-group';
      btn.innerText = 'Ocultar Alunos';
    } else {
      tbody.style.display = 'none';
      btn.innerText = 'Exibir Alunos';
    }
}

document.getElementById('exibir-ocultar-tabela')
        .addEventListener('click', alternarTabela);


carregarTabela();