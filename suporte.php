<?php

// Inclua seu arquivo de cabeçalho, rodapé, estilos CSS, etc.
include('header.php');
?>

   
    <style>
        /* Estilos gerais */
        body {
            background-color: antiquewhite;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
           
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: antiquewhite;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px #333;
        }
        h1, h2, h3 {
            color: #333;
        }
        ul {
            padding: 0;
            margin: 0;
        }
        li {
            margin-bottom: 10px;
        }

        /* Estilos específicos para a página de suporte */
        .faq h3 {
            cursor: pointer;
            color: #007bff;
        }
        .faq p {
            display: none;
        }
    </style>
    <script>
        // Script para mostrar/ocultar respostas de FAQs
        function toggleFAQ(id) {
            var answer = document.getElementById(id);
            if (answer.style.display === "none") {
                answer.style.display = "block";
            } else {
                answer.style.display = "none";
            }
        }
    </script>



<div class="container">
    <h1>Suporte</h1>

    <!-- Perguntas Frequentes (FAQ) -->
    <div class="faq">
        <h2>Perguntas Frequentes</h2>
        <div>
            <h3 onclick="toggleFAQ('faq1')">Como faço para fazer uma troca?</h3>
            <p id="faq1" style="display: none;">Para fazer uma troca, por favor entre em contato com nossa equipe de suporte pelo formulário nesta página.</p>
        </div>
        <div>
            <h3 onclick="toggleFAQ('faq2')">Qual é o prazo para devolução de um produto?</h3>
            <p id="faq2" style="display: none;">O prazo para devolução de um produto é de 30 dias a partir da data de recebimento.</p>
        </div>
        <!-- Adicione mais perguntas e respostas conforme necessário -->
    </div>

    <!-- Políticas de Troca e Devoluções -->
    <div class="politicas">
        <h2>Políticas de Troca e Devoluções</h2>
        <p>Se você não estiver satisfeito com o seu produto, você pode trocá-lo ou devolvê-lo seguindo nossas políticas. Aqui estão algumas informações importantes:</p>
        <ul>
            <li>Os produtos devem estar em sua embalagem original e sem sinais de uso.</li>
            <li>Para trocas, entre em contato conosco em até 15 dias após o recebimento.</li>
            <li>Para devoluções, o prazo é de 30 dias a partir da data de recebimento.</li>
            <!-- Adicione mais detalhes conforme necessário -->
        </ul>
    </div>

    <!-- Horário de Atendimento -->
    <div class="atendimento">
        <h2>Horário de Atendimento</h2>
        <p>Nosso suporte está disponível de segunda a sexta-feira, das 9h às 18h.</p>
    </div>

    <!-- Feedback dos Clientes -->
    <div class="feedback">
        <h2>Feedback dos Clientes</h2>
        <p>Confira o que nossos clientes estão dizendo sobre nós:</p>
        <ul>
            <li>"Excelente atendimento e produtos de qualidade! Com certeza recomendo!" - Maria S.</li>
            <li>"Tive uma ótima experiência de compra. Entrega rápida e eficiente!" - João P.</li>
            <!-- Adicione mais comentários conforme necessário -->
        </ul>
    </div>

    <!-- Notícias e Atualizações -->
    <div class="noticias">
        <h2>Notícias e Atualizações</h2>
        <p>Fique por dentro das últimas notícias e atualizações sobre nossa loja:</p>
        <ul>        <li><strong>Novo Produto:</strong> Acabamos de lançar nossa nova coleção de primavera! Confira agora.</li>
        <li><strong>Promoção Especial:</strong> Aproveite descontos de até 30% em toda a loja durante esta semana.</li>
        <!-- Adicione mais notícias e atualizações conforme necessário -->
    </ul>
</div>


<br><?php

// Inclua seu arquivo de cabeçalho, rodapé, estilos CSS, etc.
include('footer.php');
?>
