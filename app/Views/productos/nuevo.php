<!-- MAIN -->
<main class="container-fluid p-3 p-lg-4">

    <!-- Heading tipo SB Admin -->
    <div class="container-fluid p-3 p-lg-4">
        <h4 class="mt-4"><?php echo $titulo; ?></h4>
        <?= \Config\Services::validation()->listErrors(); ?>
        <form action="<?= site_url('productos/insertar') ?>" method="post" autocomplete="off">
            <?= csrf_field() ?>
            <div class="form-group">
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <label>Codigo</label>
                        <input class="form-control" id="codigo" name="codigo" type="text" autofocus required>
                    </div>
                    <div class="col-12 col-sm-6">
                        <label>Nombre</label>
                        <input class="form-control" id="nombre" name="nombre" type="text" required>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <label>Unidad</label>
                        <select class="form-control" id="id_unidad" name="id_unidad" required>
                            <option value="">Seleccionar unidad</option>
                            <?php foreach ($unidades as $unidad) : ?>
                                <option value="<?php echo $unidad['id']; ?>"><?php echo $unidad['nombre']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-12 col-sm-6">
                        <label>Categoría</label>
                        <select class="form-control" id="id_categoria" name="id_categoria" required>
                            <option value="">Seleccionar categoría</option>
                            <?php foreach ($categorias as $categoria) : ?>
                                <option value="<?php echo $categoria['id']; ?>"><?php echo $categoria['nombre']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <label>Precio venta</label>
                        <input class="form-control" id="precio_venta" name="precio_venta" type="text" autofocus required>
                    </div>
                    <div class="col-12 col-sm-6">
                        <label>Precio_compra</label>
                        <input class="form-control" id="precio_compra" name="precio_compra" type="text" required>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <label>Stock minimo</label>
                        <input class="form-control" id="stock_minimo" name="stock_minimo" type="text" autofocus required>
                    </div>
                    <div class="col-12 col-sm-6">
                        <label>Es inventariable</label>
                        <select class="form-control" id="inventariable" name="inventariable" required>
                            <option value="1">Sí</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                </div>
            </div>
            <a href="<?= base_url('productos') ?>" class="btn btn-primary">Regresar</a>
            <button type="submit" class="btn btn-success">Guardar</button>
        </form>

</main>