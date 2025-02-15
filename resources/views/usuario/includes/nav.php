<nav>
    <ul><?php if(isset($_SESSION['nick'])):?>
        <li><a href="/usuario/pagina/1">Inicio</a></li>
        <?php endif?>
        <?php if(!isset($_SESSION['nick'])):?>
        <li><a href="/usuario/login">Login</a></li>
        <?php endif?>
        <li><a href="/usuario/nuevo">Nuevo usuario</a></li>
        <?php if(isset($_SESSION['nick'])):?>
        <li><a href="/usuario/salir">Salir</a></li>
        <?php endif?>
        <?php if(isset($_SESSION['id'])):?>
            <li><a href="/usuario/<?php echo $_SESSION['id']?>">Panel de Control</a></li>
        <?php endif?>
    </ul>
</nav>