/**
 * Máscaras de formulário — CPF, CNPJ, CPF/CNPJ, Telefone, E-mail
 * Sem dependências externas.
 */
(function () {
    'use strict';

    function soNumeros(valor) {
        return (valor || '').replace(/\D/g, '');
    }

    function mascaraCpf(valor) {
        var v = soNumeros(valor).slice(0, 11);
        if (v.length <= 3) return v;
        if (v.length <= 6) return v.slice(0, 3) + '.' + v.slice(3);
        if (v.length <= 9) return v.slice(0, 3) + '.' + v.slice(3, 6) + '.' + v.slice(6);
        return v.slice(0, 3) + '.' + v.slice(3, 6) + '.' + v.slice(6, 9) + '-' + v.slice(9);
    }

    function mascaraCnpj(valor) {
        var v = soNumeros(valor).slice(0, 14);
        if (v.length <= 2) return v;
        if (v.length <= 5) return v.slice(0, 2) + '.' + v.slice(2);
        if (v.length <= 8) return v.slice(0, 2) + '.' + v.slice(2, 5) + '.' + v.slice(5);
        if (v.length <= 12) return v.slice(0, 2) + '.' + v.slice(2, 5) + '.' + v.slice(5, 8) + '/' + v.slice(8);
        return v.slice(0, 2) + '.' + v.slice(2, 5) + '.' + v.slice(5, 8) + '/' + v.slice(8, 12) + '-' + v.slice(12);
    }

    function mascaraCpfOuCnpj(valor, tipo) {
        return tipo === 'Empresa' ? mascaraCnpj(valor) : mascaraCpf(valor);
    }

    function mascaraTelefone(valor) {
        var v = soNumeros(valor).slice(0, 11);
        if (v.length <= 2) return v.length ? '(' + v : v;
        var ddd = v.slice(0, 2);
        var resto = v.slice(2);
        if (resto.length === 0) return '(' + ddd + ') ';
        if (v.length <= 10) {
            if (resto.length <= 4) return '(' + ddd + ') ' + resto;
            return '(' + ddd + ') ' + resto.slice(0, 4) + '-' + resto.slice(4);
        }
        if (resto.length <= 5) return '(' + ddd + ') ' + resto;
        return '(' + ddd + ') ' + resto.slice(0, 5) + '-' + resto.slice(5);
    }

    var RE_EMAIL = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/;

    function validarEmail(campo) {
        var val = campo.value.trim();
        if (val === '') {
            campo.setCustomValidity('');
            campo.removeAttribute('aria-invalid');
            removerMensagemErro(campo);
            return;
        }
        if (RE_EMAIL.test(val)) {
            campo.setCustomValidity('');
            campo.setAttribute('aria-invalid', 'false');
            removerMensagemErro(campo);
        } else {
            campo.setCustomValidity('Digite um e-mail válido (ex: nome@dominio.com.br)');
            campo.setAttribute('aria-invalid', 'true');
            exibirMensagemErro(campo, 'Digite um e-mail válido (ex: nome@dominio.com.br)');
        }
    }

    function exibirMensagemErro(campo, mensagem) {
        var erroId = 'mask-erro-' + campo.id;
        var existente = document.getElementById(erroId);
        if (!existente) {
            var span = document.createElement('span');
            span.id = erroId;
            span.className = 'mask-campo-erro';
            span.setAttribute('role', 'alert');
            span.setAttribute('aria-live', 'polite');
            campo.parentNode.insertBefore(span, campo.nextSibling);
        }
        document.getElementById(erroId).textContent = mensagem;
        campo.setAttribute('aria-describedby', erroId);
    }

    function removerMensagemErro(campo) {
        var erroId = 'mask-erro-' + campo.id;
        var existente = document.getElementById(erroId);
        if (existente) existente.remove();
        campo.removeAttribute('aria-describedby');
    }

    function aplicarMascara(campo, fn) {
        campo.addEventListener('input', function () {
            var pos = campo.selectionStart;
            var valorAntes = campo.value;
            var valorNovo = fn(valorAntes);
            campo.value = valorNovo;

            var diff = valorNovo.length - valorAntes.length;
            if (diff > 0) pos = pos + diff;

            if (campo.setSelectionRange) {
                try { campo.setSelectionRange(pos, pos); } catch (err) {}
            }
        });

        campo.addEventListener('blur', function () {
            campo.value = fn(campo.value);
        });

        campo.addEventListener('keydown', function (e) {
            var permitidas = [
                'Backspace', 'Delete', 'Tab', 'Escape', 'Enter',
                'ArrowLeft', 'ArrowRight', 'ArrowUp', 'ArrowDown',
                'Home', 'End'
            ];
            var isCtrl = e.ctrlKey || e.metaKey;
            if (isCtrl) return;
            if (permitidas.indexOf(e.key) !== -1) return;
            if (e.key >= '0' && e.key <= '9') return;
            e.preventDefault();
        });

        campo.setAttribute('inputmode', 'numeric');
    }

    function enriquecerCampo(campo, tipo) {
        var mapa = {
            cpf: {
                placeholder: '000.000.000-00',
                autocomplete: 'off',
                maxlength: '14',
                pattern: '\\d{3}\\.\\d{3}\\.\\d{3}-\\d{2}',
                title: 'Formato: 000.000.000-00',
                descricao: 'Digite os 11 números do CPF'
            },
            cnpj: {
                placeholder: '00.000.000/0000-00',
                autocomplete: 'off',
                maxlength: '18',
                pattern: '\\d{2}\\.\\d{3}\\.\\d{3}/\\d{4}-\\d{2}',
                title: 'Formato: 00.000.000/0000-00',
                descricao: 'Digite os 14 números do CNPJ'
            },
            telefone: {
                placeholder: '(00) 00000-0000',
                autocomplete: 'tel-national',
                maxlength: '15',
                pattern: '\\(\\d{2}\\)\\s\\d{4,5}-\\d{4}',
                title: 'Formato: (DDD) 00000-0000',
                descricao: 'Digite DDD e número do telefone'
            }
        };

        var cfg = mapa[tipo];
        if (!cfg) return;

        if (!campo.placeholder) campo.placeholder = cfg.placeholder;
        if (!campo.getAttribute('autocomplete')) campo.setAttribute('autocomplete', cfg.autocomplete);
        campo.setAttribute('maxlength', cfg.maxlength);
        campo.setAttribute('pattern', cfg.pattern);
        campo.setAttribute('title', cfg.title);

        var dicaId = 'mask-dica-' + (campo.id || campo.name || tipo);
        if (!document.getElementById(dicaId)) {
            var dica = document.createElement('span');
            dica.id = dicaId;
            dica.className = 'mask-campo-dica sr-only';
            dica.textContent = cfg.descricao;
            campo.parentNode.insertBefore(dica, campo.nextSibling);
        }

        var descAtual = campo.getAttribute('aria-describedby') || '';
        if (descAtual.indexOf(dicaId) === -1) {
            campo.setAttribute('aria-describedby', (descAtual + ' ' + dicaId).trim());
        }
    }

    function configurarCampoCpfCnpj(campo, seletorTipo) {
        if (!campo || campo.dataset.maskApplied) return;

        campo.dataset.maskApplied = '1';
        campo.setAttribute('inputmode', 'numeric');

        function obterTipo() {
            var select = document.querySelector(seletorTipo);
            return select ? select.value : 'Pessoa Física';
        }

        function atualizarAtributos() {
            var tipoAtual = obterTipo();

            if (tipoAtual === 'Empresa') {
                campo.setAttribute('maxlength', '18');
                campo.setAttribute('placeholder', '00.000.000/0000-00');
                campo.setAttribute('pattern', '\\d{2}\\.\\d{3}\\.\\d{3}/\\d{4}-\\d{2}');
                campo.setAttribute('title', 'Formato: 00.000.000/0000-00');
            } else {
                campo.setAttribute('maxlength', '14');
                campo.setAttribute('placeholder', '000.000.000-00');
                campo.setAttribute('pattern', '\\d{3}\\.\\d{3}\\.\\d{3}-\\d{2}');
                campo.setAttribute('title', 'Formato: 000.000.000-00');
            }
        }

        campo.addEventListener('input', function () {
            var tipoAtual = obterTipo();
            campo.value = mascaraCpfOuCnpj(campo.value, tipoAtual);
            atualizarAtributos();
        });

        campo.addEventListener('blur', function () {
            var tipoAtual = obterTipo();
            campo.value = mascaraCpfOuCnpj(campo.value, tipoAtual);
            atualizarAtributos();
        });

        campo.addEventListener('keydown', function (e) {
            var permitidas = [
                'Backspace', 'Delete', 'Tab', 'Escape', 'Enter',
                'ArrowLeft', 'ArrowRight', 'ArrowUp', 'ArrowDown',
                'Home', 'End'
            ];
            var isCtrl = e.ctrlKey || e.metaKey;
            if (isCtrl) return;
            if (permitidas.indexOf(e.key) !== -1) return;
            if (e.key >= '0' && e.key <= '9') return;
            e.preventDefault();
        });

        var selectTipo = document.querySelector(seletorTipo);
        if (selectTipo) {
            selectTipo.addEventListener('change', function () {
                campo.value = mascaraCpfOuCnpj(campo.value, obterTipo());
                atualizarAtributos();
            });
        }

        campo.value = mascaraCpfOuCnpj(campo.value, obterTipo());
        atualizarAtributos();
    }

    function init() {
        var seletoresCpfFixos = [
            'input[name="responsavel_cpf"]',
            'input[data-mask="cpf"]'
        ];

        var seletoresTel = [
            'input[name="telefone"]',
            'input[name="responsavel_telefone"]',
            'input[data-mask="telefone"]'
        ];

        var seletoresEmail = [
            'input[type="email"]',
            'input[name="email"]',
            'input[data-mask="email"]'
        ];

        seletoresCpfFixos.forEach(function (sel) {
            document.querySelectorAll(sel).forEach(function (campo) {
                if (campo.dataset.maskApplied) return;
                campo.dataset.maskApplied = '1';
                enriquecerCampo(campo, 'cpf');
                aplicarMascara(campo, mascaraCpf);
                if (campo.value) campo.value = mascaraCpf(campo.value);
            });
        });

        configurarCampoCpfCnpj(document.getElementById('nd-documento'), '#nd-tipo');
        configurarCampoCpfCnpj(document.getElementById('edit-doador-documento'), '#edit-doador-tipo');

        seletoresTel.forEach(function (sel) {
            document.querySelectorAll(sel).forEach(function (campo) {
                if (campo.dataset.maskApplied) return;
                campo.dataset.maskApplied = '1';
                enriquecerCampo(campo, 'telefone');
                aplicarMascara(campo, mascaraTelefone);
                if (campo.value) campo.value = mascaraTelefone(campo.value);
            });
        });

        seletoresEmail.forEach(function (sel) {
            document.querySelectorAll(sel).forEach(function (campo) {
                if (campo.dataset.maskApplied) return;
                campo.dataset.maskApplied = '1';
                if (!campo.placeholder) campo.placeholder = 'exemplo@dominio.com.br';
                if (!campo.getAttribute('autocomplete')) campo.setAttribute('autocomplete', 'email');
                campo.setAttribute('inputmode', 'email');
                campo.addEventListener('blur', function () { validarEmail(campo); });
                campo.addEventListener('input', function () {
                    if (campo.value.trim() === '') {
                        campo.setCustomValidity('');
                        campo.removeAttribute('aria-invalid');
                        removerMensagemErro(campo);
                    }
                });
            });
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

    window.MascarasFormulario = { init: init };
})();