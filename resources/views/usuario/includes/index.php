<main>
    <a href="/usuario/nuevo">Nuevo usuario</a>
    <h1>Listado usuarios</h1>
    <form method="get" action="/usuarios/5/0">
        <input type="text" name="nombre" placeholder="Nombre">
        <input type="text" name="apellidos" placeholder="Apellidos">
        <input type="text" name="nick" placeholder="Nick">
        <input type="text" name="email" placeholder="Email">
        <input type="date" name="fecha_nacimiento">
        <input type="number" name="saldo_min" placeholder="Saldo mínimo">
        <input type="number" name="saldo_max" placeholder="Saldo máximo">
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
        foreach ($data['usuarios'] as $fila) {
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

    for ($i = 0; $i < $data['paginas']; $i++) {
        echo ($i > 0 ? ' | ' : '') . '<a href="/usuario/pagina/' . ($i + 1) . '">' . ($i + 1) . '</a>';
    }
    ?>
</main>