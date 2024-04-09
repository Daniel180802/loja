<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
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
            max-width: 800px;
            width: 100%;
            background-color: beige;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px #333;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        form {
            width: 100%;
            max-width: 400px;
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
        p.error {
            color: red;
            text-align: center;
            margin-top: 10px;
        }
        .login-image {
            max-width: 400px;
            width: 100%;
            margin-bottom: 20px;
            border-radius: 8px;
        }
        @media screen and (min-width: 768px) {
            .container {
                flex-direction: row;
                justify-content: space-between;
                padding: 40px;
            }
            .login-image {
                margin-right: 40px;
            }
            form {
                width: 300px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="banner-1.png" alt="Loja de Roupas" class="login-image">
        <div>
            <h2>Login</h2>
            <?php
            if (isset($_GET['erro']) && $_GET['erro'] == 1) {
                echo "<p class='error'>Usuário ou senha incorretos!</p>";
            }
            ?>
            <form action="autenticacao.php" method="post" onsubmit="return validateForm()">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required placeholder="Seu email">
                
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" required placeholder="Sua senha">
                
                <input type="submit" value="Login">
            </form>
            <p>Não tem uma conta? <a href="cadastro.php">Cadastre-se aqui</a></p>
        </div>
    </div>

    <script>
        function validateForm() {
            var email = document.getElementById("email").value;
            var senha = document.getElementById("senha").value;

            if (email.trim() == "" || senha.trim() == "") {
                alert("Por favor, preencha todos os campos.");
                return false;
            }

            return true;
        }
    </script>
</body>
</html>