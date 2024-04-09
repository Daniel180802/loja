<?php
session_start();
include('conexao.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    // Consulta SQL para verificar as credenciais
    $sql = "SELECT * FROM usuarios WHERE email = '$email' AND senha = MD5('$senha')";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Usuário autenticado com sucesso
        $_SESSION["loggedin"] = true;
        $_SESSION["email"] = $email;
        header("Location: index.php");
    } else {
        // Login falhou, redirecionar de volta para a página de login com mensagem de erro
        header("Location: login.php?erro=1");
    }
}
?>