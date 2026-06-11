/* login.js
 * Validação da tela de login.
 * Depende de `validators.js` ter sido carregado antes.
 */
(function () {
    if (typeof window.validators === 'undefined') return;

    const elems = {
        email: document.getElementById('email'),
        password: document.getElementById('password'),
        btnLogin: document.getElementById('btn-login'),
        emailFeedback: document.getElementById('email-feedback'),
        passwordFeedback: document.getElementById('password-feedback')
    };

    // Se não estivermos na página de login, aborta
    if (!elems.email || !elems.btnLogin) return;

    const userInteraction = { email: false, password: false };

    function clearFeedback(feedbackEl) {
        if (!feedbackEl) return;
        feedbackEl.textContent = "";
        feedbackEl.classList.remove('feedback-erro');
    }

    function showError(feedbackEl, message) {
        if (!feedbackEl) return;
        feedbackEl.textContent = message;
        feedbackEl.classList.add('feedback-erro');
    }

    const messages = {
        email: 'Informe um email válido.',
        password: 'A senha deve possuir pelo menos 8 caracteres.'
    };

    function validateLogin() {
        const okEmail = validators.isEmail(elems.email.value);
        const okPassword = validators.isPassword(elems.password.value);

        if (!okEmail) {
            if (userInteraction.email) showError(elems.emailFeedback, messages.email);
            else clearFeedback(elems.emailFeedback);
        } else clearFeedback(elems.emailFeedback);

        if (!okPassword) {
            if (userInteraction.password) showError(elems.passwordFeedback, messages.password);
            else clearFeedback(elems.passwordFeedback);
        } else clearFeedback(elems.passwordFeedback);

        elems.btnLogin.disabled = !(okEmail && okPassword);
        return okEmail && okPassword;
    }

    elems.email.addEventListener('input', () => {
        userInteraction.email = true;
        validateLogin();
    });

    elems.password.addEventListener('input', () => {
        userInteraction.password = true;
        validateLogin();
    });

    // valida se o formulário já vier preenchido (ex.: valor antigo)
    if ((elems.email && elems.email.value !== '') || (elems.password && elems.password.value !== '')) {
        validateLogin();
    }

})();
