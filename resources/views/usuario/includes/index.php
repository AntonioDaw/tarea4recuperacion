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
            <th>Saldo</th>


        </tr>
        <?php


        // $data está definido en Controller.php y pasado en UsuarioController.php

        // Utilizo getclassmethods para poner los nombres de las columnas y llamar a los atributos para rellenarlas



        echo "</tr>";
        foreach ($data['usuarios'] as $fila) {
            // solo metodos get, lo logramos con strpos y pasandole get al nombre el metodo
            // exculimos los que no queremos mostrar en la tabla en un principio con dos que se suelen mostrar pero se pueden añadir mas
            //  de forma sencilla en función de las necesidades de la aplicación.
            echo "<tr>";

            foreach (get_class_methods($fila) as $metodos) {
                // solo los llamamos en caso de ser metodos get
                if (strpos($metodos, 'get') === 0) {
                    if ($metodos !== 'getId' && $metodos !== 'getPassword') {
                        // aquí en cambio usamos los metodos la variable metodos es getNombre, getApellidos y así sucesivamente
                        echo "<td>" . ($fila->$metodos()) . "</td>";
                    }
                }
            }
            echo '<td><form method="POST" action="/usuario/borrar" class="inline-form"><input type="hidden" name="id" value="'
                . $fila->getId() . '"><button type="submit" name="submit" class="btn btn-delete">Borrar</button>
    </form><a href="/usuario/modificar/' . $fila->getId() . '" class="btn btn-control">
        <button type="button" class="btn">Panel de Control</button>
    </a></td>';;
        }

        ?>

    </table>
    <?php

    for ($i = 0; $i < $data['paginas']; $i++) {
        echo ($i > 0 ? ' | ' : '') . '<a href="/usuarios/5/' . ($i * 5) . '?nombre=' . $_GET['nombre']
            . '&apellidos=' . $_GET['apellidos'] . '&nick=' . $_GET['nick'] . '&email=' . $_GET['email'] . '&fecha_nacimiento='
            . $_GET['fecha_nacimiento'] . '&saldo_min=' . $_GET['saldo_min'] . '&saldo_max=' . $_GET['saldo_max'] . '&submit=">' . $i + 1 . '</a>';
    }
    ?>
</main>