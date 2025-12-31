<div class="container-fluid">
    <?php $idVentaTmp = uniqid(); ?>

    <div class="d-flex flex-wrap align-items-center gap-2 mb-3">
        <div>
            <h1 class="h4 section-title mb-0">Caja</h1>
            <div class="text-muted small">Registra una nueva venta y controla el total.</div>
        </div>
        <div class="ms-auto page-actions">
            <button type="button" id="completa_venta" class="btn btn-success">Completar venta</button>
        </div>
    </div>

    <form id="form_venta" name="form_venta" method="post" action="<?= base_url('/ventas/guarda') ?>" autocomplete="off">
        <input type="hidden" id="id_venta" name="id_venta" value="<?php echo $idVentaTmp; ?>">
        <input type="hidden" id="id_producto" name="id_producto">

        <div class="row g-3 mb-3">
            <div class="col-12 col-lg-7">
                <div class="card h-100">
                    <div class="card-header">Cliente y pago</div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-12 col-md-6">
                                <div class="ui-widget">
                                    <label class="form-label" for="cliente">Cliente</label>
                                    <input type="hidden" id="id_cliente" name="id_cliente" value="1">
                                    <input type="text" class="form-control" id="cliente" name="cliente"
                                        placeholder="Escriba el nombre del cliente" value="publico en general"
                                        autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label" for="forma_pago">Forma de pago</label>
                                <select name="forma_pago" id="forma_pago" class="form-select">
                                    <option value="001">Efectivo</option>
                                    <option value="002">Tarjeta de credito/debito</option>
                                    <option value="003">Transferencia</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-8">
                                <label class="form-label" for="codigo">Codigo de barras</label>
                                <input class="form-control" id="codigo" name="codigo" type="text"
                                    placeholder="Escriba el codigo y presiona enter" autofocus>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="form-label" for="resultado_error">Estado</label>
                                <div id="resultado_error" class="small text-danger"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-5">
                <div class="card h-100">
                    <div class="card-header">Total venta</div>
                    <div class="card-body d-flex flex-column justify-content-center">
                        <label class="form-label text-center" for="total">Total $</label>
                        <input type="text" id="total" name="total" class="form-control text-center fs-3 fw-bold" value="0.00">
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">Productos en la venta</div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table id="tablaProductos" class="table table-hover table-striped align-middle mb-0 tablaProductos datatable">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Codigo</th>
                                <th>Nombre</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Total</th>
                                <th class="text-end"></th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    const ventaFolio = "<?php echo $idVentaTmp; ?>";

    function agregarProductoPorId(id_producto, cantidad, folio) {
        if (!id_producto || cantidad <= 0) {
            return;
        }

        $.ajax({
            url: <?= json_encode(base_url('TemporalCompra/inserta')) ?> + '/' + id_producto + '/' + cantidad + '/' + folio + '?tipo=venta',
            success: function(resultado) {
                if (!resultado) {
                    return;
                }

                let data = resultado;
                if (typeof resultado === 'string') {
                    try {
                        data = JSON.parse(resultado);
                    } catch (err) {
                        data = null;
                    }
                }

                if (!data) {
                    return;
                }

                if (data.error) {
                    $('#resultado_error').text(data.error);
                    return;
                }

                $('#resultado_error').text('');
                if (window.refreshDataTableRows) {
                    window.refreshDataTableRows('#tablaProductos', data.datos);
                } else {
                    $('#tablaProductos tbody').empty().append(data.datos);
                }
                $('#total').val(data.total);
                $('#codigo').val('').focus();
            }
        });
    }

    function buscarProductoPorCodigo(e) {
        const enterKey = 13;
        if (e.which !== enterKey) {
            return;
        }

        const codigo = $('#codigo').val().trim();
        if (!codigo) {
            return;
        }

        $.ajax({
            url: "<?= base_url('/productos/buscarPorCodigo') ?>" + codigo,
            dataType: 'json',
            success: function(resultado) {
                if (!resultado || !resultado.existe) {
                    const mensaje = resultado && resultado.error ? resultado.error : 'No existe el producto';
                    $('#resultado_error').text(mensaje);
                    return;
                }

                $('#resultado_error').text('');
                agregarProductoPorId(resultado.datos.id, 1, ventaFolio);
            }
        });
    }

    function eliminaProducto(id_producto, folio) {
        $.ajax({
            url: "<?= base_url('TemporalCompra/eliminar') ?>/" + id_producto + "/" + folio,
            success: function(resultado) {
                if (!resultado) {
                    return;
                }

                let data = resultado;
                if (typeof resultado === 'string') {
                    try {
                        data = JSON.parse(resultado);
                    } catch (err) {
                        data = null;
                    }
                }

                if (!data) {
                    return;
                }

                if (window.refreshDataTableRows) {
                    window.refreshDataTableRows('#tablaProductos', data.datos);
                } else {
                    $('#tablaProductos tbody').empty().append(data.datos);
                }
                $('#total').val(data.total);
            }
        });
    }

    $(function() {
        $('#cliente').autocomplete({
            source: "<?php echo base_url(); ?>/clientes/autocompleteData",
            minLength: 3,
            select: function(event, ui) {
                event.preventDefault();
                $('#id_cliente').val(ui.item.id);
            }
        });

        $('#codigo').on('keyup', buscarProductoPorCodigo);
        $('#codigo').autocomplete({
            source: "<?= base_url('productos/autocompleteData') ?>",
            minLength: 3,
            select: function(event, ui) {
                event.preventDefault();
                $('#codigo').val(ui.item.value);
                agregarProductoPorId(ui.item.id, 1, ventaFolio);
            }
        });
    });
    $(function() {
        $('#completa_venta').click(function() {
            const $tabla = $('#tablaProductos');
            let totalFilas = $tabla.find('tbody tr').length;

            if (window.jQuery && $.fn.DataTable && $.fn.dataTable.isDataTable($tabla[0])) {
                totalFilas = $tabla.DataTable().rows().count();
            }

            if (totalFilas === 0) {
                alert('Agrega al menos un producto a la venta');
                $('#codigo').focus();
                return false;
            }

            $('#form_venta').submit();
        });
    });
</script>
