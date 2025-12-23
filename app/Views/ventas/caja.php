<main class="container-fluid p-3 p-lg-4">

    <!-- Heading tipo SB Admin -->
    <div class="d-flex flex-wrap align-items-center gap-2 mb-3">
        <?php $idVentaTmp = uniqid(); ?>
        <br>
        <form id="form_venta" name="form_venta" class="form-horizontal" method="post" action="<?php base_url('/ventas/guarda'); ?>" autocomplete="off">
            <input type="hidden" id="id_venta" name="id_venta" value="<?php echo $idVentaTmp; ?>">
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="ui-widget">
                            <label for="">Cliente</label>
                            <input type="hidden" id="id_cliente" name="id_cliente" value="1">
                            <input type="text" class="form-control" id="cliente" name="cliente" placeholder="Escriba el nombre del cliente" value="publico en general" onkeyup="" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="">Forma de pago:</label>
                        <select name="forma_pago" id="forma_pago" class="form-control">
                            <option value="001">Efectivo</option>
                            <option value="002">Tarjeta de credito/débito</option>
                            <option value="003">Transferencia</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-12 col-sm-4">
                        <input type="hidden" id="id_producto" name="id_producto">
                        <label>Codigo de barras:</label>
                        <input class="form-control" id="codigo" name="codigo" type="text" placeholder="Escreibe el codigo y presiona enter" onkeyup="buscarProducto(event, this, this.value)" autofocus>
                    </div>
                    <div class="col-sm-2">
                        <label for="codigo" id="resultado_error" style="color: red"></label>
                    </div>
                    <div class="col-12 col-sm-4">
                        <label style="font-weight: bold; font-size: 30; text-align: center;">Total $</label>
                        <input type="text" id="total" name="total" class="form-control" style="font-weight: bold; font-size: 30; text-align: center;" value="0.00">

                    </div>
                </div>
            </div>
            <div class="form-group">
                <button type="button" id="completa_venta" class="btn btn-success">Completar venta</button>
            </div>
            <div class="row">
                <table id="tablaProductos" class="table table-hover table-striped table-sm table-responsive tablaProductos">
                    <thead class="thead-dark">
                        <th>#</th>
                        <th>Codigo</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>total</th>
                        <th width="1%"></th>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </form>
    </div>
</main>
<!-- termina el contenedor principal -->
<script>
    $(function() {
        $("#cliente").autocomplete({
            source: "<?php echo base_url(); ?>/clientes/autocompleteData",
            minLength: 3,
            select: function(event, ui) {
                event.preventDefault();
                $('#id_cliente').val(ui.item.id);
            }
        });
    });

</script>
