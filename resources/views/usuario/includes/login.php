<main>
<form action="/usuario/login" method="post">
<label for="nombre">Nick:</label>
        <input type="text" name="nick"><br><br>
        <p class="error"><?php if (isset($data['nick'])) echo $data['nick']; ?></p>
<label for="password">Contraseña:</label>
        <input type="text" name="password"><br><br>
        <p class="error"><?php if (isset($data['password'])) echo $data['password']; ?></p>
        <button type="submit" name="submit">Enviar</button><br><br>
</form>
<a href="nuevo">Nuevo Usuario</a>
<p class="error"><?php if (isset($data['mensaje'])) echo $data['mensaje']; ?></p>
    
</main>