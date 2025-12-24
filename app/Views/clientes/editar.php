<div class="container-fluid">
  <div class="d-flex align-items-center justify-content-between mb-3">
    <div>
      <h1 class="h4 section-title mb-0"><?php echo $titulo; ?></h1>
      <div class="text-muted small">Actualiza la informacion del cliente.</div>
    </div>
  </div>

  <?php if (isset($validation)) : ?>
    <div class="alert alert-danger">
      <?php echo $validation->listErrors(); ?>
    </div>
  <?php endif; ?>

  <div class="card">
    <div class="card-body">
      <form action="<?= site_url('clientes/actualizar') ?>" method="post" autocomplete="off">
        <?= csrf_field() ?>
        <input type="hidden" id="id" name="id" value="<?php echo $cliente['id']; ?>">

        <div class="row g-3">
          <div class="col-12 col-md-6">
            <label class="form-label" for="nombre">Nombre</label>
            <input class="form-control" id="nombre" name="nombre" type="text" value="<?php echo $cliente['nombre']; ?>" autofocus required>
          </div>
          <div class="col-12 col-md-6">
            <label class="form-label" for="direccion">Direccion</label>
            <input class="form-control" id="direccion" name="direccion" type="text" value="<?php echo $cliente['direccion']; ?>">
          </div>
          <div class="col-12 col-md-6">
            <label class="form-label" for="telefono">Telefono</label>
            <input class="form-control" id="telefono" name="telefono" type="text" value="<?php echo $cliente['telefono']; ?>">
          </div>
          <div class="col-12 col-md-6">
            <label class="form-label" for="correo">Correo</label>
            <input class="form-control" id="correo" name="correo" type="text" value="<?php echo $cliente['correo']; ?>">
          </div>
        </div>

        <div class="d-flex gap-2 mt-4">
          <a href="<?= base_url('clientes') ?>" class="btn btn-outline-secondary">Regresar</a>
          <button type="submit" class="btn btn-success">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>
