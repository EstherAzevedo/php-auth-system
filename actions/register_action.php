<?php

session_start();

require_once("../config/database.php");

if ($_SERVER["REQUEST_METHOD"] !== "POST") {

    header("Location: ../pages/register.php");
    exit();
}

$nome = trim($_POST["nome"] ?? "");
$email = trim($_POST["email"] ?? "");
$senha = $_POST["senha"] ?? "";
$confirmarSenha = $_POST["confirmar_senha"] ?? "";

$errors = [];

$_SESSION['old'] = [

    'nome' => $nome,
    'email' => $email

];


if (strlen($nome) < 3) {

    $errors['nome'] =
        "O nome deve possuir pelo menos 3 caracteres.";
}

if (!filter_var(
        $email,
        FILTER_VALIDATE_EMAIL
    )
) {
    $errors['email'] =
        "Informe um email válido.";
}

if (strlen($senha) < 8) {

    $errors['senha'] =
        "A senha deve possuir pelo menos 8 caracteres.";
}

if ($senha !== $confirmarSenha) {

    $errors['confirmar_senha'] =
        "As senhas não coincidem.";
}

if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    header("Location: ../pages/register.php");
    exit();
}

$stmt = $mysqli->prepare(
    "SELECT id
     FROM usuario
     WHERE email = ?"
);
$stmt->bind_param("s", $email);
$stmt->execute();
$resultado =  $stmt->get_result();

if ($resultado->num_rows > 0) {

    $errors['email'] =
        "O email $email já está cadastrado.";
}

if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    header("Location: ../pages/register.php");
    exit();
}

$senhaHash = password_hash(
    $senha,
    PASSWORD_DEFAULT
);

$stmt = $mysqli->prepare(
    "INSERT INTO usuario(
        nome,
        email,
        senha)
    VALUES(?, ?, ?)"
);

$stmt->bind_param(
    "sss",
    $nome,
    $email,
    $senhaHash
);

if (!$stmt->execute()) {

    $_SESSION['errors'] = [

        'geral' =>
        'Erro ao cadastrar usuário.'

    ];

    header("Location: ../pages/register.php");
    exit();
}

unset($_SESSION['old']);

header(
    "Location: ../pages/login.php"
);

exit();
