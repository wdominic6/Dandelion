<!-- MAIN -->
<main class="container-fluid p-3 p-lg-4">

    <!-- Heading tipo SB Admin -->
    <div class="container-fluid p-3 p-lg-4">
        <div>
            <h1 class="h4 mb-0"><?php echo $titulo; ?></h1>
            <?php if (isset($validation)) : ?>
                <div class="alert alert-danger">
                    <?php echo $validation->listErrors(); ?>
                </div>
            <?php endif; ?>
            <form action="<?= site_url('configuracion/actualizar') ?>" method="post" autocomplete="off">
                <?= csrf_field(); ?>
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label>Nombre de la tienda</label>
                            <input class="form-control" id="tienda_nombre" name="tienda_nombre" type="text"
                                value="<?= esc($nombre ?? '') ?>" required>
                        </div>

                        <div class="col-12 col-sm-6">
                            <label>RFC</label>
                            <input class="form-control" id="tienda_rfc" name="tienda_rfc" type="text"
                                value="<?= esc($rfc ?? '') ?>" required>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label>Teléfono de la tienda</label>
                            <input class="form-control" id="tienda_telefono" name="tienda_telefono" type="text"
                                value="<?= esc($telefono ?? '') ?>" required>
                        </div>

                        <div class="col-12 col-sm-6">
                            <label>Correo de la tienda</label>
                            <input class="form-control" id="tienda_email" name="tienda_email" type="text"
                                value="<?= esc($email ?? '') ?>" required>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label>Dirección de la tienda</label>
                            <textarea class="form-control" name="tienda_direccion" id="tienda_direccion"><?= esc($direccion ?? '') ?></textarea>
                        </div>

                        <div class="col-12 col-sm-6">
                            <label>Leyenda del ticket</label>
                            <textarea class="form-control" name="ticket_leyenda" id="ticket_leyenda"><?= esc($leyenda ?? '') ?></textarea>
                        </div>
                    </div>
                </div>
                <a href="<?= base_url('configuracion') ?>" class="btn btn-primary">Regresar</a>
                <button type="submit" class="btn btn-success">Guardar</button>
            </form>
        </div>
    </div>
</main>

<div class="modal fade" id="modal-confirma" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar registro</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>¿Desea eliminar este registro?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">NO</button>
                <a class="btn btn-danger btn-ok">Si</a>
            </div>
        </div>
    </div>
</div>