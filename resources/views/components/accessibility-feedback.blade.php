{{-- VLibras — Plugin oficial de Libras do Governo Federal --}}
<div vw class="enabled">
    <div vw-access-button class="active"></div>
    <div vw-plugin-wrapper>
        <div class="vw-plugin-top-wrapper"></div>
    </div>
</div>
<script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
<script>
    new window.VLibras.Widget('https://vlibras.gov.br/app');
</script>

{{-- Máscaras de formulário (CPF, Telefone, E-mail) --}}
<script src="{{ asset('js/masks.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div id="feedback-live-region" class="sr-only" aria-live="polite" aria-atomic="true"></div>

<style>
    .sr-only {
        position: absolute;
        width: 1px;
        height: 1px;
        padding: 0;
        margin: -1px;
        overflow: hidden;
        clip: rect(0, 0, 0, 0);
        white-space: nowrap;
        border: 0;
    }

    :root {
        --focus-ring-color: #0f62fe;
        --focus-ring-shadow: rgba(15, 98, 254, 0.28);
        --success-contrast: #166534;
        --warning-contrast: #92400e;
        --error-contrast: #991b1b;
        --surface-contrast: #111827;
        --muted-contrast: #374151;
    }

    body {
        color: var(--surface-contrast);
    }

    a,
    button,
    input,
    select,
    textarea,
    [role="button"],
    .menu-link,
    .btn,
    .btn-add,
    .btn-login,
    .btn-secundario,
    .btn-tab,
    .edit,
    .delete,
    .botao {
        transition: box-shadow .2s ease, outline-color .2s ease, transform .2s ease;
    }

    a:focus-visible,
    button:focus-visible,
    input:focus-visible,
    select:focus-visible,
    textarea:focus-visible,
    [role="button"]:focus-visible,
    .menu-link:focus-visible,
    .btn:focus-visible,
    .btn-add:focus-visible,
    .btn-login:focus-visible,
    .btn-secundario:focus-visible,
    .btn-tab:focus-visible,
    .edit:focus-visible,
    .delete:focus-visible,
    .botao:focus-visible {
        outline: 3px solid var(--focus-ring-color) !important;
        outline-offset: 3px !important;
        box-shadow: 0 0 0 4px var(--focus-ring-shadow) !important;
    }

    input,
    select,
    textarea {
        color: var(--surface-contrast);
        background-color: #fff;
    }

    label,
    .field-label-enhanced {
        color: var(--surface-contrast);
        font-weight: 600;
    }

    .field-label-enhanced {
        display: block;
        margin-bottom: 6px;
        font-size: 0.95rem;
    }

    .swal2-accessible-button:focus-visible,
    .swal2-confirm:focus-visible,
    .swal2-cancel:focus-visible {
        outline: 3px solid var(--focus-ring-color) !important;
        outline-offset: 3px !important;
        box-shadow: 0 0 0 4px var(--focus-ring-shadow) !important;
    }

    .feedback-inline-message {
        border-radius: 10px;
        padding: 12px 16px;
        margin: 12px 0;
        font-weight: 600;
    }

    .feedback-inline-message.success {
        background: #ecfdf5;
        color: var(--success-contrast);
        border: 1px solid #86efac;
    }

    .feedback-inline-message.warning {
        background: #fffbeb;
        color: var(--warning-contrast);
        border: 1px solid #fcd34d;
    }

    .feedback-inline-message.error {
        background: #fef2f2;
        color: var(--error-contrast);
        border: 1px solid #fca5a5;
    }

    /* Mensagens de erro inline das máscaras */
    .mask-campo-erro {
        display: block;
        margin-top: 4px;
        font-size: 0.82rem;
        color: var(--error-contrast);
        font-weight: 600;
    }

    /* Dicas acessíveis (visíveis apenas para leitores de tela) */
    .mask-campo-dica {
        position: absolute;
        width: 1px;
        height: 1px;
        padding: 0;
        margin: -1px;
        overflow: hidden;
        clip: rect(0,0,0,0);
        white-space: nowrap;
        border: 0;
    }

    /* ── VLibras: garante que o botão fique sempre visível ── */
    [vw] .vw-access-button {
        z-index: 9999 !important;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const liveRegion = document.getElementById('feedback-live-region');

        const flashMessages = {
            success: @json(session('success')),
            error: @json(session('error')),
            warning: @json(session('warning')),
            info: @json(session('info')),
            successConfig: @json(session('success_config')),
            status: @json(session('status')),
        };

        function announce(message) {
            if (liveRegion && message) {
                liveRegion.textContent = '';
                setTimeout(() => liveRegion.textContent = message, 60);
            }
        }

        function showToast(icon, title, text = '') {
            announce(title || text);
            Swal.fire({
                icon,
                title,
                text,
                confirmButtonText: 'Entendi',
                customClass: {
                    confirmButton: 'swal2-accessible-button'
                }
            });
        }

        if (flashMessages.success) {
            showToast('success', 'Sucesso', flashMessages.success);
        } else if (flashMessages.successConfig) {
            showToast('success', 'Configurações atualizadas', flashMessages.successConfig);
        } else if (flashMessages.error) {
            showToast('error', 'Erro', flashMessages.error);
        } else if (flashMessages.warning) {
            showToast('warning', 'Aviso', flashMessages.warning);
        } else if (flashMessages.info) {
            showToast('info', 'Informação', flashMessages.info);
        } else if (flashMessages.status && flashMessages.status !== 'verification-link-sent') {
            showToast('success', 'Tudo certo', flashMessages.status);
        }

        const validationErrors = @json($errors->all());
        if (validationErrors.length > 0) {
            const firstError = validationErrors[0];
            announce(firstError);
            Swal.fire({
                icon: 'error',
                title: 'Revise os campos',
                html: `<div style="text-align:left"><p>${firstError}</p></div>`,
                confirmButtonText: 'Corrigir agora',
                customClass: {
                    confirmButton: 'swal2-accessible-button'
                }
            });
        }

        function humanizeFieldName(name = '') {
            return name
                .replace(/\[|\]/g, ' ')
                .replace(/_/g, ' ')
                .replace(/-/g, ' ')
                .replace(/\s+/g, ' ')
                .trim()
                .replace(/\b\w/g, letter => letter.toUpperCase());
        }

        document.querySelectorAll('input, select, textarea').forEach((field, index) => {
            if (field.type === 'hidden' || field.type === 'submit' || field.type === 'button' || field.type === 'checkbox' || field.type === 'radio') {
                return;
            }

            if (!field.id) {
                field.id = `campo-acessivel-${index}`;
            }

            const hasAssociatedLabel = document.querySelector(`label[for="${field.id}"]`) || field.closest('label');
            const fallbackText = field.getAttribute('aria-label') || field.getAttribute('placeholder') || humanizeFieldName(field.name) || humanizeFieldName(field.id);

            if (!field.getAttribute('aria-label') && fallbackText) {
                field.setAttribute('aria-label', fallbackText);
            }

            if (!hasAssociatedLabel && fallbackText && field.parentElement && !field.parentElement.querySelector(`label[for="${field.id}"]`)) {
                const label = document.createElement('label');
                label.htmlFor = field.id;
                label.className = 'field-label-enhanced';
                label.textContent = fallbackText;
                field.parentElement.insertBefore(label, field);
            }
        });

        document.querySelectorAll('img').forEach((img) => {
            const alt = (img.getAttribute('alt') || '').trim();
            if (!alt || /^foto\d+$/i.test(alt) || /^logo$/i.test(alt) || /^remedio$/i.test(alt)) {
                const src = img.getAttribute('src') || '';
                const fileName = src.split('/').pop()?.split('?')[0] || 'imagem';
                const prettyName = decodeURIComponent(fileName)
                    .replace(/\.[a-zA-Z0-9]+$/, '')
                    .replace(/[-_]+/g, ' ')
                    .trim();
                img.setAttribute('alt', `Imagem ilustrativa: ${prettyName}`);
            }
        });

        async function confirmAction(form, options = {}) {
            const result = await Swal.fire({
                icon: options.icon || 'warning',
                title: options.title || 'Confirmar ação',
                text: options.text || 'Tem certeza que deseja continuar?',
                showCancelButton: true,
                confirmButtonText: options.confirmButtonText || 'Sim, continuar',
                cancelButtonText: options.cancelButtonText || 'Cancelar',
                reverseButtons: true,
                focusCancel: true,
                customClass: {
                    confirmButton: 'swal2-accessible-button',
                    cancelButton: 'swal2-accessible-button'
                }
            });

            if (result.isConfirmed) {
                form.submit();
            }
        }

        document.querySelectorAll('form').forEach((form) => {
            const originalOnsubmit = form.getAttribute('onsubmit');
            const action = form.getAttribute('action') || '';
            const buttonText = (form.querySelector('button[type="submit"]')?.textContent || '').trim().toLowerCase();
            const asksDelete = /destroy|delete|excluir|remover/.test(originalOnsubmit || '') || /destroy|logout/.test(action) || buttonText.includes('sair') || buttonText.includes('excluir') || buttonText.includes('remover');

            if (originalOnsubmit && originalOnsubmit.includes('confirm(')) {
                form.removeAttribute('onsubmit');
            }

            if (asksDelete || form.dataset.confirm === 'true') {
                form.addEventListener('submit', function (event) {
                    if (form.dataset.confirmed === 'true') {
                        form.dataset.confirmed = 'false';
                        return;
                    }

                    event.preventDefault();
                    confirmAction(form, {
                        title: form.dataset.confirmTitle || (buttonText.includes('sair') ? 'Deseja sair do sistema?' : 'Deseja confirmar esta ação?'),
                        text: form.dataset.confirmText || (buttonText.includes('sair') ? 'Sua sessão atual será encerrada.' : 'Essa ação pode não ser reversível.'),
                        icon: buttonText.includes('sair') ? 'question' : 'warning',
                        confirmButtonText: form.dataset.confirmButton || (buttonText.includes('sair') ? 'Sim, sair' : 'Sim, confirmar')
                    });
                });
            }
        });
    });
</script>
