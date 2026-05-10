/**
 * Drivices — viacep.js
 * Preenche automaticamente os campos de endereço
 * consultando a API ViaCEP ao digitar o CEP.
 */

(function () {

    // ── Máscara de CEP: 00000-000 ─────────────────────
    function maskCep(value) {
        return value
            .replace(/\D/g, '')
            .slice(0, 8)
            .replace(/(\d{5})(\d)/, '$1-$2');
    }

    // ── Preenche os campos com os dados do ViaCEP ─────
    function fillFields(data) {
        var fields = {
            logradouro: data.logradouro || '',
            bairro:     data.bairro     || '',
            localidade: data.localidade || '',
            uf:         data.uf         || '',
            regiao:     data.regiao     || '',
        };

        Object.entries(fields).forEach(function (entry) {
            var el = document.getElementById(entry[0]);
            if (!el) return;
            el.value = entry[1];
            // Destaca o campo preenchido automaticamente
            el.classList.add('dash-input-autofilled');
            el.addEventListener('input', function () {
                el.classList.remove('dash-input-autofilled');
            }, { once: true });
        });

        // Foca no campo unidade para o usuário completar
        var unidade = document.getElementById('unidade');
        if (unidade) unidade.focus();
    }

    // ── Limpa os campos preenchidos pelo ViaCEP ───────
    function clearFields() {
        ['logradouro', 'bairro', 'localidade', 'uf', 'regiao'].forEach(function (id) {
            var el = document.getElementById(id);
            if (el) {
                el.value = '';
                el.classList.remove('dash-input-autofilled');
            }
        });
    }

    // ── Atualiza o hint abaixo do CEP ─────────────────
    function setHint(msg, type) {
        var hint = document.getElementById('cep-hint');
        if (!hint) return;
        hint.textContent = msg;
        hint.className = 'dash-field-hint';
        if (type === 'error')   hint.classList.add('dash-field-hint-error');
        if (type === 'success') hint.classList.add('dash-field-hint-success');
    }

    // ── Spinner de loading no campo CEP ───────────────
    function setSpinner(visible) {
        var spinner = document.getElementById('cep-spinner');
        if (spinner) spinner.style.display = visible ? 'flex' : 'none';
    }

    // ── Consulta a API ViaCEP ─────────────────────────
    function fetchCep(cep) {
        var raw = cep.replace(/\D/g, '');
        if (raw.length !== 8) return;

        setSpinner(true);
        setHint('Buscando CEP...', '');
        clearFields();

        fetch('https://viacep.com.br/ws/' + raw + '/json/')
            .then(function (res) { return res.json(); })
            .then(function (data) {
                setSpinner(false);
                if (data.erro) {
                    setHint('CEP não encontrado. Preencha os campos manualmente.', 'error');
                    return;
                }
                fillFields(data);
                setHint('Endereço encontrado! Verifique e complete os campos.', 'success');
            })
            .catch(function () {
                setSpinner(false);
                setHint('Erro ao buscar o CEP. Preencha os campos manualmente.', 'error');
            });
    }

    // ── Init ──────────────────────────────────────────
    document.addEventListener('DOMContentLoaded', function () {
        var cepInput = document.querySelector('[data-mask="cep"]');
        if (!cepInput) return;

        // Aplica máscara enquanto digita
        cepInput.addEventListener('input', function () {
            var pos   = cepInput.selectionStart;
            var prev  = cepInput.value.length;
            cepInput.value = maskCep(cepInput.value);
            var diff  = cepInput.value.length - prev;
            cepInput.setSelectionRange(pos + diff, pos + diff);

            // Consulta quando atingir 9 caracteres (00000-000)
            if (cepInput.value.length === 9) {
                fetchCep(cepInput.value);
            }
        });

        // Consulta ao sair do campo (caso o usuário cole o valor)
        cepInput.addEventListener('blur', function () {
            if (cepInput.value.length === 9) {
                fetchCep(cepInput.value);
            }
        });
    });

})();
