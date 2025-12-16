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
            <a href="<?= base_url('unidades/nuevo') ?>" class="btn btn-info">Agregar</a>
            <a href="<?= base_url('unidades/eliminados') ?>" class="btn btn-warning">Eliminados</a>

        </p>
    </div>


    <div class="text-muted small mt-3">
        Tip: cuando agregues DataTables/Chart.js localmente, evita CDN y cárgalos desde <code>public/assets</code>.
    </div>
</main>