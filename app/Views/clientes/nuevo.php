<!-- MAIN -->
<main class="container-fluid p-3 p-lg-4">

    <!-- Heading tipo SB Admin -->
    <div class="container-fluid p-3 p-lg-4">
        <h4 class="mt-4"><?php echo $titulo; ?></h4>

        <?php if (isset($validation)) : ?>
            <div class="alert alert-danger">
                <?php echo $validation->listErrors(); ?>
            </div>
        <?php endif; ?>

        <form action="<?= site_url('clientes/insertar') ?>" method="post" autocomplete="off">
            <div class="form-group">
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <label>Nombre</label>
                        <input class="form-control" id="nombre" name="nombre" type="text" autofocus required>
                    </div>
                    <div class="col-12 col-sm-6">
                        <label>Direccion</label>
                        <input class="form-control" id="direccion" name="direccion" type="text" >
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <label>Telefono</label>
                        <input class="form-control" id="telefono" name="telefono" type="text" >
                    </div>
                    <div class="col-12 col-sm-6">
                        <label>Correo</label>
                        <input class="form-control" id="correo" name="correo" type="text" >
                    </div>
                </div>
            </div>
            <a href="<?= base_url('productos') ?>" class="btn btn-primary">Regresar</a>
            <button type="submit" class="btn btn-success">Guardar</button>
        </form>

</main>