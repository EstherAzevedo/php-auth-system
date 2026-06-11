<?php
session_start();

$errors = $_SESSION['errors'] ?? [];
$old = $_SESSION['old'] ?? [];

unset($_SESSION['errors']);
unset($_SESSION['old']);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

    <div class="container-login">

        <h1>Tela de Login</h1>

        <form method="POST" action="../actions/login_action.php">
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
                <label for="password">Senha</label>
                <input type="password"
                    id="password"
                    name="password"
                    required>
                <span id="password-feedback"></span>
                <?php if (isset($errors['senha'])): ?>
                    <span class="error-message">
                        <?= htmlspecialchars($errors['senha']) ?>
                    </span>
                <?php endif; ?>
            </div>

            <?php if (isset($_SESSION['erro'])): ?>

                <p class="erro">
                    <?= $_SESSION['erro']; ?>
                </p>

                <?php unset($_SESSION['erro']); ?>

            <?php endif; ?>

            <button
                type="submit"
                id="btn-login"
                disabled>
                Entrar
            </button>
        </form>
    </div>

    <script src="../assets/js/validators.js"></script>
    <script src="../assets/js/login.js"></script>

</body>

</html>