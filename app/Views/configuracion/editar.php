<main class="container-fluid p-3 p-lg-4">

    <!-- Heading tipo SB Admin -->
    <div class="container-fluid p-3 p-lg-4">
        <h4 class="mt-4"><?php echo $titulo; ?></h4>
         <?php if (isset($validation)) : ?>
            <div class="alert alert-danger">
            <?php echo $validation->listErrors(); ?>
            </div>
        <?php endif; ?>
        <form action="<?= base_url('unidades/actualizar') ?>" method="post" autocomplete="off">

            <input type="hidden" value="<?php echo $datos['id']; ?>" name="id">

            <div class="form-group">
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <label>Nombre</label>
                        <input class="form-control" id="nombre" name="nombre" type="text"
                            value="<?php echo $datos['nombre']; ?>" autofocus require>
                    </div>
                    <div class="col-12 col-sm-6">
                        <label>Nombre corto</label>
                        <input class="form-control" id="nombre_corto" name="nombre_corto" type="text"
                            value="<?php echo $datos['nombre_corto']; ?>" require>
                    </div>
                </div>
            </div>
            <a href="<?= base_url('unidades') ?>" class="btn btn-primary">Regresar</a>
            <button type="submit" class="btn btn-success">Guardar</button>
        </form>

</main>