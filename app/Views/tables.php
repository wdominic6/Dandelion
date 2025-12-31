<!-- MAIN -->
<main class="container-fluid p-3 p-lg-4">

  <!-- Heading tipo SB Admin -->
  <div class="d-flex flex-wrap align-items-center gap-2 mb-3">
    <div>
      <h1 class="h4 mb-0">Tablas</h1>
      <div class="text-muted small">Tablas de ejemplo con Bootstrap local (sin SB Admin).</div>
    </div>
    <div class="ms-auto d-flex gap-2">
      <a class="btn btn-primary" href="<?= base_url('ventas/nueva') ?>">Nueva venta</a>
      <button class="btn btn-outline-secondary" type="button">Exportar</button>
    </div>
  </div>

  <!-- Card 1: DataTables style (solo estructura) -->
  <div class="card mb-4">
    <div class="card-header">DataTables Example (estructura)</div>
    <div class="card-body">
      <p class="text-muted small mb-3">
        Si luego instalas DataTables localmente, aquí solo agregas los scripts y aplicas el init.
      </p>

      <div class="table-responsive">
        <table class="table table-striped table-hover align-middle mb-0 datatable">
          <thead class="table-light">
            <tr>
              <th>#</th>
              <th>Producto</th>
              <th>Categoría</th>
              <th class="text-end">Precio</th>
              <th class="text-end">Stock</th>
              <th>Estado</th>
              <th class="text-end">Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php
            // Ejemplo (en producción vendrá desde el controlador)
            $rows = $rows ?? [
              ['id' => 1, 'producto' => 'Mouse Inalámbrico', 'cat' => 'Accesorios', 'precio' => 12.50, 'stock' => 34, 'estado' => 'Activo'],
              ['id' => 2, 'producto' => 'Teclado Mecánico', 'cat' => 'Accesorios', 'precio' => 45.00, 'stock' => 12, 'estado' => 'Activo'],
              ['id' => 3, 'producto' => 'Monitor 24"', 'cat' => 'Pantallas', 'precio' => 129.99, 'stock' => 0, 'estado' => 'Agotado'],
            ];
            ?>
            <?php foreach ($rows as $r): ?>
              <tr>
                <td><?= esc($r['id']) ?></td>
                <td class="fw-semibold"><?= esc($r['producto']) ?></td>
                <td><?= esc($r['cat']) ?></td>
                <td class="text-end">$<?= number_format((float) $r['precio'], 2) ?></td>
                <td class="text-end"><?= (int) $r['stock'] ?></td>
                <td>
                  <?php if ($r['estado'] === 'Activo'): ?>
                    <span class="badge text-bg-success">Activo</span>
                  <?php elseif ($r['estado'] === 'Agotado'): ?>
                    <span class="badge text-bg-warning">Agotado</span>
                  <?php else: ?>
                    <span class="badge text-bg-secondary"><?= esc($r['estado']) ?></span>
                  <?php endif; ?>
                </td>
                <td class="text-end">
                  <div class="btn-group btn-group-sm" role="group">
                    <a class="btn btn-outline-primary" href="<?= base_url('productos/editar/' . $r['id']) ?>">Editar</a>
                    <button class="btn btn-outline-danger" type="button">Eliminar</button>
                  </div>
                </td>
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
        <table class="table table-bordered align-middle mb-0 datatable">
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