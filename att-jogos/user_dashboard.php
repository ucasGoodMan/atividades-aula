<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    header("Location: login_usuario.php");
    exit();
}

// Dados do usuário logado
$user = $_SESSION['user_user'];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css.css">
    <title>Painel do Usuário</title>
</head>
<body>
    <div class="container">
        <h2>Bem-vindo, <?php echo htmlspecialchars($user); ?>!</h2>
        <p>Esta é sua página inicial. Navegue e explore as opções.</p>

        <!-- Botão de Logout -->
        <div class="logout">
            <a href="logout.php" class="btn btn-primary">Logout</a>
        </div>
    </div>
</body>
</html>
