<?php 
include("../config/database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $nome = trim($_POST["nome"]);
    $email = trim($_POST["email"]);
    $senha = $_POST["senha"];
    $confirmarSenha = $_POST["confirmar_senha"];

    
    if (empty($nome)) {
        die("O nome é obrigatório.");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Email inválido");
    }
    if (strlen($senha) < 8) {
        die("A senha deve ter no mínimo 8 caracteres.");
    }
    if ($senha !== $confirmarSenha) {
        die("As senhas não coincidem.");
    }

    $stmt = $mysqli->prepare(
        "SELECT id
        FROM usuario
        WHERE email = ?"
    );

    $stmt->bind_param("s", $email);
    $stmt->execute();

    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        die("Este email já está cadastrado.");
    }

    }

?>