<!-- MAIN -->
<main class="container-fluid p-3 p-lg-4">

    <!-- Heading tipo SB Admin -->
    <div class="d-flex flex-wrap align-items-center gap-2 mb-3">
        <div>
            <h1 class="h4 mb-0"><?php echo $titulo; ?></h1>
            <div class="text-muted small">Tablas de ejemplo con Bootstrap local (sin SB Admin).</div>
        </div>
        <div class="ms-auto d-flex gap-2">
            <a class="btn btn-primary" href="<?= base_url('ventas/nueva') ?>">Nueva venta</a>
            <button class="btn btn-outline-secondary" type="button">Exportar</button>
        </div>
    </div>
    <div>
        <p>
            <a href="<?= base_url('/categorias') ?>" class="btn btn-warning">Eliminados</a>
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
                            <th>nombre</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($datos as $dato) : ?>
                            <tr>
                                <td><?php echo $dato['id']; ?></td>
                                <td><?php echo $dato['nombre']; ?></td>
                                <td><a href="<?= base_url('/categorias/reingresar/' . $dato['id']) ?>" class="btn btn-sm btn-primary">Reingresar</a></td>
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