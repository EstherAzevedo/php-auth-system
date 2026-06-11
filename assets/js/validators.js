(function () {
    const regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    window.validators = {
        isName: value => typeof value === 'string' && value.trim().length >= 3,
        isEmail: value => typeof value === 'string' && regexEmail.test(value.trim()),
        isPassword: value => typeof value === 'string' && value.length >= 8,
        passwordsMatch: (confirmValue, originalValue) =>
            typeof confirmValue === 'string' && typeof originalValue === 'string' && originalValue !== '' && confirmValue === originalValue
    };
})();
