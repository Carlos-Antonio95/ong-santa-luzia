const ctx = document.getElementById('grafico');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Jan', 'Fev', 'Mar', 'Abr'],
        datasets: [{
            label: 'Doações',
            data: [500, 800, 600, 900],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true
    }
});


let idosos = [];
let editIndex = null;

// MOSTRAR LISTA
function toggleLista() {
    const lista = document.getElementById("lista-idosos");
    lista.style.display = lista.style.display === "block" ? "none" : "block";
    atualizarTabela();
}

// ABRIR FORM
function abrirForm() {
    document.getElementById("form-container").style.display = "block";
}

// SALVAR (ADD OU EDIT)
function salvar() {
    const idoso = {
        nome: nome.value,
        idade: idade.value,
        cpf: cpf.value,
        responsavel: responsavel.value
    };

    if (editIndex === null) {
        idosos.push(idoso);
    } else {
        idosos[editIndex] = idoso;
        editIndex = null;
    }

    limparForm();
    atualizarTabela();
}

// ATUALIZAR TABELA
function atualizarTabela() {
    const corpo = document.getElementById("corpo-tabela");
    corpo.innerHTML = "";

    idosos.forEach((idoso, index) => {
        corpo.innerHTML += `
        <tr>
            <td>${idoso.nome}</td>
            <td>${idoso.idade}</td>
            <td>${idoso.cpf}</td>
            <td>${idoso.responsavel}</td>
            <td>
                <button class="edit" onclick="editar(${index})">Editar</button>
                <button class="delete" onclick="excluir(${index})">Excluir</button>
            </td>
        </tr>
        `;
    });
}

// EDITAR
function editar(index) {
    const idoso = idosos[index];

    nome.value = idoso.nome;
    idade.value = idoso.idade;
    cpf.value = idoso.cpf;
    responsavel.value = idoso.responsavel;

    abrirForm();
    editIndex = index;
}

// EXCLUIR
function excluir(index) {
    if (confirm("Deseja excluir este idoso?")) {
        idosos.splice(index, 1);
        atualizarTabela();
    }
}

// LIMPAR FORM
function limparForm() {
    nome.value = "";
    idade.value = "";
    cpf.value = "";
    responsavel.value = "";

    document.getElementById("form-container").style.display = "none";
}
