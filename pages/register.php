<?php
session_start();

$errors = $_SESSION['errors'] ?? [];
$old = $_SESSION['old'] ?? [];

unset($_SESSION['errors']);
unset($_SESSION['old']);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Cadastro</title>
</head>

<body>
    <div class="container-register">
        <h1>Criar Conta</h1>

        <form action="../actions/register_action.php" method="POST" novalidate>

            <div>
                <label for="nome">Nome</label>

                <input
                    type="text"
                    id="nome"
                    name="nome"
                    value="<?= htmlspecialchars($old['nome'] ?? '') ?>"
                    required>

                <span id="nome-feedback"></span>

                <?php if (isset($errors['nome'])): ?>
                    <span class="error-message">
                        <?= htmlspecialchars($errors['nome']) ?>
                    </span>
                <?php endif; ?>
            </div>

            <div>
                <label for="email">Email</label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    value="<?= htmlspecialchars($old['email'] ?? '') ?>"
                    required>

                <span id="email-feedback"></span>

                <?php if (isset($errors['email'])): ?>
                    <span class="error-message">
                        <?= htmlspecialchars($errors['email']) ?>
                    </span>
                <?php endif; ?>
            </div>

            <div>
                <label for="senha">Senha</label>

                <input
                    type="password"
                    id="senha"
                    name="senha"
                    required>

                <span id="senha-feedback"></span>

                <?php if (isset($errors['senha'])): ?>
                    <span class="error-message">
                        <?= htmlspecialchars($errors['senha']) ?>
                    </span>
                <?php endif; ?>
            </div>

            <div>
                <label for="confirmar_senha">
                    Confirmar Senha
                </label>

                <input
                    type="password"
                    id="confirmar_senha"
                    name="confirmar_senha"
                    required>

                <span id="confirmar-feedback"></span>

                <?php if (isset($errors['confirmar_senha'])): ?>
                    <span class="error-message">
                        <?= htmlspecialchars($errors['confirmar_senha']) ?>
                    </span>
                <?php endif; ?>
            </div>

            <button
                type="submit"
                id="btn-cadastrar"
                disabled>
                Cadastrar
            </button>

        </form>
    </div>
    <script src="../assets/js/main.js"></script>
</body>

</html>