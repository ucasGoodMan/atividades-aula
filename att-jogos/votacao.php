<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_usuario = $_POST['id_usuario']; // Obtenha o ID do usuário logado
    $id_jogo = $_POST['id_jogo'];
    $voto = $conn->real_escape_string($_POST['voto']);
    $descricao = $conn->real_escape_string($_POST['descricao']);

    $sql = "INSERT INTO avaliacoes (id_usuario, id_jogo, voto, descricao) VALUES ('$id_usuario', '$id_jogo', '$voto', '$descricao')";
    if ($conn->query($sql) === TRUE) {
        echo "Votação registrada com sucesso!";
    } else {
        echo "Erro ao registrar votação: " . $conn->error;
    }
}
?>

<form method="post">
    <input type="hidden" name="id_usuario" value="<!-- ID do usuário logado -->">
    <label>ID do Jogo:</label>
    <input type="text" name="id_jogo" required>
    <label>Voto:</label>
    <select name="voto" required>
        <option value="like">Like</option>
        <option value="dislike">Dislike</option>
    </select>
    <label>Descrição:</label>
    <textarea name="descricao"></textarea>
    <button type="submit">Votar</button>
</form>
