<?php
$hostname = "127.0.0.1";
$user = "root";
$password = "root";
$database = "banco";

$conexao = new mysqli($hostname, $user, $password, $database);

if ($conexao -> connect_errno) {
    echo "Failed to connect to MySQL: " . $conexao -> connect_error;
    exit();
} else {
    // Evita caracteres especiais (SQL Inject)
    $user = $conexao -> real_escape_string($_POST['user']);
    $senha = $conexao -> real_escape_string($_POST['senha']);

    // Verifica se o email e senha coincidem com algum registro no banco de dados
    $sql="SELECT `user` FROM `login`
          WHERE `user` = '".$user."'
          AND `senha` = '".$senha."';";

    $resultado = $conexao->query($sql);

    if($resultado->num_rows != 0) {
        session_start();
        $row = $resultado -> fetch_array();
        $_SESSION['id'] = $row['user'];  // Armazena o email na sessão
        $conexao -> close();

        // Redireciona para a página protegida
        header('Location: site.php' ,  true,  301);
        exit();
    } else {
        $conexao -> close();
        // Redireciona de volta para a página de login em caso de falha
        header('Location: index.php' ,  true,  301);
        exit();
    }
}
?>