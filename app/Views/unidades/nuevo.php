<!-- MAIN -->
<main class="container-fluid p-3 p-lg-4">

    <!-- Heading tipo SB Admin -->
    <div class="container-fluid p-3 p-lg-4">
        <h4 class="mt-4"><?php echo $titulo; ?></h4>
        <?= \Config\Services::validation()->listErrors(); ?>
        <form action="<?= site_url('unidades/insertar') ?>" method="post" autocomplete="off">
    <?= csrf_field() ?>

        <!--form action="<?= base_url('unidades/insertar') ?>" method="post" autocomplete="off"-->
            <?php csrf_field(); ?>
            <div class="form-group">
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <label>Nombre</label>
                        <input class="form-control" id="nombre" name="nombre" type="text" autofocus required>
                    </div>
                    <div class="col-12 col-sm-6">
                        <label>Nombre corto</label>
                        <input class="form-control" id="nombre_corto" name="nombre_corto" type="text" required>
                    </div>
                </div>
            </div>
            <a href="<?= base_url('unidades') ?>" class="btn btn-primary">Regresar</a>
            <button type="submit" class="btn btn-success">Guardar</button>
        </form>
       
</main>