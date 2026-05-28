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

        <form action="../actions/register_action.php" method="POST">
            <div>
                <label>Nome</label>
                <input type="text" name="nome" required>
            </div>
            <div>
                <label>Email</label>
                <input type="email" name="email" required>
            </div>
            <div>
                <label>Senha</label>
                <input type="password" name="senha" required>
            </div>
            <div>
                <label>Confirmar Senha</label>
                <input type="password" name="confirmar_senha" required>
            </div>

            <button type="submit">Cadastrar</button>

        </form>
    </div>
</body>

</html>