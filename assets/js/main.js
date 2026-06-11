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

const userInteraction = {
    nome: false,
    email: false,
    senha: false,
    confirmarSenha: false
};

function clearFeedback(feedbackEl) {
    feedbackEl.textContent = "";
    feedbackEl.classList.remove("feedback-erro");
}

function showError(feedbackEl, message) {
    feedbackEl.textContent = message;
    feedbackEl.classList.add("feedback-erro");
}

const regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

const validators = {
    nome: value => value.trim().length >= 3,
    email: value => regexEmail.test(value.trim()),
    senha: value => value.length >= 8,
    confirmarSenha: (value, all) => all.senha.value !== "" && value === all.senha.value
};

const messages = {
    nome: "O nome deve possuir pelo menos 3 caracteres.",
    email: "Informe um email válido.",
    senha: "A senha deve possuir pelo menos 8 caracteres.",
    confirmarSenha: "As senhas não coincidem."
};

function validateField(key) {
    const field = elems[key];
    const feedbackEl = elems[`${key === 'confirmarSenha' ? 'confirmarFeedback' : key + 'Feedback'}`];
    const isValid = typeof validators[key] === 'function'
        ? validators[key](field.value, elems)
        : true;

    if (isValid) {
        clearFeedback(feedbackEl);
    } else {
        if (userInteraction[key]) {
            showError(feedbackEl, messages[key]);
        } else if (feedbackEl.textContent.trim() === "") {
            clearFeedback(feedbackEl);
        }
    }

    return isValid;
}

function validateAll() {
    const keys = ["nome", "email", "senha", "confirmarSenha"];
    const results = keys.map(k => validateField(k));
    elems.btnCadastrar.disabled = !results.every(Boolean);
}

["nome", "email", "senha", "confirmarSenha"].forEach(key => {
    elems[key].addEventListener('input', () => {
        userInteraction[key] = true;
        validateAll();
    });
});

if (elems.nome.value !== "" || elems.email.value !== "") {
    validateAll();
}