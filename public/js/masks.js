/**
 * Máscaras de formulário — CPF, Telefone, E-mail
 * Sem dependências externas. Detecta os campos automaticamente
 * pelo atributo name ou data-mask.
 */
(function () {
    'use strict';

    // ─── Funções de formatação ────────────────────────────────────────────────

    function mascaraCpf(valor) {
        var v = valor.replace(/\D/g, '').slice(0, 11);
        if (v.length <= 3) return v;
        if (v.length <= 6) return v.slice(0, 3) + '.' + v.slice(3);
        if (v.length <= 9) return v.slice(0, 3) + '.' + v.slice(3, 6) + '.' + v.slice(6);
        return v.slice(0, 3) + '.' + v.slice(3, 6) + '.' + v.slice(6, 9) + '-' + v.slice(9);
    }

    function mascaraTelefone(valor) {
        var v = valor.replace(/\D/g, '').slice(0, 11);
        if (v.length <= 2) return v.length ? '(' + v : v;
        var ddd = v.slice(0, 2);
        var resto = v.slice(2);
        if (resto.length === 0) return '(' + ddd + ') ';
        // Celular (9 dígitos) ou fixo (8 dígitos)
        if (v.length <= 10) {
            // fixo: (XX) XXXX-XXXX
            if (resto.length <= 4) return '(' + ddd + ') ' + resto;
            return '(' + ddd + ') ' + resto.slice(0, 4) + '-' + resto.slice(4);
        }
        // celular: (XX) XXXXX-XXXX
        if (resto.length <= 5) return '(' + ddd + ') ' + resto;
        return '(' + ddd + ') ' + resto.slice(0, 5) + '-' + resto.slice(5);
    }

    // ─── Validação visual de e-mail ───────────────────────────────────────────

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

    // ─── Feedback visual inline ───────────────────────────────────────────────

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

    // ─── Aplicar máscara com preservação do cursor ────────────────────────────

    function aplicarMascara(campo, fn) {
        campo.addEventListener('input', function (e) {
            var pos = campo.selectionStart;
            var valorAntes = campo.value;
            var valorNovo = fn(valorAntes);
            campo.value = valorNovo;

            // Ajustar posição do cursor após inserção de separadores
            var diff = valorNovo.length - valorAntes.length;
            if (diff > 0) pos = pos + diff;
            if (campo.setSelectionRange) {
                try { campo.setSelectionRange(pos, pos); } catch (err) { /* ignore */ }
            }
        });

        // Ao sair do campo, formata e anuncia
        campo.addEventListener('blur', function () {
            campo.value = fn(campo.value);
        });

        // Permitir apenas teclas numéricas e de navegação
        campo.addEventListener('keydown', function (e) {
            var permitidas = [
                'Backspace', 'Delete', 'Tab', 'Escape', 'Enter',
                'ArrowLeft', 'ArrowRight', 'ArrowUp', 'ArrowDown',
                'Home', 'End'
            ];
            var isCtrl = e.ctrlKey || e.metaKey;
            if (isCtrl) return; // Ctrl+C, Ctrl+V, etc.
            if (permitidas.indexOf(e.key) !== -1) return;
            if (e.key >= '0' && e.key <= '9') return;
            e.preventDefault();
        });

        campo.setAttribute('inputmode', 'numeric');
    }

    // ─── Acessibilidade: atributos complementares ─────────────────────────────

    function enriquecerCampo(campo, tipo) {
        var mapa = {
            cpf: {
                label: 'CPF',
                placeholder: '000.000.000-00',
                autocomplete: 'off',
                maxlength: '14',
                pattern: '\\d{3}\\.\\d{3}\\.\\d{3}-\\d{2}',
                title: 'Formato: 000.000.000-00',
                descricao: 'Digite os 11 números do CPF'
            },
            telefone: {
                label: 'Telefone',
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
        if (!campo.getAttribute('pattern')) campo.setAttribute('pattern', cfg.pattern);
        if (!campo.getAttribute('title')) campo.setAttribute('title', cfg.title);

        // Dica acessível vinculada ao campo
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

    // ─── Inicialização ────────────────────────────────────────────────────────

    function init() {
        // Seletores que identificam campos de CPF
        var seletoresCpf = [
            'input[name="cpf"]',
            'input[name="responsavel_cpf"]',
            'input[data-mask="cpf"]'
        ];

        // Seletores que identificam campos de telefone
        var seletoresTel = [
            'input[name="telefone"]',
            'input[name="responsavel_telefone"]',
            'input[data-mask="telefone"]'
        ];

        // Seletores que identificam campos de e-mail
        var seletoresEmail = [
            'input[type="email"]',
            'input[name="email"]',
            'input[data-mask="email"]'
        ];

        seletoresCpf.forEach(function (sel) {
            document.querySelectorAll(sel).forEach(function (campo) {
                if (campo.dataset.maskApplied) return;
                campo.dataset.maskApplied = '1';
                enriquecerCampo(campo, 'cpf');
                aplicarMascara(campo, mascaraCpf);
                // Se já tem valor, formata na inicialização
                if (campo.value) campo.value = mascaraCpf(campo.value);
            });
        });

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

    // Expor publicamente para uso em forms dinâmicos (abas do dashboard)
    window.MascarasFormulario = { init: init };

})();
