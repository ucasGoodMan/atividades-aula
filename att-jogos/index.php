<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css.css">
    <title>Login do Usuário</title>
</head>
<body>
    <div class="container">
        <form class="login" method="POST" action="login_usuario.php">
            <h2 class="titulo">Login do Usuário</h2>
            <div class="input1">
                <input class="input" type="text" placeholder="Usuário" name="user" required />
                <br>
                <input class="input" type="password" placeholder="Senha" name="senha" required />
                <br>
                <input type="submit" value="Login" class="btn-login" />
            </div>
        </form>

    </div>
</body>
</html>