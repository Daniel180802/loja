<?php
// Conexão com o banco de dados
$conexao = new mysqli("localhost", "root", "", "loja_roupas");

// Verifica se houve erro na conexão
if ($conexao->connect_error) {
    die("Erro na conexão: " . $conexao->connect_error);
}

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se todos os campos foram preenchidos
    if (isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['mensagem'])) {
        // Captura os dados do formulário
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $mensagem = $_POST['mensagem'];
        
        // Prepara a query SQL para inserção dos dados
        $sql = "INSERT INTO mensagens_contato (nome, email, mensagem) VALUES ('$nome', '$email', '$mensagem')";
        
        // Executa a query e verifica se foi bem sucedida
        if ($conexao->query($sql) === TRUE) {
            echo "Mensagem enviada com sucesso!";
        } else {
            echo "Erro ao enviar mensagem: " . $conexao->error;
        }
    } else {
        echo "Por favor, preencha todos os campos do formulário.";
    }
} else {
    echo "Erro: O formulário não foi submetido.";
}

// Fecha a conexão com o banco de dados
$conexao->close();
?>