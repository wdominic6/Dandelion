<div class="container-fluid">
  <div class="d-flex flex-wrap align-items-center gap-2 mb-4">
    <div>
      <h1 class="h4 section-title mb-0">Dashboard</h1>
      <div class="text-muted small">Resumen general del negocio.</div>
    </div>
    <div class="ms-auto page-actions">
      <a class="btn btn-primary" href="<?= base_url('ventas/venta') ?>">Nueva venta</a>
      <a class="btn btn-outline-secondary" href="<?= base_url('clientes/nuevo') ?>">Nuevo cliente</a>
    </div>
  </div>

  <div class="row g-3 mb-4">
    <div class="col-12 col-sm-6 col-xl-3">
      <div class="card h-100">
        <div class="card-body">
          <div class="text-muted small">Ventas del dia</div>
          <div class="h4 mb-1">$<?= number_format((float) ($ventas_hoy_total ?? 0), 2) ?></div>
          <div class="text-muted small">Hoy</div>
        </div>
      </div>
    </div>
    <div class="col-12 col-sm-6 col-xl-3">
      <div class="card h-100">
        <div class="card-body">
          <div class="text-muted small">Ordenes del dia</div>
          <div class="h4 mb-1"><?= (int) ($ordenes_hoy ?? 0) ?></div>
          <div class="text-muted small">Hoy</div>
        </div>
      </div>
    </div>
    <div class="col-12 col-sm-6 col-xl-3">
      <div class="card h-100">
        <div class="card-body">
          <div class="text-muted small">Clientes activos</div>
          <div class="h4 mb-1"><?= (int) ($clientes_activos ?? 0) ?></div>
          <div class="text-muted small">Activos</div>
        </div>
      </div>
    </div>
    <div class="col-12 col-sm-6 col-xl-3">
      <div class="card h-100">
        <div class="card-body">
          <div class="text-muted small">Productos bajos</div>
          <div class="h4 mb-1"><?= (int) ($productos_bajos ?? 0) ?></div>
          <div class="text-muted small">En riesgo</div>
        </div>
      </div>
    </div>
  </div>

  <div class="row g-3 mb-4">
    <div class="col-12 col-lg-8">
      <div class="card h-100">
        <div class="card-header">Ventas ultimos 7 dias</div>
        <div class="card-body">
          <canvas id="ventasChart" height="120"></canvas>
          <?php if (empty($ventas_chart_labels ?? [])) : ?>
            <div class="text-muted small">Sin datos para mostrar.</div>
          <?php endif; ?>
        </div>
      </div>
    </div>
    <div class="col-12 col-lg-4">
      <div class="card h-100">
        <div class="card-header">Inventario bajo</div>
        <div class="card-body">
          <?php if (empty($inventario_bajo ?? [])) : ?>
            <div class="text-muted small">Sin alertas de inventario.</div>
          <?php else : ?>
            <div class="list-group list-group-flush">
              <?php foreach ($inventario_bajo as $producto) : ?>
                <div class="list-group-item d-flex justify-content-between align-items-center">
                  <span><?= esc($producto['nombre']) ?></span>
                  <span class="badge text-bg-warning"><?= (int) $producto['existencias'] ?></span>
                </div>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>
          <div class="mt-3">
            <a class="btn btn-sm btn-outline-primary" href="<?= base_url('productos') ?>">Ver productos</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php
  $forma_pago_map = [
    '001' => ['Efectivo', 'text-bg-success'],
    '002' => ['Tarjeta', 'text-bg-primary'],
    '003' => ['Transferencia', 'text-bg-warning'],
  ];
  ?>

  <div class="row g-3">
    <div class="col-12 col-lg-7">
      <div class="card h-100">
        <div class="card-header">Ventas recientes</div>
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
              <thead class="table-light">
                <tr>
                  <th>Ticket</th>
                  <th>Cliente</th>
                  <th>Pago</th>
                  <th class="text-end">Total</th>
                </tr>
              </thead>
              <tbody>
                <?php if (empty($ventas_recientes ?? [])) : ?>
                  <tr>
                    <td colspan="4" class="text-center text-muted">Sin ventas registradas.</td>
                  </tr>
                <?php else : ?>
                  <?php foreach ($ventas_recientes as $venta) : ?>
                    <?php
                      $pago = $forma_pago_map[$venta['forma_pago']] ?? ['Otro', 'text-bg-secondary'];
                      $cliente = $venta['cliente'] ?? 'Publico general';
                    ?>
                    <tr>
                      <td><?= esc($venta['folio']) ?></td>
                      <td><?= esc($cliente) ?></td>
                      <td><span class="badge <?= esc($pago[1]) ?>"><?= esc($pago[0]) ?></span></td>
                      <td class="text-end">$<?= number_format((float) $venta['total'], 2) ?></td>
                    </tr>
                  <?php endforeach; ?>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div class="col-12 col-lg-5">
      <div class="card h-100">
        <div class="card-header">Productos mas vendidos</div>
        <div class="card-body">
          <?php if (empty($top_productos ?? [])) : ?>
            <div class="text-muted small">No hay ventas registradas.</div>
          <?php else : ?>
            <?php foreach ($top_productos as $producto) : ?>
              <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                  <div class="fw-semibold"><?= esc($producto['nombre']) ?></div>
                  <div class="text-muted small"><?= (int) $producto['unidades'] ?> unidades</div>
                </div>
              </div>
            <?php endforeach; ?>
          <?php endif; ?>
          <div class="mt-3">
            <a class="btn btn-sm btn-outline-primary" href="<?= base_url('productos') ?>">Ver catalogo</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const chartEl = document.getElementById('ventasChart');
    if (!chartEl || typeof Chart === 'undefined') return;

    const labels = <?= json_encode($ventas_chart_labels ?? []) ?>;
    const data = <?= json_encode($ventas_chart_data ?? []) ?>;

    if (!labels.length) return;

    new Chart(chartEl, {
      type: 'line',
      data: {
        labels,
        datasets: [{
          label: 'Ventas',
          data,
          borderColor: '#1d4ed8',
          backgroundColor: 'rgba(29, 78, 216, 0.15)',
          tension: 0.35,
          fill: true
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: { display: false }
        },
        scales: {
          y: {
            ticks: { callback: (value) => '$' + value }
          }
        }
      }
    });
  });
</script>
