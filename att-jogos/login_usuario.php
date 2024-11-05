<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = $conn->real_escape_string($_POST['user']);
    $senha = hash('sha256', $_POST['senha']);

    // Verifica se o usuário existe e a senha está correta
    $sql = "SELECT id, user FROM usuarios WHERE user = '$user' AND senha = '$senha'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows === 1) {
        // Autenticação bem-sucedida
        $userData = $result->fetch_assoc();
        $_SESSION['user_id'] = $userData['id'];
        $_SESSION['user_user'] = $userData['user'];

        // Redireciona para a página principal do usuário
        header("Location: user_dashboard.php");
        exit();
    } else {
        echo "<p>Usuário ou senha incorretos!</p>";
    }
}
?>
