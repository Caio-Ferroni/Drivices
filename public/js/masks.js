/**
 * Drivices — masks.js
 * Máscaras de input para campos do formulário.
 * Aplicadas via atributo data-mask="tipo" no HTML.
 */

(function () {

    // ── CPF: 000.000.000-00 ──────────────────────────────
    function maskCpf(value) {
        return value
            .replace(/\D/g, '')
            .slice(0, 11)
            .replace(/(\d{3})(\d)/, '$1.$2')
            .replace(/(\d{3})(\d)/, '$1.$2')
            .replace(/(\d{3})(\d{1,2})$/, '$1-$2');
    }

    // ── Aplicar máscaras ─────────────────────────────────
    function applyMasks() {
        document.querySelectorAll('[data-mask="cpf"]').forEach(function (input) {
            input.addEventListener('input', function (e) {
                var pos = e.target.selectionStart;
                var prev = e.target.value.length;
                e.target.value = maskCpf(e.target.value);
                var diff = e.target.value.length - prev;
                e.target.setSelectionRange(pos + diff, pos + diff);
            });

            // Formata valor existente (ex: preenchido pelo browser)
            if (input.value) {
                input.value = maskCpf(input.value);
            }
        });
    }

    // ── Toggle visibilidade de senha ─────────────────────
    function applyPasswordToggles() {
        document.querySelectorAll('[data-toggle-password]').forEach(function (btn) {
            btn.addEventListener('click', function () {
                var targetId = btn.getAttribute('data-toggle-password');
                var input = document.getElementById(targetId);
                if (!input) return;

                var isPassword = input.type === 'password';
                input.type = isPassword ? 'text' : 'password';

                // Troca o ícone: olho aberto / olho fechado
                btn.innerHTML = isPassword
                    ? '<svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M17.94 17.94A10.07 10.07 0 0112 20c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94"/><path d="M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19"/><line x1="1" y1="1" x2="23" y2="23"/></svg>'
                    : '<svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>';
            });
        });
    }

    // ── Init ─────────────────────────────────────────────
    document.addEventListener('DOMContentLoaded', function () {
        applyMasks();
        applyPasswordToggles();
    });

})();