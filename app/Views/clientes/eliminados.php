<!-- MAIN -->
<main class="container-fluid p-3 p-lg-4">

    <!-- Heading tipo SB Admin -->
    <div class="d-flex flex-wrap align-items-center gap-2 mb-3">
        <div>
            <h1 class="h4 mb-0"><?php echo $titulo; ?></h1>
        </div>
    </div>
    <div>
        <p>
            <a href="<?= base_url('/clientes') ?>" class="btn btn-warning">Clientes</a>
        </p>
    </div>
    <!-- Card 1: DataTables style (solo estructura) -->
    <div class="card mb-4">
        <div class="card-header">DataTables Example (estructura)</div>
        <div class="card-body">
            <p class="text-muted small mb-3">
                Si luego instalas DataTables localmente, aquí solo agregas los scripts y aplicas el init.
            </p>

            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Direccion</th>
                            <th>Telefono</th>
                            <th>Correo</th>
                            <th></th>
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
                                <td><a href="#"
                                        data-href="<?= base_url('/clientes/reingresar/' . $dato['id']) ?>"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modal-confirma" data-placement="top" title="Reingresar registro" class="btn btn-sm btn-primary">Reingresar</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <div class="text-muted small mt-3">
        Tip: cuando agregues DataTables/Chart.js localmente, evita CDN y cárgalos desde <code>public/assets</code>.
    </div>
</main>
<div class="modal fade" id="modal-confirma" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Reingresar registro</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>¿Desea reingresar este registro?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">NO</button>
                <a class="btn btn-danger btn-ok">Si</a>
            </div>
        </div>
    </div>
</div>