<div class="container-fluid">
  <div class="d-flex flex-wrap align-items-center gap-2 mb-3">
    <div>
      <h1 class="h4 section-title mb-0"><?php echo $titulo; ?></h1>
      <div class="text-muted small">Categorias marcadas como eliminadas.</div>
    </div>
    <div class="ms-auto page-actions">
      <a href="<?= base_url('/categorias') ?>" class="btn btn-outline-secondary">Volver a categorias</a>
    </div>
  </div>

  <div class="card">
    <div class="card-header">Categorias eliminadas</div>
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-striped table-hover align-middle mb-0">
          <thead class="table-light">
            <tr>
              <th>Id</th>
              <th>Nombre</th>
              <th class="text-end">Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($datos as $dato) : ?>
              <tr>
                <td><?php echo $dato['id']; ?></td>
                <td><?php echo $dato['nombre']; ?></td>
                <td class="text-end">
                  <a href="#"
                     data-href="<?= base_url('/categorias/reingresar/' . $dato['id']) ?>"
                     data-bs-toggle="modal"
                     data-bs-target="#modal-confirma"
                     class="btn btn-sm btn-outline-primary">Reingresar</a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-confirma" tabindex="-1" aria-labelledby="modal-confirma-label" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-6" id="modal-confirma-label">Reingresar registro</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        <p class="mb-0">Desea reingresar este registro?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
        <a class="btn btn-primary btn-ok">Reingresar</a>
      </div>
    </div>
  </div>
</div>
