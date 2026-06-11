/* register.js
 * Validação específica para a página de registro.
 * Depende de `validators.js` ter sido carregado antes.
 */
(function () {
    if (typeof window.validators === 'undefined') return;

    const elems = {
        nome: document.getElementById("nome"),
        email: document.getElementById("email"),
        senha: document.getElementById("senha"),
        confirmarSenha: document.getElementById("confirmar_senha"),
        btnCadastrar: document.getElementById("btn-cadastrar"),
        nomeFeedback: document.getElementById("nome-feedback"),
        emailFeedback: document.getElementById("email-feedback"),
        senhaFeedback: document.getElementById("senha-feedback"),
        confirmarFeedback: document.getElementById("confirmar-feedback")
    };

    // Se não estivermos na página de registro, aborta
    if (!elems.nome || !elems.btnCadastrar) return;

    const userInteraction = { nome: false, email: false, senha: false, confirmarSenha: false };

    function clearFeedback(feedbackEl) {
        if (!feedbackEl) return;
        feedbackEl.textContent = "";
        feedbackEl.classList.remove("feedback-erro");
    }

    function showError(feedbackEl, message) {
        if (!feedbackEl) return;
        feedbackEl.textContent = message;
        feedbackEl.classList.add("feedback-erro");
    }

    const messages = {
        nome: "O nome deve possuir pelo menos 3 caracteres.",
        email: "Informe um email válido.",
        senha: "A senha deve possuir pelo menos 8 caracteres.",
        confirmarSenha: "As senhas não coincidem."
    };

    function validateField(key) {
        const field = elems[key];
        const feedbackEl = elems[`${key === 'confirmarSenha' ? 'confirmarFeedback' : key + 'Feedback'}`];
        if (!field) return true;

        let isValid = true;
        const v = field.value;

        if (key === 'nome') isValid = validators.isName(v);
        else if (key === 'email') isValid = validators.isEmail(v);
        else if (key === 'senha') isValid = validators.isPassword(v);
        else if (key === 'confirmarSenha') isValid = validators.passwordsMatch(v, elems.senha.value);

        if (isValid) {
            clearFeedback(feedbackEl);
        } else {
            if (userInteraction[key]) {
                showError(feedbackEl, messages[key]);
            } else if (feedbackEl && feedbackEl.textContent.trim() === "") {
                clearFeedback(feedbackEl);
            }
        }

        return isValid;
    }

    function validateAllRegister() {
        const keys = ["nome", "email", "senha", "confirmarSenha"];
        const results = keys.map(k => validateField(k));
        elems.btnCadastrar.disabled = !results.every(Boolean);
    }

    ["nome", "email", "senha", "confirmarSenha"].forEach(key => {
        const el = elems[key];
        if (!el) return;
        el.addEventListener('input', () => {
            userInteraction[key] = true;
            validateAllRegister();
        });
    });

    if ((elems.nome && elems.nome.value !== "") || (elems.email && elems.email.value !== "")) {
        validateAllRegister();
    }

})();
