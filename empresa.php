
<?php

// Inclua seu arquivo de cabeçalho, rodapé, estilos CSS, etc.
include('header.php');
?>

    <style>


        /* Estilos específicos para a seção "Empresa" */
        .empresa-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        
        }
        .descricao {
            font-size: 18px;
            line-height: 1.6;
            margin-bottom: 20px;
        }
        .valores-list {
            margin-bottom: 20px;
        }
        .valores-list li {
            list-style: disc;
            margin-left: 20px;
        }
        .contato-form {
            margin-top: 30px;
        }
        .contato-form input[type="text"],
        .contato-form input[type="email"],
        .contato-form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .contato-form input[type="submit"] {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }
        .contato-form input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>



 <br><div class="empresa-container">
    <h1>Sobre a VirtualShop</h1>

    <div class="descricao">
        <p>A VirtualShop é uma loja online que oferece uma ampla variedade de produtos de alta qualidade.</p>
        <p>Nossa missão é proporcionar uma experiência de compra fácil, segura e conveniente para nossos clientes.</p>
    </div>

    <h2>Nossos Valores</h2>
    <ul class="valores-list">
        <li>Excelência no Atendimento ao Cliente</li>
        <li>Qualidade em Todos os Produtos</li>
        <li>Inovação Contínua</li>
        <li>Transparência e Honestidade</li>
    </ul>

    <h2>Informações de Contato</h2>
    <p><strong>Endereço:</strong> Estrada Principal Zango, Zango 1, Luanda</p>
    <p><strong>Telefone:</strong> +244 948 059 292, +244 928 424 423</p>
    <p><strong>E-mail:</strong> hermonskenny@gmail.com</p>

    <h2>Entre em Contato</h2>
    <form class="contato-form" action="enviar_contacto.php" method="POST">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>
        
        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" required>
        
        <label for="mensagem">Mensagem:</label>
        <textarea id="mensagem" name="mensagem" rows="4" required></textarea>
        
        <input type="submit" value="Enviar Mensagem">
    </form>
</div>  

<script>
    // Script para validação do formulário de contato (exemplo simples)
    const form = document.querySelector('.contato-form');

    form.addEventListener('submit', function(event) {
        const nome = form.querySelector('#nome').value.trim();
        const email = form.querySelector('#email').value.trim();
        const mensagem = form.querySelector('#mensagem').value.trim();

        if (nome === '' || email === '' || mensagem === '') {
            event.preventDefault();
            alert('Por favor, preencha todos os campos do formulário.');
        }
    });
</script>
<link rel="stylesheet" href="styles.css">

 <br> <?php

// Inclua seu arquivo de cabeçalho, rodapé, estilos CSS, etc.
include('footer.php');
?> 