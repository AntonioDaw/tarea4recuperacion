<main>
    <?php

    ?>
    <h1>Bienvenid@ <?php echo $data->getNombre() ?></h1>


    <h1>Formulario de Registro</h1>
    <form method="post" action="update" enctype="multipart/form-data">
        <label for="nombre">Nombre:</label>
        <input type="hidden" name="id" value="<?php echo $data->getId() ?>">
        <input type="text" name="nombre" value="<?php echo $data->getNombre() ?>"><br><br>
        <p class="error"><?php if (isset($_SESSION['errores']['nombre'])) echo $_SESSION['errores']['nombre']; ?></p>
        <label for="apellidos">Apellidos:</label>
        <input type="text" name="apellidos" value="<?php echo $data->getApellidos() ?>"><br><br>
        <p class="error"><?php if (isset($_SESSION['errores']['apellidos'])) echo $_SESSION['errores']['apellidos']; ?></p>
        <label for="nick">Nick:</label>
        <input type="text" name="nick" value="<?php echo $data->getNick() ?>"><br><br>
        <p class="error"><?php if (isset($_SESSION['errores']['nick'])) echo $_SESSION['errores']['nick']; ?></p>
        <label for="email">Email:</label>
        <input type="text" name="email" value="<?php echo $data->getEmail() ?>"><br><br>
        <p class="error"><?php if (isset($_SESSION['errores']['email'])) echo $_SESSION['errores']['email']; ?></p>
        <label for="fecha_nacimiento">Fecha de nacimiento:</label>
        <input type="date" name="fecha_nacimiento" value="<?php echo $data->getFecha_nacimiento() ?>"><br><br>
        <p class="error"><?php if (isset($_SESSION['errores']['fecha_nacimiento'])) echo $_SESSION['errores']['fecha_nacimiento']; ?></p>
        <label for="saldo_inicial">Saldo Inicial:</label>
        <input type="number" name="saldo_inicial" value="<?php echo $data->getSaldo_inicial() ?>"><br><br>
        <p class="error"><?php if (isset($_SESSION['errores']['saldo_inicial'])) echo $_SESSION['errores']['saldo_inicial']; ?></p>
        <button type="submit" name="submit">Guardar cambios</button>
        <p class="error"><?php if (isset($_SESSION['errores']['registro'])) echo $_SESSION['errores']['registro']; ?></p>
    </form>
    <form method="post" action="traspaso" enctype="multipart/form-data">
        <h1>Realizar transferencia</h1>
        <input type="hidden" name="id" value="<?php echo $data->getId() ?>">
        <label for="nick">Nick del Usuario:</label>
        <input type="text" name="nick"><br><br>
        <p class="error"><?php if (isset($_SESSION['errores']['nick'])) echo $_SESSION['errores']['nick']; ?></p>
        <label for="saldo_inicial">Cantidad:</label>
        <input type="number" name="saldo"><br><br>
        <p class="error"><?php if (isset($_SESSION['errores']['saldo'])) echo $_SESSION['errores']['saldo']; ?></p>
        <button type="submit" name="submit">Realizar transferencia</button>
        <p class="error"><?php if (isset($_SESSION['errores']['registro'])) echo $_SESSION['errores']['registro']; ?></p>
    </form>

</main>