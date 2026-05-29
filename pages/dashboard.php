<?php

require_once("../includes/auth.php");

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <div class="container-dashboard">
        <h1>
            Bem vindo,
            <?= htmlspecialchars($_SESSION['user_name']); ?>
        </h1>

        <a href="../actions/logout_action.php">
            Sair
        </a>

    </div>
</body>

</html>