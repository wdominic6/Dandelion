<div class="container-fluid">
  <div class="d-flex flex-wrap align-items-center gap-2 mb-3">
    <div>
      <h1 class="h4 section-title mb-0"><?php echo $titulo; ?></h1>
      <div class="text-muted small">Gestiona tus clientes registrados.</div>
    </div>
    <div class="ms-auto page-actions">
      <a class="btn btn-primary" href="<?= base_url('/clientes/nuevo/') ?>">Agregar cliente</a>
      <a class="btn btn-outline-secondary" href="<?= base_url('/clientes/eliminados/') ?>">Eliminados</a>
    </div>
  </div>

  <div class="card">
    <div class="card-header">Listado de clientes</div>
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-striped table-hover align-middle mb-0 datatable">
          <thead class="table-light">
            <tr>
              <th>Id</th>
              <th>Nombre</th>
              <th>Direccion</th>
              <th>Telefono</th>
              <th>Correo</th>
              <th class="text-end">Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($datos as $dato) : ?>
              <tr>
                <td><?php echo $dato['id']; ?></td>
                <td><?php echo $dato['nombre']; ?></td>
                <td><?php echo $dato['direccion']; ?></td>
                <td><?php echo $dato['telefono']; ?></td>
                <td><?php echo $dato['correo']; ?></td>
                <td class="text-end">
                  <a href="<?= base_url('/clientes/editar/' . $dato['id']) ?>" class="btn btn-sm btn-outline-primary">Editar</a>
                  <a href="#"
                     data-href="<?= base_url('/clientes/eliminar/' . $dato['id']) ?>"
                     data-bs-toggle="modal"
                     data-bs-target="#modal-confirma"
                     class="btn btn-sm btn-danger">Eliminar</a>
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
        <h1 class="modal-title fs-6" id="modal-confirma-label">Eliminar registro</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        <p class="mb-0">Desea eliminar este registro?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
        <a class="btn btn-danger btn-ok">Eliminar</a>
      </div>
    </div>
  </div>
</div>
