<?php
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

include('conexao.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $novaSenha = $_POST["novaSenha"];
    $email = $_SESSION['email'];

    // Hash da nova senha
    $senha_hash = md5($novaSenha);

    $sql = "UPDATE usuarios SET senha = '$senha_hash' WHERE email = '$email'";

    if ($conn->query($sql) === TRUE) {
        echo "Senha alterada com sucesso!";
    } else {
        echo "Erro ao alterar a senha: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Alterar Senha</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 5px;
        }
        input {
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        p.message {
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Alterar Senha</h2>
        <form action="" method="post">
            <label for="novaSenha">Nova Senha:</label>
            <input type="password" id="novaSenha" name="novaSenha" required>
            
            <input type="submit" value="Alterar Senha">
        </form>
        <p class="message">Não quer alterar a senha? <a href="minha_conta.php">Voltar para Minha Conta</a></p>
    </div>
</body>
</html>