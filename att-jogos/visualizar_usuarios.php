<?php
include 'config.php';

session_start();

// Verifica se o administrador está logado
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

// Consulta para obter todos os usuários
$sql = "SELECT * FROM usuarios";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css.css">
    <title>Visualizar Usuários</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            overflow-x: hidden;
            overflow-y: scroll;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }

        .user-card {
            background-color: white;
            width: 100%;
            max-width: 400px;
            margin: 20px 0;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            position: relative;
        }

        .user-card h3 {
            margin-bottom: 10px;
            font-size: 1.2em;
        }

        .btn-group {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .btn-edit,
        .btn-delete {
            padding: 8px 12px;
            border: none;
            color: #fff;
            cursor: pointer;
            border-radius: 4px;
        }

        .btn-edit {
            background-color: #007BFF;
        }

        .btn-delete {
            background-color: #FF4D4D;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Usuários Cadastrados</h1>

        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="user-card">';
                echo '<h3>Usuário: ' . htmlspecialchars($row["user"]) . '</h3>';

                echo '<div class="btn-group">';
                echo '<button class="btn-delete" onclick="excluirUsuario(' . $row["id"] . ')">Excluir</button>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo "<p>Nenhum usuário cadastrado.</p>";
        }
        ?>

        <!-- Botão de Voltar -->
        <div class="voltar" style="margin-top: 20px;">
            <a class="btn btn-primary" href="admin_dashboard.php" style="text-decoration: none;" role="button">Voltar</a>
        </div>
    </div>

    <script>
        function excluirUsuario(id) {
            if (confirm("Tem certeza de que deseja excluir este usuário?")) {
                window.location.href = "excluir_usuario.php?id=" + id;
            }
        }
    </script>
</body>

</html>