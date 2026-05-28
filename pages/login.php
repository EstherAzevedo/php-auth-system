<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("../config/database.php");
/**$_SERVER é um array superglobal do PHP.
Ele contém informações sobre a requisição atual, 
servidor, navegador do usuário etc. 

["REQUEST_METHOD"] == "POST"
Ela informa qual método HTTP foi 
utilizado para acessar a página.*/

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $senha = $_POST["password"];

    // O objeto $mysqli agora já está instanciado e pronto para uso
    $stmt = $mysqli->prepare(
        "SELECT codigo, email, senha
         FROM usuario
         WHERE email = ?"
    );

    $stmt->bind_param("s", $email);
    $stmt->execute();

    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $usuario = $resultado->fetch_assoc();

        if (password_verify($senha, $usuario['senha'])) {
            echo "Login realizado com sucesso!";
        } else {
            echo "Senha incorreta!";
        }
    } else {
        echo "Usuário não encontrado!";
    }
    
}
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

<form method="POST">
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