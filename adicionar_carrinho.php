<?php
session_start();

// Verifica se o produto ID foi recebido
if(isset($_POST['produto_id'])) {
    $produto_id = $_POST['produto_id'];

    // Verifica se o carrinho existe na sessão, se não, cria
    if (!isset($_SESSION['carrinho'])) {
        $_SESSION['carrinho'] = [];
    }

    // Adiciona o produto ao carrinho
    if (isset($_SESSION['carrinho'][$produto_id])) {
        $_SESSION['carrinho'][$produto_id]++;
    } else {
        $_SESSION['carrinho'][$produto_id] = 1;
    }

    echo "Produto com ID " . $produto_id . " adicionado ao carrinho!";
} else {
    echo "Erro: ID do produto não recebido.";
}
?>