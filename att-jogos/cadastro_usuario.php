<?php
include 'config.php';

session_start();

// Verifica se o administrador está logado
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = $conn->real_escape_string($_POST['user']);
    $senha = hash('sha256', $_POST['senha']);

    $sql = "INSERT INTO usuarios (user, senha) VALUES ('$user', '$senha')";
    if ($conn->query($sql) === TRUE) {
        echo "Usuário cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar usuário: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css.css">
    <title>Cadastro</title>
</head>

<body>
    <div class="container">
        <form class="login" method="POST">
            <h2 class="titulo">Cadastro de usuário</h2>
            <div class="input1">
                <input class="input" type="user" placeholder="Usuário" name="user" id="user" required />
                <br>
                <input class="input" type="password" placeholder="Senha" name="senha" id="senha" required />
                <br>
                <input type="submit" value="Cadastrar" class="btn-login" id="botao" />
            </div>
        </form>

        <!-- Botão de Voltar -->
        <div class="voltar" style="margin-top: 20px;">
            <a class="btn btn-primary" href="admin_dashboard.php" style="text-decoration: none;" role="button">voltar</a>
        </div>
    </div>
</body>

</html>