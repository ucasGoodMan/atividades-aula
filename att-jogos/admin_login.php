<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $conn->real_escape_string($_POST['usuario']);
    $senha = $conn->real_escape_string($_POST['senha']);

    $sql = "SELECT * FROM admin WHERE usuario='$usuario' AND senha='$senha'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $admin = $result->fetch_assoc();
        
        // Armazena o nome do admin na sessão
        $_SESSION['admin_nome'] = $admin['usuario'];
        
        // Redireciona para o painel de admin
        header("Location: admin_dashboard.php");
    } else {
        echo "Usuário ou senha incorretos.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css.css">
    <title>Login do admin</title>
</head>
<body>
    <div class="container">
        <form class="login" method="POST" action="admin_dashboard.php">
            <h2 class="titulo">Login do admin</h2>
            <div class="input1">
                <input class="input" type="text" placeholder="Usuário" name="usuario" required />
                <br>
                <input class="input" type="password" placeholder="Senha" name="senha" required />
                <br>
                <input type="submit" value="Login" class="btn-login" />
            </div>
        </form>

    </div>
</body>
</html>