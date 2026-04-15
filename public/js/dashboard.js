'use strict';

/* ==========================================================
   Dashboard — gerenciamento local de idosos (modo legado)
   Dados ficam apenas em memória de sessão; nenhum dado
   sensível é persistido no navegador.
   ========================================================== */

let idosos = [];
let editIndex = null;

// ── Utilitários DOM seguros ──────────────────────────────────

function escapeHtml(str) {
    if (str === null || str === undefined) return '';
    const div = document.createElement('div');
    div.textContent = String(str);
    return div.innerHTML;
}

function mostrarNotificacao(mensagem, tipo) {
    tipo = tipo || 'info';
    let notif = document.getElementById('dashboard-notificacao');
    if (!notif) {
        notif = document.createElement('div');
        notif.id = 'dashboard-notificacao';
        notif.setAttribute('role', 'alert');
        notif.setAttribute('aria-live', 'polite');
        notif.style.cssText = [
            'position:fixed', 'top:20px', 'right:20px', 'z-index:9999',
            'padding:12px 20px', 'border-radius:8px', 'font-weight:700',
            'max-width:360px', 'box-shadow:0 4px 12px rgba(0,0,0,.2)',
            'transition:opacity .3s'
        ].join(';');
        document.body.appendChild(notif);
    }

    var cores = {
        sucesso: { bg: '#2ecc71', cor: '#fff' },
        erro:    { bg: '#e74c3c', cor: '#fff' },
        aviso:   { bg: '#f39c12', cor: '#fff' },
        info:    { bg: '#3498db', cor: '#fff' }
    };
    var c = cores[tipo] || cores.info;
    notif.style.background = c.bg;
    notif.style.color = c.cor;
    notif.textContent = mensagem;
    notif.style.opacity = '1';
    notif.style.display = 'block';

    clearTimeout(notif._timer);
    notif._timer = setTimeout(function () {
        notif.style.opacity = '0';
        setTimeout(function () { notif.style.display = 'none'; }, 300);
    }, 4000);
}

// ── Cálculo de idade ─────────────────────────────────────────

function calcularIdade(dataNascimento) {
    if (!dataNascimento) return null;
    var nascimento = new Date(dataNascimento);
    if (Number.isNaN(nascimento.getTime())) return null;
    var hoje = new Date();
    var idade = hoje.getFullYear() - nascimento.getFullYear();
    if (
        hoje.getMonth() < nascimento.getMonth() ||
        (hoje.getMonth() === nascimento.getMonth() && hoje.getDate() < nascimento.getDate())
    ) {
        idade -= 1;
    }
    return idade;
}

// ── Contador ─────────────────────────────────────────────────

function atualizarContador() {
    var contador = document.getElementById('contador-idosos');
    if (contador) {
        contador.textContent = idosos.length;
    }
}

// ── Navegação ────────────────────────────────────────────────

function irParaFicha() {
    var tipo = document.getElementById('tipo-ficha');
    var url = tipo ? tipo.value : 'FichaDeCadastro1.html';
    window.location.href = url;
}

// ── Lista ────────────────────────────────────────────────────

function toggleLista() {
    var lista = document.getElementById('lista-idosos');
    if (!lista) return;
    lista.style.display = lista.style.display === 'block' ? 'none' : 'block';
    atualizarTabela();
}

// ── Formulário ───────────────────────────────────────────────

function abrirForm() {
    var form = document.getElementById('form-container');
    if (form) form.style.display = 'block';
}

function limparForm() {
    var campos = ['nome', 'idade', 'cpf', 'responsavel'];
    campos.forEach(function (id) {
        var el = document.getElementById(id);
        if (el) el.value = '';
    });
    var form = document.getElementById('form-container');
    if (form) form.style.display = 'none';
    editIndex = null;
}

// ── Salvar (cadastrar ou editar) ─────────────────────────────

