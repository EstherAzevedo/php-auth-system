<?php

session_start();

require_once("../config/database.php");

if ($_SERVER["REQUEST_METHOD"] !== "POST") {

    header("Location: ../pages/login.php");
    exit();

}

$email = trim($_POST["email"] ?? "");
$senha = $_POST["password"] ?? "";

if (empty($email) || empty($senha)) {
    $_SESSION['erro'] = "Preencha todos os campos.";

    header("Location: ../pages/login.php");
    exit();

}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['erro'] = "Email inválido.";

    header("Location: ../pages/login.php");
    exit();
}

$stmt = $mysqli->prepare(
    "SELECT id,nome, email, senha 
    FROM usuario
    WHERE email = ?"
);

$stmt->bind_param("s", $email);
$stmt->execute();

$resultado = $stmt->get_result();

if ($resultado->num_rows !== 1) {
    $_SESSION['erro'] = "Email ou senha inválidos.";

    header("Location: ../pages/login.php");
    exit();

}

$usuario = $resultado->fetch_assoc();

if (!password_verify($senha, $usuario['senha'])) {
    $_SESSION['erro'] = "Email ou senha inválido";

    header("Location: ../pages/login.php");
    exit();

}

$_SESSION['user_id'] = $usuario['id'];
$_SESSION['user_name'] = $usuario['nome'];
$_SESSION['user_email'] = $usuario['email'];

header("Location: ../pages/dashboard.php");
exit();    

?>