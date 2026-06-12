<?php

require_once("../includes/auth.php");

$dataAtual = date("d/m/Y H:i:s");

$nomeServidor = gethostname();

$ipServidor = $_SERVER['SERVER_ADDR'] ?? 'Indisponível';

require_once("../config/database.php");

$result = $mysqli->query(
    "SELECT COUNT(*) AS total FROM usuario"
);

$totalUsuarios = $result->fetch_assoc()['total'];
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

        <header class="dashboard-header">
            <h1>Auth System</h1>

            <p>
                Sistema de autenticação desenvolvido em PHP,
                JavaScript e MySQL, hospedado na AWS EC2.
            </p>

            <span class="version-badge">v1.0.0</span>
        </header>

        <div class="dashboard-grid">

            <section class="card">
                <h2>👤 Usuário Logado</h2>

                <p>
                    <strong>Nome:</strong>
                    <?= htmlspecialchars($_SESSION['user_name']); ?>
                </p>

                <p class="system-status">
                    ✅ Autenticado
                </p>
            </section>

            <section class="card">
                <h2>📅 Data e Hora</h2>

                <p><?= $dataAtual ?></p>
            </section>

            <section class="card">
                <h2>☁️ Infraestrutura</h2>

                <p><strong>Hospedagem:</strong> AWS EC2</p>
                <p><strong>SO:</strong> Ubuntu 24.04 LTS</p>
                <p><strong>Servidor:</strong> Apache2</p>
                <p><strong>Banco:</strong> MariaDB</p>
                <p><strong>Hostname:</strong> <?= $nomeServidor ?></p>
            </section>

            <section class="card">
                <h2>📊 Estatísticas</h2>

                <p>
                    <strong>Usuários cadastrados:</strong>
                    <?= $totalUsuarios ?>
                </p>

                <p>
                    <strong>Versão:</strong>
                    1.0.0
                </p>
            </section>

            <section class="card">
                <h2>ℹ️ Sobre o Sistema</h2>

                <p>
                    Projeto desenvolvido para estudo de autenticação,
                    sessões, segurança web e deploy em nuvem.
                </p>
            </section>

            <section class="card">
                <h2>🚀 Roadmap</h2>

                <ul>
                    <li>✅ Cadastro</li>
                    <li>✅ Login</li>
                    <li>✅ Logout</li>
                    <li>✅ Proteção de rotas</li>
                    <li>🔜 Perfil de usuário</li>
                    <li>🔜 Alteração de senha</li>
                    <li>🔜 Recuperação de senha</li>
                </ul>
            </section>

        </div>

        <div class="logout-container">
            <a
                href="../actions/logout_action.php"
                class="logout-btn">
                Sair
            </a>
        </div>

    </div>
</body>

</html>