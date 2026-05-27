<?php
$host = "localhost";
$usuario = "esther";
$senha = "225423";
$bd = "sistema_login";

$mysqli = new mysqli($host, $usuario, $senha, $bd);
if ($mysqli->connect_error) {
    die("Falha na conexão: " . $mysqli->connect_error);
}
?>