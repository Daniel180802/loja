<?php
// Inclui o arquivo de conexão
include('conexao.php');
include('header.php');

// Criando a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificando a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Definir o número de produtos por página e a página atual
$produtos_por_pagina = 12;
if (isset($_GET['pagina'])) {
    $pagina_atual = $_GET['pagina'];
} else {
    $pagina_atual = 1;
}

// Calcular o início da seleção baseado na página atual
$inicio = ($pagina_atual - 1) * $produtos_por_pagina;

// Consulta SQL para buscar os produtos com limite e offset
$sql = "SELECT * FROM Produto LIMIT $inicio, $produtos_por_pagina";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Exibindo os produtos com animação de fade-in
    echo "<div id='produtos-container' class='fade-in'>";
    while($row = $result->fetch_assoc()) {
        echo "<div class='produto'>";
        echo "<img src='" . $row["imagem_url"] . "' alt='" . $row["nome"] . "'>";
        echo "<p class='nome'>" . $row["nome"] . "</p>";
        echo "<p class='preco'>R$ " . number_format($row["preco"], 2, ',', '.') . "</p>";
        echo "<button class='btn-detalhes' onclick='mostrarDetalhes(" . $row["id"] . ")'>Detalhes</button>";
        echo "<button class='btn-carrinho' onclick='adicionarAoCarrinho(" . $row["id"] . ")'>Adicionar ao Carrinho</button>";
        echo "</div>";
    }
    echo "</div>";

    // Botões de Paginação
    $sql_total = "SELECT COUNT(*) AS total FROM Produto";
    $resultado_total = $conn->query($sql_total);
    $dados_total = $resultado_total->fetch_assoc();
    $total_produtos = $dados_total['total'];
    $total_paginas = ceil($total_produtos / $produtos_por_pagina);

    echo "<div class='pagination'>";
    if ($pagina_atual > 1) {
        echo "<a href='produtos.php?pagina=" . ($pagina_atual - 1) . "' class='page-link'>Anterior</a>";
    }
    for ($i = 1; $i <= $total_paginas; $i++) {
        if ($i == $pagina_atual) {
            echo "<span class='page-link current-page'>$i</span>";
        } else {
            echo "<a href='produtos.php?pagina=$i' class='page-link'>$i</a>";
        }
    }
    if ($pagina_atual < $total_paginas) {
        echo "<a href='produtos.php?pagina=" . ($pagina_atual + 1) . "' class='page-link'>Próxima</a>";
    }
    echo "</div>";

} else {
    echo "Nenhum produto encontrado.";
}

// Fechando a conexão com o banco de dados
$conn->close();
?>

<!-- Estilos CSS -->
<style>
    /* Estilos para os produtos */
    .produto {
        border: 1px solid #ccc;
        padding: 10px;
        margin-bottom: 20px;
        width: 300px;
        display: inline-block;
        text-align: center;
        transition: all 0.3s ease-in-out;
    }
    
    .produto img {
        max-width: 100%;
        height: auto;
    }
    
    .nome {
        font-weight: bold;
        margin: 10px 0;
    }
    
    .preco {
        color: #007bff;
        font-size: 18px;
    }
    
    /* Estilos para os botões */
    .btn-detalhes,
    .btn-carrinho {
        display: block;
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: none;
        background-color: #007bff;
        color: white;
        cursor: pointer;
    }
    
    .btn-detalhes:hover,
    .btn-carrinho:hover {
        background-color: #0056b3;
    }

    /* Estilos para a paginação */
    .pagination {
        margin-top: 20px;
        text-align: center;
    }

    .page-link {
        display: inline-block;
        padding: 5px 10px;
        margin: 0 5px;
        background-color: #007bff;
        color: white;
        text-decoration: none;
        border-radius: 3px;
    }

    .page-link:hover {
        background-color: #0056b3;
    }

    .current-page {
        font-weight: bold;
    }

    /* Estilo para a animação de fade-in */
    .fade-in {
        opacity: 0;
        transition: opacity 0.5s ease-in-out;
    }
    
    .fade-in.show {
        opacity: 1;
    }
</style>

<!-- Script JavaScript -->
<script>
    // Função para adicionar a classe de animação quando a página carrega
    document.addEventListener('DOMContentLoaded', function() {
        var produtosContainer = document.getElementById('produtos-container');
        produtosContainer.classList.add('show');
    });

    function mostrarDetalhes(id) {
        // Redirecionar para a página de detalhes do produto com base no ID
        window.location.href = 'detalhes_produto.php?id=' + id;
    }
    
    function adicionarAoCarrinho(id) {
        // Requisição AJAX para adicionar o produto ao carrinho
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                alert("Produto adicionado ao carrinho!");
            }
        };
        xhttp.open("POST", "adicionar_carrinho.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("produto_id=" + id);
    }
</script>

<?php
// Inclua seu arquivo de cabeçalho, rodapé, estilos CSS, etc.
include('footer.php');
?>