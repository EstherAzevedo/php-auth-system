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

    }

?>