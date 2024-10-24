<?php

$hostname = "127.0.0.1";
$user = "root";
$password = "root";
$database = "banco";

$conexao = new mysqli($hostname, $user, $password, $database);

if ($conexao->connect_errno) {
    echo "Failed to connect to MySQL: " . $conexao->connect_error;
    exit();
} else {
    // Verifica se o nome do cliente foi enviado e não está vazio
    if (isset($_POST['nome_cliente']) && !empty(trim($_POST['nome_cliente']))) {
        // Evita caracteres especiais (SQL Inject)
        $nome_cliente = $conexao->real_escape_string(trim($_POST['nome_cliente']));

        $sql = "INSERT INTO `clientes` (`nome_cliente`) VALUES ('$nome_cliente')";

        // Verifica se a inserção foi bem-sucedida
        if ($conexao->query($sql) === TRUE) {
            $conexao->close();
            header('Location: site.php', true, 301);
            exit();
        } else {
            echo "Erro ao inserir o cliente: " . $conexao->error;
        }
    } else {
        echo "O nome do cliente não pode estar vazio!";
    }
    
    $conexao->close();
}
