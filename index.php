<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

// Inclua seu arquivo de cabeçalho, rodapé, estilos CSS, etc.
include('header.php');
?>
<style>
    body {
        background-color: antiquewhite;
    }
</style>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: antiquewhite;
        margin: 0;
        padding: 20px;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    h2 {
        text-align: center;
        color: #333;
        margin-bottom: 30px;
    }

    .linha {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        margin-bottom: 30px;
     
    }

    .col-2,
    .col-3 {
        flex: 1 1 45%;
        margin-bottom: 20px;
        
    }

    .col-2 img,
    .col-3 img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        transition: transform 0.8s ease;
       
    }

    .col-2 img:hover,
    .col-3 img:hover {
        transform: scale(1.1);
    }

    .btn {
        display: inline-block;
        background-color: darksalmon;
        color: white;
        padding: 12px 24px;
        font-size: 18px;
        border-radius: 5px;
        text-decoration: none;
        transition: background-color 0.3s ease;
    }

    .btn:hover {
        background-color: #f1c40f;
    }

    .produto,
    .produto-promocao,
    .prod_temporada {
        text-align: center;
        margin-bottom: 20px;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        background-color: beige;
        transition: transform 0.8s ease;
        margin-right: 20px;
    }

    .produto:hover,
    .produto-promocao:hover,
    .prod_temporada:hover {
        transform: translateY(-5px);
    }

    .produto img,
    .produto-promocao img,
    .prod_temporada img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        margin-bottom: 10px;
    }

    .produto h3,
    .produto-promocao h3,
    .prod_temporada h3 {
        font-size: 20px;
        margin-bottom: 10px;
    }

    .produto p,
    .produto-promocao p,
    .prod_temporada p {
        font-size: 18px;
        color: #888;
        margin-bottom: 10px;
    }

    .produto a,
    .produto-promocao a,
    .prod_temporada a {
        display: inline-block;
        background-color: #007bff;
        color: white;
        padding: 10px 20px;
        border-radius: 5px;
        text-decoration: none;
        transition: background-color 0.8s ease;
    }

    .produto a:hover,
    .produto-promocao a:hover,
    .prod_temporada a:hover {
        background-color: #0056b3;
    }

    .depoimentos {
        margin-top: 50px;
        
    }

    .depoimentos .col-3 {
        text-align: center;
        padding: 20px;
        border-radius: 8px;
        background-color: #fff;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
        transition: transform 0.3s ease;
        margin-right:20px ;
    }

    .depoimentos .col-3:hover {
        transform: translateY(-5px);
    }

    .depoimentos img {
        max-width: 100px;
        height: auto;
        border-radius: 50%;
        margin-top: 20px;
        transition: transform 0.8s ease;
    }

    .depoimentos img:hover {
        transform: scale(1.1);
    }

    .depoimentos p {
        font-size: 16px;
        margin-bottom: 20px;
    }

    .classificacao {
        color: #f1c40f;
        font-size: 24px;
        margin-bottom: 10px;
    }

    .marcas {
        display: flex;
        justify-content: space-around;
        align-items: center;
        flex-wrap: wrap;
        margin-top: 50px;
       
        
    }

    .marcas img {
        max-width: 520px;
        height: auto;
        margin: 20px;
        border-radius: 8px;
        transition: transform 0.8s ease;
    }

    .marcas img:hover {
        transform: scale(1.1);
    }
    .barra-busca {
    margin-bottom: 20px;
}

#termo-busca {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

#btn-buscar {
    padding: 10px;
    background-color: darksalmon;
    border: none;
    color: white;
    border-radius: 4px;
    cursor: pointer;
}

#btn-buscar:hover {
    background-color: #b36b00;
}


</style>

<!-- Barra de Busca -->
<br><div class="barra-busca">
    <form action="busca.php" method="GET">
        <input type="text" name="q" id="termo-busca" placeholder="Buscar produtos...">
        <button type="submit" id="btn-buscar">Buscar</button>
    </form>
</div>

<!-- Conteúdo da Página Inicial -->
<div class="container">
    <!-- Banner Principal -->
    <div class="linha">
        <div class="col-2">
            <h1>Escolha um novo <br>estilo de vida!</h1>
            <p>Descubra um novo estilo de vida na VirtualShop, onde há elegância e conforto. Explore nossas coleções únicas e encontre peças que refletem sua personalidade, redefinindo seu modo de viver com modo e autenticidade.</p>
            <br><a href="empresa.php" class="btn">Mais Informações &#8594;</a>
    </div>
    <div class="col-2">
        <img src="banner-1.png" alt="Banner Principal">
    </div>
</div>

