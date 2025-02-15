<main>
    <?php

    ?>
    <h1>Bienvenid@ <?php echo $data['nombre'] ?></h1>


    <h1>Formulario de Registro</h1>
    <form method="post" action="update" enctype="multipart/form-data">
        <label for="nombre">Nombre:</label>
        <input type="hidden" name="id" value="<?php echo $data['id'] ?>">
        <input type="text" name="nombre" value="<?php echo $data['nombre'] ?>"><br><br>
        <p class="error"><?php if (isset($_SESSION['errores']['nombre'])) echo $_SESSION['errores']['nombre']; ?></p>
        <label for="apellidos">Apellidos:</label>
        <input type="text" name="apellidos" value="<?php echo $data['apellidos'] ?>"><br><br>
        <p class="error"><?php if (isset($_SESSION['errores']['apellidos'])) echo $_SESSION['errores']['apellidos']; ?></p>
        <label for="nick">Nick:</label>
        <input type="text" name="nick" value="<?php echo $data['nick'] ?>"><br><br>
        <p class="error"><?php if (isset($_SESSION['errores']['nick'])) echo $_SESSION['errores']['nick']; ?></p>
        <label for="email">Email:</label>
        <p><?php echo $data['email'] ?></p>
        <label for="fecha_nacimiento">Fecha de nacimiento:</label>
        <input type="date" name="fecha_nacimiento" value="<?php echo $data['fecha_nacimiento'] ?>"><br><br>
        <p class="error"><?php if (isset($_SESSION['errores']['fecha_nacimiento'])) echo $_SESSION['errores']['fecha_nacimiento']; ?></p>
        <label for="rol">Selecciona el rol:</label>
        <select name="rol" id="rol">
            <option value="admin" <?php echo isset($data['rol']) && $data['rol'] == 'admin' ? 'selected' : ''; ?>>Administrador</option>
            <option value="user" <?php echo isset($data['rol']) && $data['rol'] == 'user' ? 'selected' : ''; ?>>Usuario</option>
        </select>
        <p class="error"><?php if (isset($errores['rol'])) echo $errores['rol']; ?></p>
        <button type="submit" name="submit">Guardar cambios</button>
        <p class="error"><?php if (isset($_SESSION['errores']['registro'])) echo $_SESSION['errores']['registro']; ?></p>
    </form>
    <label for="email">Ataque:</label>
    <p><?php echo $data['puntos_ataque'] ?></p>
    <label for="email">Vida:</label>
    <p><?php echo $data['nivel_vida'] ?></p>
    

</main>