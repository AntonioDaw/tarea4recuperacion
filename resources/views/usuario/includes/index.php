<main>
    <a href="/usuario/nuevo">Nuevo usuario</a>
    <h1>Listado usuarios</h1>
    <form method="post" action="index">
        <input type="text" name="nombre" placeholder="Nombre">
        <input type="text" name="apellidos" placeholder="Apellidos">
        <input type="text" name="nick" placeholder="Nick">
        <input type="text" name="email" placeholder="Email">
        <input type="date" name="fecha_nacimiento">
        <input type="text" name="rol" placeholder="rol">
        <input type="number" name="ataque_min" placeholder="ataque mínimo">
        <input type="number" name="ataque_max" placeholder="ataque máximo">
        <input type="number" name="vida_min" placeholder="vida mínimo">
        <input type="number" name="vida_max" placeholder="vida máximo">
        <button type="submit" name="submit">Buscar</button>
    </form>
    <table>
        <tr>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Nick</th>
            <th>Email</th>
            <th>Fecha de Nacimiento</th>
            <th>rol</th>
            <th>Ataque</th>
            <th>Vida</th>
            <th>Acciones</th>


        </tr>
        <?php





        echo "</tr>";
        foreach ($data as $fila) {
            echo "<tr>";

            foreach ($fila as $clave => $valor) {
                if ($clave != 'id' && $clave != 'password') {
                    echo '<td>' . $valor . '</td>';
                }
            }
            echo '<td><form method="POST" action="/usuario/borrar" class="inline-form"><input type="hidden" name="id" value="'
                . $fila->id . '"><button type="submit" name="submit" class="btn btn-delete">Borrar</button>
    </form><a href="/usuario/' . $fila->id . '" class="btn btn-control">
        <button type="button" class="btn">Panel de Control</button>
    </a></td>';;
        }

        ?>

    </table>
    <?php
    ?>
</main>