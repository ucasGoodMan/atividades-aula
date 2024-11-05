<?php
include 'config.php';

session_start();

// Verifica se o administrador está logado
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome_jogo = $conn->real_escape_string($_POST['nome_jogo']);
    $genero_jogo = $conn->real_escape_string($_POST['genero']);
    $descricao = $conn->real_escape_string($_POST['descricao']);

    // Carregar as imagens
    $imagem1 = $_FILES['imagem1']['name'];
    $imagem2 = $_FILES['imagem2']['name'];

    // Definir o caminho para salvar as imagens
    $diretorio = 'uploads/';
    $caminho1 = $diretorio . $nome_jogo . '_1_' . time() . '.' . pathinfo($imagem1, PATHINFO_EXTENSION);
    $caminho2 = $diretorio . $nome_jogo . '_2_' . time() . '.' . pathinfo($imagem2, PATHINFO_EXTENSION);

    // Salvar as imagens
    if (move_uploaded_file($_FILES['imagem1']['tmp_name'], $caminho1) && move_uploaded_file($_FILES['imagem2']['tmp_name'], $caminho2)) {
        // Inserir os dados no banco de dados
        $sql = "INSERT INTO jogos (nome, genero, descricao, imagem1, imagem2) VALUES ('$nome_jogo', '$genero_jogo', '$descricao', '$caminho1', '$caminho2')";
        if ($conn->query($sql) === TRUE) {
            echo "Jogo cadastrado com sucesso!";
        } else {
            echo "Erro ao cadastrar jogo: " . $conn->error;
        }
    } else {
        echo "Erro ao enviar as imagens.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css.css">
    <title>Cadastro de Jogo</title>
    <style>
        .container {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 85vh;
        }

        .form-jogo {
            width: 50%;
            max-width: 500px;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            text-align: center;
        }

        .form-jogo label,
        .form-jogo input,
        .form-jogo select,
        .form-jogo textarea {
            display: block;
            width: 100%;
            margin-bottom: 15px;
        }

        .form-jogo input[type="submit"] {
            cursor: pointer;
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .form-jogo input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .voltar {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <form class="form-jogo" method="POST" enctype="multipart/form-data">
            <h2>Cadastrar Jogo</h2>

            <label for="nome_jogo">Nome do Jogo</label>
            <input type="text" name="nome_jogo" id="nome_jogo" required>

            <label for="genero">Gênero do Jogo</label>
            <select name="genero" id="genero" required>
                <option value="">Selecione o gênero</option>
                <option value="Ação">Ação</option>
                <option value="Aventura">Aventura</option>
                <option value="RPG">RPG</option>
                <option value="Esportes">Esportes</option>
                <option value="Simulação">Simulação</option>
                <option value="Estratégia">Estratégia</option>
                <option value="Terror">Terror</option>
                <option value="Puzzle">Puzzle</option>
            </select>

            <label for="descricao">Descrição</label>
            <textarea name="descricao" id="descricao" rows="3" required></textarea>

            <label for="imagem1">Imagem 1</label>
            <input type="file" name="imagem1" id="imagem1" accept="image/*" required>

            <label for="imagem2">Imagem 2</label>
            <input type="file" name="imagem2" id="imagem2" accept="image/*" required>

            <input type="submit" value="Cadastrar Jogo">
        </form>
    </div>

    <!-- Botão de Voltar -->
    <div class="voltar" style="margin-top: 20px;">
        <a class="btn btn-primary" href="admin_dashboard.php" style="text-decoration: none;" role="button">voltar</a>
    </div>
</body>

</html>