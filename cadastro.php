<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: antiquewhite;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            max-width: 400px;
            width: 100%;
            background-color:beige ;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px #333;
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
            font-weight: bold;
        }
        input {
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        input[type="submit"] {
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #218838;
        }
        .back-to-login {
            text-align: center;
            margin-top: 20px;
        }
        .back-to-login a {
            text-decoration: none;
            color: #333;
            background-color: #f5f5f5;
            padding: 10px 20px;
            border-radius: 5px;
            border: 1px solid #ccc;
            transition: all 0.3s ease;
        }
        .back-to-login a:hover {
            background-color: #e9ecef;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Cadastro</h2>
        <form action="cadastro_processar.php" method="post">
            <label for="nome">Nome Completo:</label>
            <input type="text" id="nome" name="nome" required>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>
            
            <input type="submit" value="Cadastrar">
        </form>
        <div class="back-to-login">
            <a href="login.php">Voltar para o Login</a>
        </div>
    </div>
</body>
</html>