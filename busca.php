<?php
// Inclua o arquivo de conexão
include('conexao.php');

// Verifica se o formulário de busca foi submetido e se o campo não está vazio
if (isset($_GET['q']) && !empty($_GET['q'])) {
    // Limpe e sanitize o termo de busca
    $termo_busca = mysqli_real_escape_string($conn, $_GET['q']);

    // Verifica se o termo de busca contém mais de uma palavra
    $palavras_chave = explode(" ", $termo_busca);
    if (count($palavras_chave) > 1) {
        // Constrói a parte da consulta SQL para sugestões de palavras-chave
        $sugestoes = "";
        foreach ($palavras_chave as $palavra) {
            $sugestoes .= "OR nome LIKE '%$palavra%' ";
        }
        $sugestoes = trim($sugestoes, "OR");

        // Consulta SQL para buscar produtos pelo nome, incluindo sugestões de palavras-chave
        $sql = "SELECT * FROM produtos 
                WHERE nome LIKE '%$termo_busca%'
                OR ($sugestoes)";
    } else {
        // Consulta SQL padrão para busca de produtos
        $sql = "SELECT * FROM produtos WHERE nome LIKE '%$termo_busca%'";
    }

    $result = $conn->query($sql);

    // Verifica se a consulta retornou resultados
    if ($result->num_rows > 0) {
        echo "<div class='produtos-container'>";
        // Loop pelos resultados para exibir os produtos encontrados
        while ($row = $result->fetch_assoc()) {
            echo "<div class='produto'>";
            echo "<img src='" . $row['imagem_url'] . "' alt='" . $row['nome'] . "' class='produto-imagem'>";
            echo "<h3 class='produto-nome'>" . $row['nome'] . "</h3>";
            echo "<p class='produto-preco'>R$ " . number_format($row['preco'], 2, ',', '.') . "</p>";
            echo "<button class='btn-adicionar' onclick='adicionarAoCarrinho(" . $row['id'] . ")'>Adicionar ao Carrinho</button>";
            echo "</div>";
        }
        echo "</div>"; // Fechando o container de produtos
    } else {
        echo "Nenhum produto encontrado para: " . $termo_busca;
    }
} elseif (isset($_GET['q']) && empty($_GET['q'])) {
    echo "Por favor, insira um termo de busca válido.";
}

// Fechando a conexão
$conn->close();
?>
<!-- Adicione este estilo CSS para melhorar a aparência -->
<style>
    /* Estilos para tornar a página responsiva */

    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 20px;
    }

    .produtos-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-around;
        margin-top: 20px;
    }

    .produto {
        border: 1px solid #ccc;
        padding: 10px;
        margin-bottom: 20px;
        text-align: center;
        max-width: 300px;
        transition: transform 0.3s ease-in-out;
    }

    .produto:hover {
        transform: scale(1.05);
    }

    .produto-imagem {
        max-width: 100%;
        height: auto;
        margin-bottom: 10px;
    }

    .produto-nome {
        font-size: 18px;
        margin-bottom: 5px;
    }

    .produto-preco {
        font-weight: bold;
        color: green;
        margin-bottom: 10px;
    }

    .btn-adicionar {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
        font-size: 16px;
    }

    .btn-adicionar:hover {
        background-color: #0056b3;
    }

    /* Estilos para telas menores (responsivo) */
    @media screen and (max-width: 768px) {
        .produtos-container {
            flex-direction: column;
            align-items: center;
        }

        .produto {
            max-width: 100%;
        }
    }
</style>

<script>
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