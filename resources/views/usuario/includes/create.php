

<main>
<?php
$errores = $data;
    ?>
    <h1>Formulario de Registro</h1>
    <form method="post" action="store" enctype="multipart/form-data">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre"><br><br>
        <p class="error"><?php if (isset($errores['nombre'])) echo $errores['nombre']; ?></p>
        <label for="apellidos">Apellidos:</label>
        <input type="text" name="apellidos"><br><br>
        <p class="error"><?php if (isset($errores['apellidos'])) echo $errores['apellidos']; ?></p>
        <label for="nick">Nick:</label>
        <input type="text" name="nick"><br><br>
        <p class="error"><?php if (isset($errores['nick'])) echo $errores['nick']; ?></p>
        <label for="password">Contraseña:</label>
        <input type="text" name="password"><br><br>
        <p class="error"><?php if (isset($errores['password'])) echo $errores['password']; ?></p>
        <label for="email">Email:</label>
        <input type="text" name="email"><br><br>
        <p class="error"><?php if (isset($errores['email'])) echo $errores['email']; ?></p>
        <label for="fecha_nacimiento">Fecha de nacimiento:</label>
        <input type="date" name="fecha_nacimiento"><br><br>
        <p class="error"><?php if (isset($errores['fecha_nacimiento'])) echo $errores['fecha_nacimiento']; ?></p>
        <label for="saldo_inicial">Saldo Inicial:</label>
        <input type="number" name="saldo_inicial"><br><br>
        <p class="error"><?php if (isset($errores['saldo_inicial'])) echo $errores['saldo_inicial']; ?></p>
        <button type="submit" name="submit">Registrar</button>
        <p class="error"><?php if (isset($errores['registro'])) echo $errores['registro']; ?></p>
    </form>
</main>

