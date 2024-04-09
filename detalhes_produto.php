<?php
    // Verifica se o parâmetro "id" foi passado na URL
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Inclui o arquivo de conexão
        include('conexao.php');
        
        // Verifica a conexão
        if ($conn->connect_error) {
            die("Falha na conexão com o banco de dados: " . $conn->connect_error);
        }

        // Prepara a consulta SQL para obter as informações do produto
        $sql = "SELECT nome, descricao, preco, disponibilidade, imagem1, imagem2, imagem3 FROM detalhes_produto WHERE id = $id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Exibe os dados do produto
            $row = $result->fetch_assoc();
            include('header.php');
    ?>

<br><div class="container">
    <h1>Detalhes do Produto</h1>
    <h2><?php echo $row['nome']; ?></h2>
    <p><strong>Descrição:</strong> <?php echo $row['descricao']; ?></p>
    <p><strong>Preço:</strong> KZ <?php echo $row['preco']; ?></p>
    <p><strong>Disponibilidade:</strong> <?php echo $row['disponibilidade']; ?></p>
    <div class="product-images">
        <img src="<?php echo $row['imagem1']; ?>" alt="Imagem Principal" id="imagem-principal" class="main-image">
        <div class="image-thumbnails">
            <div class="image-container" onclick="mudarImagem('<?php echo $row['imagem1']; ?>')">
                <img src="<?php echo $row['imagem1']; ?>" alt="Imagem 1" class="product-image">
            </div>
            <div class="image-container" onclick="mudarImagem('<?php echo $row['imagem2']; ?>')">
                <img src="<?php echo $row['imagem2']; ?>" alt="Imagem 2" class="product-image">
            </div>
            <div class="image-container" onclick="mudarImagem('<?php echo $row['imagem3']; ?>')">
                <img src="<?php echo $row['imagem3']; ?>" alt="Imagem 3" class="product-image">
            </div>
        </div>
    </div>
    <button class="btn" onclick="adicionarAoCarrinho(<?php echo $id; ?>, '<?php echo $row['nome']; ?>', <?php echo $row['preco']; ?>)">Adicionar ao Carrinho</button>
</div>

<?php
        include('footer.php');
    } else {
        echo '<p>Produto não encontrado.</p>';
    }

    // Fecha a conexão com o banco de dados
    $conn->close();
} else {
    echo '<p>Parâmetro "id" não encontrado na URL.</p>';
}
?>

<style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
    }
    .container {
        max-width: 800px;
        margin: 0 auto;
    }
    h1, h2 {
        margin-bottom: 10px;
    }
    p {
        margin-bottom: 5px;
    }
    .product-images {
        margin-bottom: 20px;
    }
    .main-image {
        max-width: 50%; /* A imagem principal ocupará 100% da largura disponível */
        height: auto;
        border: 1px solid #ccc;
        margin-bottom: 10px;
    }
    .image-thumbnails {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }
    .image-container {
        width: 100px; /* Tamanho das miniaturas */
        height: 100px; /* Tamanho das miniaturas */
        margin: 5px;
        border: 1px solid #ccc;
        cursor: pointer;
        transition: border-color 0.3s ease;
    }
    .image-container img {
        width: 100%; /* Para garantir que as imagens dentro do contêiner sejam responsivas */
        height: 100%; /* Para garantir que as imagens dentro do contêiner sejam responsivas */
        object-fit: cover; /* Para ajustar o tamanho da imagem dentro do contêiner */
    }
    .image-container:hover {
        border-color: #007bff;
    }
    .btn {
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
</style>

<script>
    function mudarImagem(src) {
        var imagemPrincipal = document.getElementById('imagem-principal');
        imagemPrincipal.src = src;
 }function adicionarAoCarrinho(id, nome, preco) {
    // Requisição AJAX para adicionar o produto ao carrinho
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            alert("Produto '" + nome + "' adicionado ao carrinho!");
        }
    };
    xhttp.open("POST", "adicionar_carrinho.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("produto_id=" + id + "&produto_nome=" + nome + "&produto_preco=" + preco);
}
</script>