<?php

session_start();
if (!isset($_SESSION['admin_nome'])) {
    // Redireciona para a página de login se o admin não estiver logado
    header("Location: admin_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard do Administrador</title>
    <style>
        body, html {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
        }

        .dashboard-container {
            width: 80%;
            max-width: 700px;
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            text-align: center;
        }

        .nav-bar {
            display: flex;
            overflow-x: auto;
            padding: 10px 0;
            margin-bottom: 20px;
            border-bottom: 2px solid #ddd;
        }

        .nav-bar a {
            flex-shrink: 0;
            padding: 10px 20px;
            margin: 0 5px;
            color: #007BFF;
            text-decoration: none;
            border: 1px solid #ddd;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .nav-bar a:hover {
            background-color: #007BFF;
            color: #ffffff;
        }

        .dashboard-content {
            text-align: center;
            
        }
    </style>
</head>
<body>

<div class="dashboard-container">
    <h2>Dashboard do Administrador</h2>

    <!-- Barra de Navegação -->
    <div class="nav-bar">
        <a href="cadastro_jogo.php">Cadastrar Jogo</a>
        <a href="cadastro_usuario.php">Cadastrar Usuários</a>
        <a href="visualizar_jogos.php">Visualizar Jogos</a>
        <a href="visualizar_usuarios.php">Visualizar Usuários</a>
        <a href="logout.php">Sair</a>
    </div>

    <!-- Conteúdo do Dashboard -->
    <div class="dashboard-content">
        <p>Bem-vindo, admin <?php echo htmlspecialchars($_SESSION['admin_nome']); ?>!</p>
    </div>
</div>

</body>
</html>
