
<main>
    <!-- La ruta en este caso será a POST -->
    <form action="table" method="post">
       <button type="submit">Crear tabla</button> 
    </form>
    <?php if (isset($data['error'])): ?>
    <div class="alert alert-danger">
        <?php echo $data['error']; ?>
    </div>
<?php endif; ?>
</main>
