<?php
include 'config.php';

session_start();

// Verifica se o administrador está logado
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

// Consulta para obter todos os jogos
$sql = "SELECT * FROM jogos";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css.css">
    <title>Jogos Disponíveis</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            overflow-x: hidden;
            /* Oculta o overflow horizontal na página */
            overflow-y: scroll;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            /* Permite que os cards se movam para a próxima linha */
            justify-content: center;
            /* Centraliza os cards */
            padding: 20px;
        }

        h1 {
            position: relative;
            top:  100px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .jogo-card {
            background-color: #f4f4f9;
            margin: 10px;
            /* Margem reduzida para melhor espaçamento */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            position: relative;
            width: 300px;
            /* Definindo uma largura fixa para todos os cards */
            height: 400px;
            /* Definindo uma altura fixa para todos os cards */
        }

        .carousel-container {
            width: 100%;
            height: 200px;
            /* Definindo a altura do carrossel */
            position: relative;
            overflow: hidden;
            border-radius: 8px;
        }

        .carousel-images {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }

        .carousel-images img {
            width: 100%;
            height: auto;
            /* Mantém a proporção da imagem */
        }

        .carousel-buttons {
            display: flex;
            justify-content: space-between;
            position: absolute;
            top: 50%;
            width: 100%;
            transform: translateY(-50%);
        }

        .carousel-button {
            background-color: rgba(0, 0, 0, 0.5);
            color: #fff;
            border: none;
            padding: 10px;
            cursor: pointer;
            border-radius: 50%;
        }

        .jogo-card h3 {
            margin-top: 10px;
            text-align: center;
            /* Centraliza o título do jogo */
        }

        .jogo-card p {
            margin: 10px 0;
        }

        .btn-group {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }
        .voltar {
            display: flex;
            justify-content: center;
            text-decoration: none;
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

        .modal {
            display: none;
            /* Oculto por padrão */
            position: fixed;
            /* Fixa o modal na tela */
            z-index: 1000;
            /* Mantém o modal acima de outros elementos */
            left: 0;
            top: 0;
            width: 100%;
            /* Largura total */
            height: 100%;
            /* Altura total */
            overflow: auto;
            /* Permite rolagem se necessário */
            background-color: rgb(0, 0, 0);
            /* Fundo preto */
            background-color: rgba(0, 0, 0, 0.9);
            /* Fundo preto com transparência */
        }

        .modal-content {
            margin: auto;
            display: block;
            width: auto;
            /* Para manter a proporção */
            max-width: 80%;
            /* Limite a largura do modal */
            max-height: 80%;
            /* Limite a altura do modal */
        }

        .close {
            position: absolute;
            top: 15px;
            right: 35px;
            color: white;
            font-size: 40px;
            font-weight: bold;
            cursor: pointer;
        }

        #caption {
            margin: auto;
            display: block;
            text-align: center;
            color: white;
            padding: 10px 0;
        }

    </style>
</head>

<body>
<h1>Jogos</h1>
    <div class="container">

        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="jogo-card">';
                echo '<h3>' . $row["nome"] . '</h3>';

                // Carrossel de Imagens
                echo '<div class="carousel-container">';
                echo '<div class="carousel-images" id="carousel-' . $row["id"] . '">';
                echo '<img src="' . $row["imagem1"] . '" alt="Imagem do Jogo 1" onclick="openModal(\'' . $row["imagem1"] . '\', \'' . $row["nome"] . '\')">'; // Adicionando a função openModal
                echo '<img src="' . $row["imagem2"] . '" alt="Imagem do Jogo 2" onclick="openModal(\'' . $row["imagem2"] . '\', \'' . $row["nome"] . '\')">'; // Adicionando a função openModal
                echo '</div>';
                echo '<div class="carousel-buttons">';
                echo '<button class="carousel-button" onclick="previousSlide(' . $row["id"] . ')">&#10094;</button>';
                echo '<button class="carousel-button" onclick="nextSlide(' . $row["id"] . ')">&#10095;</button>';
                echo '</div>';
                echo '</div>';

                echo '<p>' . $row["descricao"] . '</p>';
                echo '<div class="btn-group">';
                echo '<button class="btn-edit" onclick="window.location.href=\'editar_jogo.php?id=' . $row["id"] . '\'">Editar</button>';
                echo '<button class="btn-delete" onclick="excluirJogo(' . $row["id"] . ')">Excluir</button>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo "<p>Nenhum jogo disponível.</p>";
        }
        ?>

    </div>

    <script>
        function nextSlide(id) {
            const carousel = document.getElementById(`carousel-${id}`);
            carousel.style.transform = 'translateX(-100%)';
        }

        function previousSlide(id) {
            const carousel = document.getElementById(`carousel-${id}`);
            carousel.style.transform = 'translateX(0)';
        }

        function excluirJogo(id) {
            if (confirm("Tem certeza de que deseja excluir este jogo?")) {
                window.location.href = "excluir_jogo.php?id=" + id;
            }
        }

        function openModal(imageSrc, altText) {
            const modal = document.getElementById("imageModal");
            const modalImage = document.getElementById("modalImage");
            const captionText = document.getElementById("caption");

            modal.style.display = "block"; // Exibe o modal
            modalImage.src = imageSrc; // Define a imagem do modal
            captionText.innerHTML = altText; // Define o texto da legenda
        }

        function closeModal() {
            const modal = document.getElementById("imageModal");
            modal.style.display = "none"; // Oculta o modal
        }
    </script>
</body>
<div id="imageModal" class="modal">
    <span class="close" onclick="closeModal()">&times;</span>
    <img class="modal-content" id="modalImage">
    <div id="caption"></div>
</div>
<div class="voltar" style="margin-top: 20px;">
    <a class="btn btn-primary" href="admin_dashboard.php" style="text-decoration: none;" role="button">voltar</a>
</div>

</html>