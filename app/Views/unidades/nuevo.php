<div class="container-fluid">
  <div class="d-flex align-items-center justify-content-between mb-3">
    <div>
      <h1 class="h4 section-title mb-0"><?php echo $titulo; ?></h1>
      <div class="text-muted small">Crea una nueva unidad de medida.</div>
    </div>
  </div>

  <?php if (isset($validation)) : ?>
    <div class="alert alert-danger">
      <?php echo $validation->listErrors(); ?>
    </div>
  <?php endif; ?>

  <div class="card">
    <div class="card-body">
      <form action="<?= base_url('/unidades/insertar') ?>" method="post" autocomplete="off">
        <div class="row g-3">
          <div class="col-12 col-md-6">
            <label class="form-label" for="nombre">Nombre</label>
            <input class="form-control" id="nombre" name="nombre" type="text" autofocus required>
          </div>
        </div>

        <div class="d-flex gap-2 mt-4">
          <a href="<?= base_url('/unidades') ?>" class="btn btn-outline-secondary">Regresar</a>
          <button type="submit" class="btn btn-success">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>
