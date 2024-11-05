<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM usuarios WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Usuário excluído com sucesso!";
    } else {
        echo "Erro ao excluir usuário: " . $conn->error;
    }

    // Redireciona de volta para a página de usuários
    header("Location: visualizar_usuarios.php");
    exit();
}
?>
