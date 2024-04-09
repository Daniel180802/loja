<?php
session_start();

// Verifica se o carrinho existe na sessão e se não está vazio
if (isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho'])) {
    include('conexao.php'); // Inclui o arquivo de conexão com o banco de dados
   
    // Inicializa a variável $totalCompra
    $totalCompra = 0;

    // Calcula o total da compra
    foreach ($_SESSION['carrinho'] as $produto_id => $quantidade) {
        // Consulta SQL para buscar as informações do produto usando prepared statements
        $stmt = $conn->prepare("SELECT * FROM Produto WHERE id = ?");
        $stmt->bind_param("i", $produto_id);
        $stmt->execute();
        $result = $stmt->get_result();

        // Se não encontrar na tabela "Produto", busca em outras tabelas
        if ($result->num_rows == 0) {
            $stmt = $conn->prepare("SELECT * FROM detalhes_temporada WHERE id = ?");
            $stmt->bind_param("i", $produto_id);
            $stmt->execute();
            $result = $stmt->get_result();
        }

        if ($result->num_rows == 0) {
            $stmt = $conn->prepare("SELECT * FROM detalhes_destaque WHERE id = ?");
            $stmt->bind_param("i", $produto_id);
            $stmt->execute();
            $result = $stmt->get_result();
        }

        if ($result->num_rows == 0) {
            $stmt = $conn->prepare("SELECT * FROM produtos WHERE id = ?");
            $stmt->bind_param("i", $produto_id);
            $stmt->execute();
            $result = $stmt->get_result();
        }

        if ($result->num_rows == 0) {
            $stmt = $conn->prepare("SELECT * FROM ver_promocoes WHERE id = ?");
            $stmt->bind_param("i", $produto_id);
            $stmt->execute();
            $result = $stmt->get_result();
        }

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            $nomeProduto = $row["nome"];
            $precoProduto = $row["preco"];
            $totalProduto = $precoProduto * $quantidade;
            $totalCompra += $totalProduto;
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finalizar Pedido</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: beige;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        h1 {
            color: #0056b3;
            margin-bottom: 20px;
        }

        .detalhes-pedido {
            margin-bottom: 20px;
        }

        .detalhes-pedido p {
            margin: 5px 0;
        }

        .forma-pagamento {
            margin-top: 20px;
        }

        .forma-pagamento p {
            margin: 5px 0;
        }

        .btn-voltar {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn-voltar:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Finalizar Pedido</h1>

        <div class="detalhes-pedido">
            <h3>Detalhes do Pedido:</h3>
            <p><strong>Total da Compra:</strong> KZ <?php echo number_format($totalCompra, 2, ',', '.'); ?></p>
            <p><strong>Produtos:</strong></p>
            <ul>
                <?php
                foreach ($_SESSION['carrinho'] as $produto_id => $quantidade) {
                    // Consulta SQL para buscar as informações do produto usando prepared statements
                    $stmt = $conn->prepare("SELECT * FROM Produto WHERE id = ?");
                    $stmt->bind_param("i", $produto_id);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows == 0) {
                        $stmt = $conn->prepare("SELECT * FROM detalhes_temporada WHERE id = ?");
                        $stmt->bind_param("i", $produto_id);
                        $stmt->execute();
                        $result = $stmt->get_result();
                    }
            
                    if ($result->num_rows == 0) {
                        $stmt = $conn->prepare("SELECT * FROM detalhes_destaque WHERE id = ?");
                        $stmt->bind_param("i", $produto_id);
                        $stmt->execute();
                        $result = $stmt->get_result();
                    }
            
                    if ($result->num_rows == 0) {
                        $stmt = $conn->prepare("SELECT * FROM produtos WHERE id = ?");
                        $stmt->bind_param("i", $produto_id);
                        $stmt->execute();
                        $result = $stmt->get_result();
                    }
            
                    if ($result->num_rows == 0) {
                        $stmt = $conn->prepare("SELECT * FROM ver_promocoes WHERE id = ?");
                        $stmt->bind_param("i", $produto_id);
                        $stmt->execute();
                        $result = $stmt->get_result();
                    }

                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        echo "<li>" . $row['nome'] . " - Quantidade: " . $quantidade . "</li>";
                    }
                }
                ?>
            </ul>
        </div>

        <div class="forma-pagamento">
            <h3>Forma de Pagamento:</h3>
            <p>Por favor, realize o pagamento via transferência bancária para a seguinte conta:</p>
            <p><strong>Banco:</strong> Atlantico Millenion</p>
            <p><strong>Iban:</strong> 00550000303325438727</p>
            <p><strong>Conta:</strong> 56789-0</p> <p><strong>Valor Total:</strong> KZ <?php echo number_format($totalCompra, 2, ',', '.'); ?></p> <p><strong>Observações:</strong> Inclua o número do pedido como referência no pagamento.</p> </div>    <!-- Botão de Voltar para a Página Inicial -->
    <a href="index.php" class="btn-voltar">Voltar para a Página Inicial</a>
</div>

<?php
// Limpar carrinho após finalizar o pedido
unset($_SESSION['carrinho']);
?>
</body>
</html>
<?php
    // Fechando a conexão com o banco de dados
    $stmt->close();
    $conn->close();

} else {
    // Se o carrinho estiver vazio
    echo "<h1>Carrinho de Compras</h1>";
    echo "Seu carrinho está vazio.";
}
?>