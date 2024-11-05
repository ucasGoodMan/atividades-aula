<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM jogos WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("location: visualizar_jogos.php");
    } else {
        echo "Erro ao excluir o jogo: " . $conn->error;
    }

    // Redireciona de volta para a página de jogos
    header("Location: visualizar_jogos.php");
    exit();
}
?>