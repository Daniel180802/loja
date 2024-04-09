<?php
include('conexao.php');
include('header.php');
?>

<style>
    /* Estilos CSS para a grade de produtos */
    .promocoes-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 20px;
    }

    .produto {
        border: 1px solid #ccc;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .produto:hover {
        transform: translateY(-5px);
    }

    .produto-imagem img {
        max-width: 100%;
        height: auto;
        border-radius: 5px;
    }

    .produto-info {
        margin-top: 10px;
    }

    .produto-info h3 {
        font-size: 18px;
        margin-bottom: 5px;
    }

    .produto-info p {
        font-size: 14px;
        margin-bottom: 10px;
    }

    .form-adicionar {
        display: inline-block;
    }

    .btn-adicionar {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 8px 15px;
        border-radius: 3px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn-adicionar:hover {
        background-color: #0056b3;
    }
</style>

<div class='container'>
    <br>
    <h1>Promoções</h1>
    <br>
    <div class='promocoes-grid'>
        <?php
        $sql = "SELECT * FROM ver_promocoes";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $id = $row["id"];
                $nome = $row["nome"];
                $precoAntigo = $row["preco_antigo"];
                $preco = $row["preco"];
                $informacoes = $row["informacoes_adicionais"];
                $imagemUrl = $row["imagem_url"]; // Nova linha para obter a URL da imagem

                ?>
                <div class='produto'>
                    <div class='produto-imagem'>
                        <img src='<?php echo $imagemUrl; ?>' alt='<?php echo $nome; ?>'>
                    </div>
                    <div class='produto-info'>
                        <h3><?php echo $nome; ?></h3>
                        <p><strong>Preço Antigo:</strong> R$ <?php echo number_format($precoAntigo, 2, ',', '.'); ?></p>
                        <p><strong>Preço:</strong> R$ <?php echo number_format($preco, 2, ',', '.'); ?></p>
                        <p><?php echo $informacoes; ?></p>
                        <form id='form-<?php echo $id; ?>' class='form-adicionar'>
                            <input type='hidden' name='produto_id' value='<?php echo $id; ?>'>
                            <input type='hidden' name='quantidade' value='1'> <!-- Quantidade fixa, você pode ajustar conforme necessário -->
                            <button type='button' class='btn-adicionar' onclick='addToCart(<?php echo $id; ?>)'>Adicionar ao Carrinho</button>
                        </form>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "<p>Nenhum produto em promoção no momento.</p>";
        }
        ?>
    </div>
</div> <!-- Fechando div.container -->

<script>
    // Script JavaScript para adicionar ao carrinho
    function addToCart(productId) {
        var form = document.getElementById('form-' + productId);
        var formData = new FormData(form);
        
        fetch('adicionar_carrinho.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (response.ok) {
                alert('Produto adicionado ao carrinho!');
            } else {
                alert('Erro ao adicionar produto ao carrinho.');
            }
        })
        .catch(error => {
            console.error('Erro ao adicionar produto ao carrinho:', error);
        });
    }
</script>

<?php
include('footer.php');
$conn->close();
?>