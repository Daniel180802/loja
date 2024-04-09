<?php
session_start();

if (isset($_POST['produto_id']) && !empty($_POST['produto_id'])) {
    $produto_id = $_POST['produto_id'];

    // Remove o produto do carrinho
    if (isset($_SESSION['carrinho'][$produto_id])) {
        unset($_SESSION['carrinho'][$produto_id]);
    }

    // Redireciona de volta para a página do carrinho
    header("Location: carrinho.php");
    exit();
} else {
    // Caso não seja enviado o ID do produto, redireciona para o carrinho
    header("Location: carrinho.php");
    exit();
}
?>