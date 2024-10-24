<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['id'])) {
    // Se não estiver logado, redireciona para a página de login
    header('Location: ../../index.php');
    exit();
}

// Conexão com o banco de dados
$hostname = "127.0.0.1";
$user = "root";
$password = "root";
$database = "banco";

$conexao = new mysqli($hostname, $user, $password, $database);

if ($conexao->connect_errno) {
    die("Failed to connect to MySQL: " . $conexao->connect_error);
}

// Consulta as turmas existentes
$sql = "SELECT * FROM `clientes`";
$resultado = $conexao->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de cliente</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 80%;
            max-width: 1200px;
            box-sizing: border-box;
            max-height: 70vh;
            overflow-y: auto;
        }

        .container::-webkit-scrollbar {
            width: 10px;
        }

        .container::-webkit-scrollbar-track {
            background: #f2f2f2;
            border-radius: 6px;
        }

        .container::-webkit-scrollbar-thumb {
            background-color: rgb(37, 91, 168);
            border-radius: 6px;
            border: 2px solid #ffffff;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid rgb(37, 91, 168);
            padding-bottom: 10px;
            margin-bottom: 30px;
        }

        .header h1 {
            color: rgb(37, 91, 168);
            font-size: 28px;
            margin: 0;
        }

        .button-79 {
            background-color: rgb(37, 91, 168);
            /* Azul */
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            text-align: center;
            display: inline-block;
            margin-bottom: 20px;
            transition: background-color 0.3s ease;
        }

        .button-79:hover {
            background-color: rgb(37, 91, 168);
            /* Azul mais escuro */
        }

        .logout-button {
            display: inline-block;
            background-color: rgb(37, 91, 168);
            /* Azul */
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            font-size: 16px;
            margin-bottom: 20px;
        }

        .logout-button:hover {
            background-color: rgb(37, 91, 168);
            /* Azul mais escuro */
        }

        .divTable {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        thead {
            background-color: #f2f2f2;
            /* Azul */
            color: black;
        }

        th,
        td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            font-weight: bold;
        }

        button {
            background-color: rgb(37, 91, 168);
            /* Azul */
            color: white;
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            margin: 2px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: rgb(37, 91, 168);
            /* Azul mais escuro */
        }

        .modal-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            visibility: hidden;
            opacity: 0;
            transition: visibility 0s, opacity 0.3s ease;
        }

        .modal-container.active {
            visibility: visible;
            opacity: 1;
        }

        .modal {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            width: 400px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .modal label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        .modal input[type="number"],
        .modal input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        .modal button {
            background-color: rgb(37, 91, 168);
            /* Azul */
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            display: block;
            width: 100%;
            transition: background-color 0.3s ease;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1 class="cadastro">Cadastro de cliente</h1>
        </div>
        <button class="button-79" onclick="openModal()">Adicionar cliente</button>

        <div class="divTable">
            <table>
                <thead>
                    <tr>
                        <th>N° cliente</th>
                        <th>Nome do cliente</th>    
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $resultado->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['id']) ?></td>
                            <td><?= htmlspecialchars($row['nome_cliente']) ?></td>
                            <td>
                                <button onclick="deleteTurma(<?= $row['id'] ?>)">Excluir</button>
                                <button onclick="window.location.href='alunos.php?turma_id=<?= $row['id'] ?>'">Editar</button>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal-container" id="modal">
        <div class="modal">
            <form id="formulario" method="post" action="process.php">
                <input type="hidden" id="id" name="id">
                <label for="nome_cliente">Nome do cliente</label>
                <input id="nome_cliente" name="nome_cliente" type="text" required />
                <button id="botao" type="submit">Salvar</button>
            </form>
        </div>
    </div>

    <script>
        function openModal() {
            document.getElementById('modal').classList.add('active');
        }

        function closeModal() {
            document.getElementById('modal').classList.remove('active');
        }

        function editTurma(id, nome_cliente) {
            document.getElementById('id').value = id;
            document.getElementById('nome_cliente').value = nome_cliente;
            openModal();
        }

        function deleteTurma(id) {
            if (confirm('Tem certeza de que deseja excluir este cliente?')) {
                window.location.href = 'delete.php?id=' + id;
            }
        }
    </script>

</body>

</html>