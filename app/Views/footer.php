<footer class="mt-auto py-3">
  <div class="container-fluid px-3 text-muted small">
    Dandelion — Sistema de Ventas
  </div>
</footer>

</div>
</div>

<!-- SIDEBAR MOBILE (Offcanvas) -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="sidebarMobile" aria-labelledby="sidebarMobileLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="sidebarMobileLabel">Dandelion</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Cerrar"></button>
  </div>
  <div class="offcanvas-body">
    <div class="list-group">
      <a class="list-group-item list-group-item-action" href="<?= base_url('/') ?>">Dashboard</a>
      <a class="list-group-item list-group-item-action active" href="<?= base_url('tables') ?>">Tablas</a>
      <a class="list-group-item list-group-item-action" href="<?= base_url('productos') ?>">Productos</a>
      <a class="list-group-item list-group-item-action" href="<?= base_url('ventas') ?>">Ventas</a>
      <a class="list-group-item list-group-item-action" href="<?= base_url('clientes') ?>">Clientes</a>
      <a class="list-group-item list-group-item-action text-danger" href="<?= base_url('logout') ?>">Salir</a>
    </div>
  </div>
</div>

<!-- Bootstrap LOCAL -->
<script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>

<!-- DataTables -->
<script src="<?= base_url('assets/js/dataTables.min.js') ?>"></script>

<!-- Chart.js -->
<script src="<?= base_url('assets/js/chart.min.js') ?>"></script>

<script>
  const modal = document.getElementById('modal-confirma');

  modal.addEventListener('show.bs.modal', function(event) {
    const trigger = event.relatedTarget;
    const href = trigger.getAttribute('data-href');

    modal.querySelector('.btn-ok').setAttribute('href', href);
  });

  function calcularSubtotal() {
    let precio = parseFloat($('#precio_compra').val()) || 0;
    let cantidad = parseInt($('#cantidad').val()) || 0;
    let subtotal = precio * cantidad;

    $('#subtotal').val(subtotal.toFixed(2));
  }
  $('#cantidad').on('input', function() {
    calcularSubtotal();
  });
  $('#precio_compra').on('input', function() {
    calcularSubtotal();
  });
</script>

</body>

</html>