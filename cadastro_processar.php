<?php
include('conexao.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    // Hash da senha
    $senha_hash = md5($senha);

    // Inserir os dados na tabela de usuários
    $sql = "INSERT INTO usuarios (nome, email, senha) VALUES ('$nome', '$email', '$senha_hash')";

    if ($conn->query($sql) === TRUE) {
        echo "Cadastro realizado com sucesso!";
    } else {
        echo "Erro ao cadastrar: " . $conn->error;
    }
}

$conn->close();
?>