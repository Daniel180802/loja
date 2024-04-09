<?php
session_start();

// Verifica se o carrinho existe na sessão e se não está vazio
if (isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho'])) {
    include('conexao.php');
    include('header.php');
?>
<link rel='stylesheet' type='text/css' href='style.css'>
<style>
    /* Estilos para a tabela do carrinho */
    .table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    .table th,
    .table td {
        padding: 10px;
        border-bottom: 1px solid #ddd;
        text-align: left;
    }

    .table th {
        background-color: #218838;
    }

    .imagem-produto {
        max-width: 100px;
        height: auto;
    }

    /* Estilos para os botões */
    .btn-remover {
        background-color: #dc3545;
        color: white;
        padding: 8px 12px;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s ease-in-out;
    }

    .btn-remover:hover {
        background-color: #c82333;
    }

    .btn-finalizar {
        background-color: #28a745;
        color: white;
        padding: 10px 20px;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s ease-in-out;
    }

    .btn-finalizar:hover {
        background-color: #218838;
    }

    /* Estilos para o total */
    .total {
        font-size: 24px;
        margin-top: 20px;
    }
</style>

<div class='container'>
    <br><h1>Carrinho de Compras</h1>
    <br><table class='table'>
        <thead>
            <tr>
                <th>ID</th>
                <th>Produto</th>
                <th>Imagem</th>
                <th>Preço</th>
                <th>Quantidade</th>
                <th>Total</th>
                <th>Remover</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $totalCompra = 0;

            foreach ($_SESSION['carrinho'] as $produto_id => $quantidade) {
                // Consulta SQL para buscar as informações do produto na tabela adequada
                // Adapte este trecho conforme a estrutura do seu banco de dados
                $sql = "SELECT * FROM produtos WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $produto_id);
                $stmt->execute();
                $result = $stmt->get_result();


                // Se não encontrar na tabela "produtos", busca na tabela "Produto"
                if ($result->num_rows == 0) {
                    $sql = "SELECT * FROM Produto WHERE id = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $produto_id);
                    $stmt->execute();
                    $result = $stmt->get_result();
                }

                // Se não encontrar na tabela "Produto", busca na tabela "detalhes_temporada"
                if ($result->num_rows == 0) {
                    $sql = "SELECT * FROM detalhes_temporada WHERE id = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $produto_id);
                    $stmt->execute();
                    $result = $stmt->get_result();
                }

                // Se não encontrar na tabela "detalhes_temporada", busca na tabela "detalhes_destaque"
                if ($result->num_rows == 0) {
                    $sql = "SELECT * FROM detalhes_destaque WHERE id = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $produto_id);
                    $stmt->execute();
                    $result = $stmt->get_result();
                }

                // Se não encontrar na tabela "detalhes_destaque", busca na tabela "ver_promocoes"
                if ($result->num_rows == 0) {
                    $sql = "SELECT * FROM ver_promocoes WHERE id = ?";
                    $stmt = $conn->prepare($sql);
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

                    // Escolha da coluna correta da imagem do produto
                    if(isset($row["imagem_url"])) {
                        $imagemProduto = $row["imagem_url"];
                    } elseif(isset($row["imagem1"])) {
                        $imagemProduto = $row["imagem1"];
                    } elseif(isset($row["imagem2"])) {
                        $imagemProduto = $row["imagem2"];
                    } elseif(isset($row["imagem3"])) {
                        $imagemProduto = $row["imagem3"];
                    } else {
                        $imagemProduto = ""; // Se nenhuma imagem for encontrada, deixe vazia
                    }

                    echo "<tr>";
                    echo "<td>" . $produto_id . "</td>";
                    echo "<td>" . $nomeProduto . "</td>";
                    echo "<td><img src='" . $imagemProduto . "' alt='" . $nomeProduto . "' class='imagem-produto'></td>";
                    echo "<td>KZ " . number_format($precoProduto, 2, ',', '.') . "</td>";
                    echo "<td>" . $quantidade . "</td>";
                    echo "<td>KZ " . number_format($totalProduto, 2, ',', '.') . "</td>";
                    echo "<td>";
                    
                    ?>
                    <form action='remover_produto.php' method='post' class='form-remover' onsubmit='return confirmarRemover()'>
                        <input type='hidden' name='produto_id' value='<?php echo $produto_id; ?>'>
                        <input type='submit' value='Remover' class='btn-remover'>
                    </form>
                    <?php
                    echo "</td>";
                    echo "</tr>";
                }
            }
            ?>
        </tbody>
    </table>
    <br><h3 class='total'>Total da Compra: KZ <?php echo number_format($totalCompra, 2, ',', '.'); ?></h3>

    <!-- Botão para finalizar o pedido -->
    <br><form action='finalizar_pedido.php' method='post'>
        <input type='submit' value='Finalizar Pedido' class='btn-finalizar'>
    </form>
</div> <!-- Fechando div.container -->

<!-- Script para confirmar remoção de produto -->
<script>
    function confirmarRemover() {
        return confirm('Tem certeza que deseja remover este produto do carrinho?');
    }
</script>
</body>
</html>
<br>
<?php
    // Fechando a conexão com o banco de dados
    $stmt->close();
    $conn->close();

} else {
    
    // Se o carrinho estiver vazio
    echo "<h1>Carrinho de Compras</h1>";
    echo "Seu carrinho está vazio.";
} ?>