function salvar() {
    var nomeEl       = document.getElementById('nome');
    var idadeEl      = document.getElementById('idade');
    var cpfEl        = document.getElementById('cpf');
    var responsavelEl = document.getElementById('responsavel');

    if (!nomeEl || !nomeEl.value.trim()) {
        mostrarNotificacao('O campo Nome é obrigatório.', 'aviso');
        return;
    }

    var idoso = {
        nome:        nomeEl.value.trim(),
        idade:       idadeEl ? idadeEl.value.trim() : '',
        cpf:         cpfEl ? cpfEl.value.trim() : '',
        responsavel: responsavelEl ? responsavelEl.value.trim() : ''
    };

    if (editIndex === null) {
        idosos.push(idoso);
        mostrarNotificacao('Idoso cadastrado com sucesso.', 'sucesso');
    } else {
        idosos[editIndex] = idoso;
        mostrarNotificacao('Idoso atualizado com sucesso.', 'sucesso');
        editIndex = null;
    }

    atualizarContador();
    limparForm();
    atualizarTabela();
}

// ── Tabela (sem innerHTML com dados) ─────────────────────────

function atualizarTabela() {
    var corpo = document.getElementById('corpo-tabela');
    if (!corpo) return;

    while (corpo.firstChild) {
        corpo.removeChild(corpo.firstChild);
    }

    idosos.forEach(function (idoso, index) {
        var idadeValor = idoso.idade || calcularIdade(idoso.nascimento);

        var tr = document.createElement('tr');

        var tdNome = document.createElement('td');
        tdNome.textContent = idoso.nome || '';

        var tdIdade = document.createElement('td');
        tdIdade.textContent = idadeValor !== null && idadeValor !== '' ? idadeValor : '—';

        var tdCpf = document.createElement('td');
        tdCpf.textContent = idoso.cpf || '';

        var tdResponsavel = document.createElement('td');
        tdResponsavel.textContent = idoso.responsavel || '';

        var tdAcoes = document.createElement('td');

        var btnEditar = document.createElement('button');
        btnEditar.className = 'edit';
        btnEditar.textContent = 'Editar';
        btnEditar.setAttribute('aria-label', 'Editar ' + idoso.nome);
        btnEditar.addEventListener('click', function () { editar(index); });

        var btnExcluir = document.createElement('button');
        btnExcluir.className = 'delete';
        btnExcluir.textContent = 'Excluir';
        btnExcluir.setAttribute('aria-label', 'Excluir ' + idoso.nome);
        btnExcluir.addEventListener('click', function () { excluir(index); });

        tdAcoes.appendChild(btnEditar);
        tdAcoes.appendChild(document.createTextNode(' '));
        tdAcoes.appendChild(btnExcluir);

        tr.appendChild(tdNome);
        tr.appendChild(tdIdade);
        tr.appendChild(tdCpf);
        tr.appendChild(tdResponsavel);
        tr.appendChild(tdAcoes);

        corpo.appendChild(tr);
    });
}

// ── Editar ───────────────────────────────────────────────────

function editar(index) {
    var idoso = idosos[index];
    if (!idoso) {
        mostrarNotificacao('Idoso não encontrado. Atualize a página e tente novamente.', 'erro');
        return;
    }

    editIndex = index;

    var nomeEl       = document.getElementById('nome');
    var idadeEl      = document.getElementById('idade');
    var cpfEl        = document.getElementById('cpf');
    var responsavelEl = document.getElementById('responsavel');

    if (nomeEl)       nomeEl.value       = idoso.nome        || '';
    if (idadeEl)      idadeEl.value      = idoso.idade       || '';
    if (cpfEl)        cpfEl.value        = idoso.cpf         || '';
    if (responsavelEl) responsavelEl.value = idoso.responsavel || '';

    abrirForm();
}

// ── Excluir ──────────────────────────────────────────────────

function excluir(index) {
    var idoso = idosos[index];
    if (!idoso) return;

    if (window.confirm('Deseja excluir ' + idoso.nome + '?')) {
        idosos.splice(index, 1);
        atualizarContador();
        atualizarTabela();
        mostrarNotificacao('Idoso removido.', 'info');
    }
}
