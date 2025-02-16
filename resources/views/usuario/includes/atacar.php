<main>
    <form action="/usuario/ataque" method="POST">
        <h1>INTERFAZ DE ATAQUE</h1>
        <table>
            <tr>
                <th>
                    <?php
                    if (isset($_SESSION['mensaje'])) {
                        echo '<div class="alert">' . $_SESSION['mensaje'] . '</div>';

                        // Eliminar el mensaje después de mostrarlo para que no se repita
                        unset($_SESSION['mensaje']);
                    }
                    ?></th>
                <th>Nombre</th>
                <th>Salud</th>
            </tr>
            <?php foreach ($data['usuarios'] as $usuario): ?>
                <tr>
                    <td>
                        <?php if ($usuario->id != $_SESSION['id']): ?>
                            <input type="checkbox" name="objetivos[]" value="<?php echo $usuario->id ?>"> Seleccion de objetivo

                    </td>
                    <td><?php echo $usuario->nombre ?></td>
                    <td><?php echo $usuario->nivel_vida ?></td>
                <?php else: ?>
                    <?php echo "No puedes atacarte a ti mismo!!!" ?>
                    <td><?php echo $usuario->nombre ?></td>
                    <td><?php echo $usuario->nivel_vida ?></td>
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>
        </table>
        <!-- En la vista -->
        <?php echo isset($mensaje) ? $data[$mensaje] : ''; ?>
        <br><br>
        <?php

        for ($i = 0; $i < $data['paginas']; $i++) {
            echo ($i > 0 ? ' | ' : '') . '<a href="/usuario/atacar/' . ($i + 1) . '">' . ($i + 1) . '</a>';
        }
        ?>
        <br><br>
        <button type="submit">Atacar</button>
    </form>
</main>