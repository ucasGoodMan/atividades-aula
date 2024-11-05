<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nome = $conn->real_escape_string($_POST['nome']);
    $genero = $conn->real_escape_string($_POST['genero']);
    $descricao = $conn->real_escape_string($_POST['descricao']);
    
    // Aqui você deve implementar a lógica para atualizar as imagens, se necessário

    $sql = "UPDATE jogos SET nome='$nome', genero='$genero', descricao='$descricao' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("location: visualizar_jogos.php");
    } else {
        echo "Erro ao atualizar o jogo: " . $conn->error;
    }
}

$id = $_GET['id'];
$sql = "SELECT * FROM jogos WHERE id=$id";
$result = $conn->query($sql);
$game = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css.css">
    <title>Editar Jogo</title>
</head>

<body>
    <div class="container">
        <h2>Editar Jogo</h2>
        <form method="POST">
            <input type="hidden" name="id" value="<?php echo $game['id']; ?>">
            <div>
                <label for="nome">Nome do Jogo:</label>
                <input type="text" name="nome" value="<?php echo $game['nome']; ?>" required>
            </div>
            <div>
                <label for="genero">Gênero:</label>
                <input type="text" name="genero" value="<?php echo $game['genero']; ?>" required>
            </div>
            <div>
                <label for="descricao">Descrição:</label>
                <textarea name="descricao" required><?php echo $game['descricao']; ?></textarea>
            </div>
            <div>
                <input type="submit" value="Salvar">
            </div>
        </form>
    </div>
</body>
</html>
