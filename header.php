<div class="novoMenu">
    <div class="container">
        <div class="navbar">
            <div class="logo">
                <a href="index.php" title=""> 
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <img src="img/ss.png" alt="VirtualShop" width="125px">
                </a>
            </div>
            
            <nav class="nav-menu" id="MenuItens">
                <ul>
                    <li><a href="index.php" title="">Inicio</a></li>
                    <li><a href="produtos.php" title="">Produtos</a></li>
                    <li><a href="empresa.php" title="">Empresas</a></li>
                    <li><a href="suporte.php" title="">Suporte</a></li>
                    <li><a href="minha_conta.php" title="">Minha Conta</a></li>
                    
                </ul>
            </nav>
            <a href="carrinho.php" title="" class="carrinho">
                <img src="https://th.bing.com/th/id/OIP.-9pnm-it77cqrkeJu7E0FwHaHa?w=192&h=192&c=7&r=0&o=5&dpr=1.1&pid=1.7" alt="" width="30px" height="30px">
            </a>
            <img src="img/menu.png" alt="" class="menu-celular" onclick="menucelular()">
        </div>
    </div>
</div>

<style>
 /* Estilos para o novo menu */
.novoMenu {
    background-color: beige;
    border-bottom: 1px solid #333;
    padding: 10px 0;
    transition: all 0.8s ease-in-out;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    transition: all 0.8s ease-in-out;
    padding-top: 10px; /* Adicionando espaçamento acima da barra de navegação */
}

.logo {
    margin-right: 20px; /* Adicionando espaçamento entre o logo e o menu */
}

.logo img {
    width: 125px;
    height: auto;
    transition: all 0.8s ease-in-out;
}

.nav-menu ul {
    list-style: none;
    display: flex;
    transition: all 0.8s ease-in-out;
}

.nav-menu ul li {
    margin-right: 20px;
    transition: all 0.3s ease-in-out;
}

.nav-menu ul li:last-child {
    margin-right: 0;
}

.nav-menu ul li a {
    color: #333;
    text-decoration: none;
    font-weight: bold;
    transition: color 0.8s;
}

.nav-menu ul li a:hover {
    color: #007bff;
}

/* Estilos para o ícone do menu em dispositivos móveis */
.menu-celular {
    display: none;
    cursor: pointer;
    transition: all 0.3s ease-in-out;
}

@media only screen and (max-width: 768px) {
    .navbar {
        flex-direction: column;
        align-items: flex-start;
    }

    .menu-celular {
        display: block;
        width: 30px;
        height: 30px;
        transition: all 0.3s ease-in-out;
    }

    .nav-menu {
        display: none;
        width: 100%;
        transition: all 0.3s ease-in-out;
    }

    .nav-menu.show {
        display: block;
        transition: all 0.3s ease-in-out;
    }

    .nav-menu ul {
        flex-direction: column;
        padding-left: 0;
        transition: all 0.3s ease-in-out;
    }

    .nav-menu ul li {
        margin-bottom: 10px;
        transition: all 0.3s ease-in-out;
    }

    .carrinho {
        display: block; /* Mantendo o carrinho visível */
        margin-top: 10px; /* Adicionando espaçamento acima do carrinho */
    }
}
</style>

<script>
function menucelular() {
    var menu = document.getElementById("MenuItens");
    if (menu.classList.contains("show")) {
        menu.classList.remove("show");
    } else {
        menu.classList.add("show");
    }
}
</script>