<?php


// Iniciar a sessão para verificar se o usuário está autenticado
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

// Incluir arquivo de conexão com o banco de dados
include('conexao.php');

// Buscar informações do usuário no banco de dados
$email = $_SESSION['email'];

$sql_usuario = "SELECT nome, email FROM usuarios WHERE email = '$email'";
$result_usuario = $conn->query($sql_usuario);

if ($result_usuario->num_rows > 0) {
    $row_usuario = $result_usuario->fetch_assoc();
    $nome = $row_usuario['nome'];
    $email = $row_usuario['email'];
} else {
    echo "Erro ao buscar informações do usuário";
    exit;
}

// Buscar histórico de pedidos do usuário no banco de dados
$sql_pedidos = "SELECT id, data, total FROM pedidos WHERE usuario_email = '$email' ORDER BY data DESC";
$result_pedidos = $conn->query($sql_pedidos);

// Verificar se o formulário de feedback foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["feedback"])) {
    $feedback = $_POST["feedback"];
    
    // Preparar e executar a inserção do feedback no banco de dados
    $sql_insert_feedback = "INSERT INTO feedbacks (usuario_email, mensagem) VALUES ('$email', '$feedback')";
    
    if ($conn->query($sql_insert_feedback) === TRUE) {
        echo "";
    } else {
        echo "Erro ao enviar feedback: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Minha Conta</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: antiquewhite;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: aliceblue;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        .info {
            margin-bottom: 20px;
        }
        .info label {
            font-weight: bold;
        }
        .history {
            margin-top: 20px;
        }
        .history table {
            width: 100%;
            border-collapse: collapse;
        }
        .history th, .history td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }
        .history th {
            background-color: #f2f2f2;
        }
        .feedback {
            margin-top: 20px;
        }
        .feedback textarea {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .feedback button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .feedback button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Minha Conta</h2>
        
        <div class="info">
            <label for="nome">Nome:</label>
            <p><?php echo $nome; ?></p>
        </div>
        <div class="info">
            <label for="email">Email:</label>
            <p><?php echo $email; ?></p>
        </div>
        
        <div class="history">
            <h3>Histórico de Pedidos</h3>
            <table>
                <tr>
                    <th>ID do Pedido</th>
                    <th>Data do Pedido</th>
                    <th>Total</th>
                </tr>
                <?php
                if ($result_pedidos->num_rows > 0) {
                    while ($row_pedido = $result_pedidos->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row_pedido['id'] . "</td>";
                        echo "<td>" . $row_pedido['data'] . "</td>";
                        echo "<td>R$ " . number_format($row_pedido['total'], 2, ',', '.') . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>Nenhum pedido encontrado.</td></tr>";
                }
                ?>
            </table>
        </div>

        <div class="feedback">
            <h3>Deixe seu Feedback</h3>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <textarea name="feedback" cols="30" rows="5" placeholder="Digite aqui seu feedback" required></textarea>
                <br>
                <button type="submit">Enviar Feedback</button>
            </form>
        </div>

        <div class="profile">
            <h3>Opções de Perfil</h3>
            <p><a href="alterar_senha.php">Alterar Senha</a></p>
            <!-- Adicione mais opções de perfil conforme necessário -->
        </div>

        <div class="info">
            <label for="logout">Logout:</label>
            <p><a href="logout.php">Sair da minha conta</a></p>
        </div>
    </div>
</body>
</html>