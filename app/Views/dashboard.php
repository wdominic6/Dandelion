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

  <?php
  $stats = $stats ?? [
    ['label' => 'Ventas del dia', 'value' => '$1,240', 'delta' => '+8%'],
    ['label' => 'Ordenes', 'value' => '32', 'delta' => '+3%'],
    ['label' => 'Clientes activos', 'value' => '214', 'delta' => '+2%'],
    ['label' => 'Productos bajos', 'value' => '9', 'delta' => '-1%'],
  ];
  ?>

  <div class="row g-3 mb-4">
    <?php foreach ($stats as $stat): ?>
      <div class="col-12 col-sm-6 col-xl-3">
        <div class="card h-100">
          <div class="card-body">
            <div class="text-muted small"><?= esc($stat['label']) ?></div>
            <div class="d-flex align-items-end justify-content-between">
              <div class="h4 mb-0"><?= esc($stat['value']) ?></div>
              <span class="badge badge-soft"><?= esc($stat['delta']) ?></span>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

  <div class="row g-3 mb-4">
    <div class="col-12 col-lg-8">
      <div class="card h-100">
        <div class="card-header">Ventas ultimos 7 dias</div>
        <div class="card-body">
          <canvas id="ventasChart" height="120"></canvas>
        </div>
      </div>
    </div>
    <div class="col-12 col-lg-4">
      <div class="card h-100">
        <div class="card-header">Inventario bajo</div>
        <div class="card-body">
          <div class="list-group list-group-flush">
            <div class="list-group-item d-flex justify-content-between align-items-center">
              <span>Azucar 1kg</span>
              <span class="badge text-bg-warning">4</span>
            </div>
            <div class="list-group-item d-flex justify-content-between align-items-center">
              <span>Aceite 1L</span>
              <span class="badge text-bg-warning">3</span>
            </div>
            <div class="list-group-item d-flex justify-content-between align-items-center">
              <span>Servilletas</span>
              <span class="badge text-bg-warning">2</span>
            </div>
            <div class="list-group-item d-flex justify-content-between align-items-center">
              <span>Cafe molido</span>
              <span class="badge text-bg-warning">1</span>
            </div>
          </div>
          <div class="mt-3">
            <a class="btn btn-sm btn-outline-primary" href="<?= base_url('productos') ?>">Ver productos</a>
          </div>
        </div>
      </div>
    </div>
  </div>

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
                <tr>
                  <td>#V-1023</td>
                  <td>Maria Gomez</td>
                  <td><span class="badge text-bg-success">Efectivo</span></td>
                  <td class="text-end">$85.20</td>
                </tr>
                <tr>
                  <td>#V-1022</td>
                  <td>Juan Perez</td>
                  <td><span class="badge text-bg-primary">Tarjeta</span></td>
                  <td class="text-end">$42.50</td>
                </tr>
                <tr>
                  <td>#V-1021</td>
                  <td>Publico general</td>
                  <td><span class="badge text-bg-warning">Transferencia</span></td>
                  <td class="text-end">$19.90</td>
                </tr>
                <tr>
                  <td>#V-1020</td>
                  <td>Ana Lopez</td>
                  <td><span class="badge text-bg-success">Efectivo</span></td>
                  <td class="text-end">$68.00</td>
                </tr>
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
          <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
              <div class="fw-semibold">Cafe molido</div>
              <div class="text-muted small">120 unidades</div>
            </div>
            <span class="badge text-bg-primary">Top</span>
          </div>
          <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
              <div class="fw-semibold">Leche deslactosada</div>
              <div class="text-muted small">98 unidades</div>
            </div>
          </div>
          <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
              <div class="fw-semibold">Pan integral</div>
              <div class="text-muted small">84 unidades</div>
            </div>
          </div>
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <div class="fw-semibold">Azucar 1kg</div>
              <div class="text-muted small">72 unidades</div>
            </div>
          </div>
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

    new Chart(chartEl, {
      type: 'line',
      data: {
        labels: ['Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab', 'Dom'],
        datasets: [{
          label: 'Ventas',
          data: [120, 180, 150, 220, 260, 210, 190],
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