<!-- Seção de Produtos da Temporada -->
<h2>Produtos da Temporada</h2>
<div class="linha">
    <?php
    // Inclua o arquivo de conexão
    include('conexao.php');

    // Consulta SQL para buscar produtos da temporada
    $sql_temporada = "SELECT * FROM prod_temporada WHERE temporada = 1";
    $result_temporada = $conn->query($sql_temporada);

    // Verifica se a consulta retornou resultados
    if ($result_temporada->num_rows > 0) {
        // Loop pelos resultados para exibir os produtos da temporada
        while ($row_temporada = $result_temporada->fetch_assoc()) {
            echo "<div class='prod_temporada col-3'>";
            echo "<img src='" . $row_temporada['imagem_url'] . "' alt='" . $row_temporada['nome'] . "'>";
            echo "<h3>" . $row_temporada['nome'] . "</h3>";
            echo "<p>KZ " . number_format($row_temporada['preco'], 2, ',', '.') . "</p>";
            echo "<a href='detalhes_temporada.php?id=" . $row_temporada['id'] . "' class='btn'>Ver Detalhes</a>";
            echo "</div>";
        }
    } else {
        echo "Nenhum produto da temporada encontrado.";
    }

    // Fechando a conexão
    $conn->close();
    ?>
</div>

<!-- Seção de Produtos em Destaque -->
<h2>Produtos em Destaque</h2>
<div class="linha">
    <?php
    // Inclua o arquivo de conexão
    include('conexao.php');

    // Consulta SQL para buscar produtos em destaque
    $sql_destaque = "SELECT * FROM prod_destaque";
    $result_destaque = $conn->query($sql_destaque);

    // Verifica se a consulta retornou resultados
    if ($result_destaque->num_rows > 0) {
        // Loop pelos resultados para exibir os produtos em destaque
        while ($row_destaque = $result_destaque->fetch_assoc()) {
            echo "<div class='produto col-3'>";
            echo "<img src='" . $row_destaque['imagem'] . "' alt='" . $row_destaque['nome'] . "'>";
            echo "<h3>" . $row_destaque['nome'] . "</h3>";
            echo "<p>KZ " . number_format($row_destaque['preco'], 2, ',', '.') . "</p>";
            echo "<a href='detalhes_destaque.php?id=" . $row_destaque['id'] . "' class='btn'>Ver Detalhes</a>";
            echo "</div>";
        }
    } else {
        echo "Nenhum produto em destaque encontrado.";
    }

    // Fechando a conexão
    $conn->close();
    ?>
</div>

<!-- Seção de Produtos em Promoção -->
<h2>Produtos em Promoção</h2>

    <a href='ver_promocoes.php?id=" . $row_promocao['id'] . "' class='btn'>Ver Promoção</a>
    
</div>

<!-- Seção de Depoimentos de Clientes -->
<h2>Depoimentos de Clientes</h2>
<div class="linha depoimentos">
    <div class="col-3">
        <img src="assets/img/FB_IMG_16552254255111895.jpg" alt="Depoimento 1">
        <p>Uma visita à loja foi como encontrar um tesouro de estilo. Cada peça única contava uma história de moda. Fiquei impressionado com a variedade e qualidade. Certamente, minha nova loja favorita!</p>
        <div class="classificacao">
            <ion-icon name="star"></ion-icon>
            <ion-icon name="star"></ion-icon>
            <ion-icon name="star"></ion-icon>
            <ion-icon name="star"></ion-icon>
            <ion-icon name="star"></ion-icon>
        </div>
        <h3>Evandro Soares</h3>
    </div>
    <div class="col-3">
        <img src="assets/img/FB_IMG_1655767420747658e - Cópia.jpg" alt="Depoimento 2">
        <p>Visitar a loja foi uma descoberta incrível! Ambiente elegante, roupas exclusivas e uma experiência de compra que superou as expectativas. Mal posso esperar para voltar!</p>
        <div class="classificacao">
            <ion-icon name="star"></ion-icon>
            <ion-icon name="star"></ion-icon>
            <ion-icon name="star"></ion-icon>
            <ion-icon name="star"></ion-icon>
            <ion-icon name="star"></ion-icon>
        </div>
        <h3>Isabel dos Santos</h3>
    </div>
    <div class="col-3">
        <img src="assets/img/msn_user_avatar_person_people_icon_124220.png" alt="Depoimento 3">
        <p>Uma experiência de moda extraordinária! Ao entrar na loja, fui envolvido por uma atmosfera de elegância e estilo. Cada detalhe, desde a dispos ição cuidadosa dos produtos até a iluminação sofisticada, transmitiu um ambiente acolhedor. </p> <div class="classificacao"> <ion-icon name="star"></ion-icon> <ion-icon name="star"></ion-icon> <ion-icon name="star"></ion-icon> <ion-icon name="star"></ion-icon> <ion-icon name="star"></ion-icon> </div> <h3>Edna Carvalho</h3> </div> </div><!-- Seção de Marcas -->
<br><h2>Marcas</h2>
<div class="marcas">
    <img src="img/marca-1.png" alt="Marca 1">
    <img src="img/marca-2.png" alt="Marca 2">
    <img src="img/marca-3.png" alt="Marca 3">
    <img src="img/marca-4.png" alt="Marca 4">
</div>
</div>
<?php
// Inclua seu arquivo de rodapé, scripts JavaScript, etc.
include('footer.php');
?>
<link rel="stylesheet" href="style.css">