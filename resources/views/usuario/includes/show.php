<main>

    <h1>Panel de control</h1>
    <form method="post" action="update" enctype="multipart/form-data">
        <label for="nombre">Nombre:</label>
        <input type="hidden" name="id" value="<?php echo isset($data['id']) ? $data['id'] : ''; ?>">
        <input type="text" name="nombre" value="<?php echo isset($data['nombre']) ? $data['nombre'] : ''; ?>"><br><br>
        <p class="error"><?php if (isset($data['errores']['nombre'])) echo $data['errores']['nombre']; ?></p>

        <label for="apellidos">Apellidos:</label>
        <input type="text" name="apellidos" value="<?php echo isset($data['apellidos']) ? $data['apellidos'] : ''; ?>"><br><br>
        <p class="error"><?php if (isset($data['errores']['apellidos'])) echo $data['errores']['apellidos']; ?></p>

        <label for="nick">Nick:</label>
        <input type="text" name="nick" value="<?php echo isset($data['nick']) ? $data['nick'] : ''; ?>"><br><br>
        <p class="error"><?php if (isset($data['errores']['nick'])) echo $data['errores']['nick']; ?></p>

        <label for="email">Email:</label>
        <p><?php echo isset($data['email']) ? $data['email'] : ''; ?></p>

        <label for="fecha_nacimiento">Fecha de nacimiento:</label>
        <input type="date" name="fecha_nacimiento" value="<?php echo isset($data['fecha_nacimiento']) ? $data['fecha_nacimiento'] : ''; ?>"><br><br>
        <p class="error"><?php if (isset($data['errores']['fecha_nacimiento'])) echo $data['errores']['fecha_nacimiento']; ?></p>

        <label for="rol">Selecciona el rol:</label>
        <select name="rol" id="rol">
            <option value="admin" <?php echo isset($data['rol']) && $data['rol'] == 'admin' ? 'selected' : ''; ?>>Administrador</option>
            <option value="user" <?php echo isset($data['rol']) && $data['rol'] == 'user' ? 'selected' : ''; ?>>Usuario</option>
        </select>
        <p class="error"><?php if (isset($data['errores']['rol'])) echo $data['errores']['rol']; ?></p>

        <button type="submit" name="submit">Guardar cambios</button>
        <p class="error"><?php if (isset($_SESSION['errores']['registro'])) echo $_SESSION['errores']['registro']; ?></p>
    </form>

    <label for="email">Ataque:</label>
    <p><?php echo isset($data['puntos_ataque']) ? $data['puntos_ataque'] : ''; ?></p>

    <label for="email">Vida:</label>
    <p><?php echo isset($data['nivel_vida']) ? $data['nivel_vida'] : ''; ?></p>
</main>