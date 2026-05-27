<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vaiiiii</title>
</head>

<body>
    <h1>
        <?php
        echo "Olá, Mundo!";
        ?>
    </h1>
    <?php
    date_default_timezone_set("America/Sao_Paulo");
    echo "Hoje é dia " . date("d/m/Y");
    echo " e a hora atual é " . date("G:i:s T");

    $nome = "Esther Azevedo";
    echo "<br>Eu sou a $nome!<br>";
    ?>
</body>

</html>