<main class="container-fluid p-3 p-lg-4">

    <!-- Heading tipo SB Admin -->
    <div class="container-fluid p-3 p-lg-4">
        <h4 class="mt-4"><?php echo $titulo; ?></h4>
        <form action="<?= base_url('/categorias/actualizar') ?>" method="post" autocomplete="off">

            <input type="hidden" value="<?php echo $datos['id']; ?>" name="id">

            <div class="form-group">
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <label>Nombre</label>
                        <input class="form-control" id="nombre" name="nombre" type="text"
                            value="<?php echo $datos['nombre']; ?>" autofocus required>
                    </div>
                </div>
            </div>
            <a href="<?= base_url('/categorias') ?>" class="btn btn-primary">Regresar</a>
            <button type="submit" class="btn btn-success">Guardar</button>
        </form>

</main>