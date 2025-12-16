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
            <a href="href="<?= base_url('unidades/nuevo') ?>" class="btn btn-info">Agregar</a>
            <a href="href="<?= base_url('unidades/eliminados') ?>" class="btn btn-warning">Eliminados</a>
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
                            <th>Nombre corto</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($datos as $dato) : ?>
                            <tr>
                                <td><?php echo $dato['id']; ?></td>
                                <td><?php echo $dato['nombre']; ?></td>
                                <td><?php echo $dato['nombre_corto']; ?></td>
                                <td><a href="<?= base_url('unidades/editar' . $dato['id']) ?>" class="btn btn-sm btn-primary">Editar</a></td>
                                <td><a href="<?= base_url('unidades/eliminar' . $dato['id']) ?>" class="btn btn-sm btn-danger">Eliminar</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <!-- Card 2: Simple Table -->
    <div class="card">
        <div class="card-header">Simple Table</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Cliente</th>
                            <th>Documento</th>
                            <th>Teléfono</th>
                            <th>Correo</th>
                            <th class="text-end">Compras</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Ana López</td>
                            <td>0102030405</td>
                            <td>0999999999</td>
                            <td>ana@example.com</td>
                            <td class="text-end">12</td>
                        </tr>
                        <tr>
                            <td>Juan Pérez</td>
                            <td>1112131415</td>
                            <td>0988888888</td>
                            <td>juan@example.com</td>
                            <td class="text-end">4</td>
                        </tr>
                        <tr>
                            <td>María Gómez</td>
                            <td>2021222324</td>
                            <td>0977777777</td>
                            <td>maria@example.com</td>
                            <td class="text-end">7</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="text-muted small mt-3">
        Tip: cuando agregues DataTables/Chart.js localmente, evita CDN y cárgalos desde <code>public/assets</code>.
    </div>
</main>