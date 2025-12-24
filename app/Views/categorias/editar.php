<div class="container-fluid">
  <div class="d-flex align-items-center justify-content-between mb-3">
    <div>
      <h1 class="h4 section-title mb-0"><?php echo $titulo; ?></h1>
      <div class="text-muted small">Actualiza la categoria.</div>
    </div>
  </div>

  <?= \Config\Services::validation()->listErrors(); ?>

  <div class="card">
    <div class="card-body">
      <form action="<?= base_url('/categorias/actualizar') ?>" method="post" autocomplete="off">
        <?= csrf_field() ?>
        <input type="hidden" id="id" name="id" value="<?php echo $categoria['id']; ?>">

        <div class="row g-3">
          <div class="col-12 col-md-6">
            <label class="form-label" for="nombre">Nombre</label>
            <input class="form-control" id="nombre" name="nombre" type="text" value="<?php echo $categoria['nombre']; ?>" autofocus required>
          </div>
        </div>

        <div class="d-flex gap-2 mt-4">
          <a href="<?= base_url('/categorias') ?>" class="btn btn-outline-secondary">Regresar</a>
          <button type="submit" class="btn btn-success">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>
