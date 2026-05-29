<?php 
session_start();
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

    <?php if (isset($_SESSION['erro'])): ?>

        <p class="erro">
            <?= $_SESSION['erro']; ?>
        </p>

        <?php unset($_SESSION['erro']); ?>

    <?php endif; ?>

<form method="POST" action="../actions/login_action.php">
    <div>
        <label for="email">E-mail</label>
        <input type="email" id="email" name="email" required>
    </div>
    <div>
        <label for="password">Senha</label>
        <input type="password" id="password" name="password" required>
    </div>
    <button type="submit">Entrar</button>
</form>
</div>

</body>
</html>