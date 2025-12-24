<div class="container-fluid">
  <div class="d-flex align-items-center justify-content-between mb-3">
    <div>
      <h1 class="h4 section-title mb-0"><?php echo $titulo; ?></h1>
      <div class="text-muted small">Crea un nuevo producto.</div>
    </div>
  </div>

  <?php if (isset($validation)) : ?>
    <div class="alert alert-danger">
      <?php echo $validation->listErrors(); ?>
    </div>
  <?php endif; ?>

  <div class="card">
    <div class="card-body">
      <form action="<?= site_url('productos/insertar') ?>" method="post" autocomplete="off">
        <div class="row g-3">
          <div class="col-12 col-md-6">
            <label class="form-label" for="codigo">Codigo</label>
            <input class="form-control" id="codigo" name="codigo" type="text" autofocus required>
          </div>
          <div class="col-12 col-md-6">
            <label class="form-label" for="nombre">Nombre</label>
            <input class="form-control" id="nombre" name="nombre" type="text" required>
          </div>
          <div class="col-12 col-md-6">
            <label class="form-label" for="id_unidad">Unidad</label>
            <select class="form-select" id="id_unidad" name="id_unidad" required>
              <option value="">Seleccionar unidad</option>
              <?php foreach ($unidades as $unidad) : ?>
                <option value="<?php echo $unidad['id']; ?>"><?php echo $unidad['nombre']; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-12 col-md-6">
            <label class="form-label" for="id_categoria">Categoria</label>
            <select class="form-select" id="id_categoria" name="id_categoria" required>
              <option value="">Seleccionar categoria</option>
              <?php foreach ($categorias as $categoria) : ?>
                <option value="<?php echo $categoria['id']; ?>"><?php echo $categoria['nombre']; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-12 col-md-6">
            <label class="form-label" for="precio_venta">Precio venta</label>
            <input class="form-control" id="precio_venta" name="precio_venta" type="text" required>
          </div>
          <div class="col-12 col-md-6">
            <label class="form-label" for="precio_compra">Precio compra</label>
            <input class="form-control" id="precio_compra" name="precio_compra" type="text" required>
          </div>
          <div class="col-12 col-md-6">
            <label class="form-label" for="stock_minimo">Stock minimo</label>
            <input class="form-control" id="stock_minimo" name="stock_minimo" type="text" required>
          </div>
          <div class="col-12 col-md-6">
            <label class="form-label" for="inventariable">Es inventariable</label>
            <select class="form-select" id="inventariable" name="inventariable" required>
              <option value="1">Si</option>
              <option value="0">No</option>
            </select>
          </div>
        </div>

        <div class="d-flex gap-2 mt-4">
          <a href="<?= base_url('productos') ?>" class="btn btn-outline-secondary">Regresar</a>
          <button type="submit" class="btn btn-success">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>
