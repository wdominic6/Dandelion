    </div>

    <footer class="mt-auto py-3">
      <div class="container-fluid px-3 text-muted small">
        Dandelion - Sistema de Ventas
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
      <a class="list-group-item list-group-item-action" href="<?= base_url('dashboard') ?>">Dashboard</a>
      <a class="list-group-item list-group-item-action active" href="<?= base_url('tables') ?>">Tablas</a>
      <a class="list-group-item list-group-item-action" href="<?= base_url('productos') ?>">Productos</a>
      <a class="list-group-item list-group-item-action" href="<?= base_url('ventas') ?>">Ventas</a>
      <a class="list-group-item list-group-item-action" href="<?= base_url('clientes') ?>">Clientes</a>
      <a class="list-group-item list-group-item-action text-danger" href="<?= base_url('logout') ?>">Salir</a>
    </div>
  </div>
</div>
<!-- luego ya tu script de la vista o el script del módulo ventas -->

<script src="<?= base_url('assets/js/dataTables.min.js') ?>"></script>
<script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= base_url('assets/js/chart.min.js') ?>"></script>

<script>
  function initDataTables(selector) {
    if (!window.jQuery || !$.fn.DataTable) {
      return;
    }

    const language = {
      search: 'Buscar:',
      lengthMenu: 'Mostrar _MENU_ registros',
      info: 'Mostrando _START_ a _END_ de _TOTAL_ registros',
      infoEmpty: 'Mostrando 0 a 0 de 0 registros',
      infoFiltered: '(filtrado de _MAX_ registros)',
      paginate: {
        first: 'Primero',
        last: 'Ultimo',
        next: 'Siguiente',
        previous: 'Anterior'
      },
      zeroRecords: 'No se encontraron registros',
      emptyTable: 'No hay datos disponibles'
    };

    $(selector).each(function() {
      if ($.fn.dataTable.isDataTable(this)) {
        return;
      }

      $(this).DataTable({
        language,
        pageLength: 10,
        lengthChange: false
      });
    });
  }

  function refreshDataTableRows(selector, html) {
    if (!window.jQuery || !$.fn.DataTable) {
      $(selector).find('tbody').html(html);
      return;
    }

    const $table = $(selector);
    if (!$table.length) {
      return;
    }

    if ($.fn.dataTable.isDataTable($table[0])) {
      const dt = $table.DataTable();
      dt.clear();
      const $rows = $(html).filter('tr');
      if ($rows.length) {
        dt.rows.add($rows);
      }
      dt.draw();
      return;
    }

    $table.find('tbody').html(html);
    initDataTables($table);
  }

  window.initDataTables = initDataTables;
  window.refreshDataTableRows = refreshDataTableRows;

  document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('modal-confirma');
    if (modal) {
      modal.addEventListener('show.bs.modal', function(event) {
        const trigger = event.relatedTarget;
        const href = trigger.getAttribute('data-href');

        modal.querySelector('.btn-ok').setAttribute('href', href);
      });
    }

    initDataTables('.datatable');
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
