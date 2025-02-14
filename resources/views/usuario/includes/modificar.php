<main>

    <h1>Bienvenid@ <?php echo $data->getNombre() ?></h1>


    <h1>Modificar</h1>
    <form method="post" action="/usuario/actualizar" enctype="multipart/form-data">
        <label for="nombre">Nombre:</label>
        <input type="hidden" name="id" value="<?php echo $data->getId() ?>">
        <input type="text" name="nombre" value="<?php echo $data->getNombre() ?>"><br><br>
        <p class="error"><?php if (isset($errores['nombre'])){echo $data['errores']['nombre'];}; ?></p>
        <label for="apellidos">Apellidos:</label>
        <input type="text" name="apellidos" value="<?php echo $data->getApellidos() ?>"><br><br>
        <p class="error"><?php if (isset($errores['apellidos'])) {echo $data['errores']['apellidos'];}; ?></p>
        <label for="nick">Nick:</label>
        <input type="text" name="nick" value="<?php echo $data->getNick() ?>"><br><br>
        <p class="error"><?php if (isset($errores['nick'])){ echo $data['errores']['nick'];} ?></p>
        <label for="email">Email:</label>
        <input type="text" name="email" value="<?php echo $data->getEmail() ?>"><br><br>
        <p class="error"><?php if (isset($errores['email'])){ echo $data['errores']['email'];} ?></p>
        <label for="fecha_nacimiento">Fecha de nacimiento:</label>
        <input type="date" name="fecha_nacimiento" value="<?php echo $data->getFecha_nacimiento() ?>"><br><br>
        <p class="error"><?php if (isset($errores['fecha_nacimiento'])) {echo $data['errores']['fecha_nacimiento'];} ?></p>
        <label for="saldo_inicial">Saldo Inicial:</label>
        <input type="number" name="saldo_inicial" value="<?php echo $data->getSaldo_inicial() ?>"><br><br>
        <p class="error"><?php if (isset($errores['saldo_inicial'])){ echo $data['errores']['saldo_inicial'];} ?></p>
        <button type="submit" name="submit">Guardar cambios</button>
        <p class="error"><?php if (isset($errores['registro'])) {echo $data['errores']['registro'];} ?></p>
    </form>

</main>