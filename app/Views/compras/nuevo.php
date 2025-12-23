<?php
$id_compra = uniqid();
?>
<!-- MAIN -->
<main class="container-fluid p-3 p-lg-4">

    <!-- Heading tipo SB Admin -->
    <div class="container-fluid p-3 p-lg-4">

        <form action="<?= site_url('compras/guarda') ?>" method="post" autocomplete="off" id="form_compra" name="form_compra">
            <div class="form-group">
                <div class="row">
                    <div class="col-12 col-sm-4">
                        <input type="hidden" id="id_producto" name="id_producto">
                        <input type="hidden" id="id_compra" name="id_compra" value="<?php echo $id_compra; ?>">
                        <label>Codigo</label>
                        <input class="form-control" id="codigo" name="codigo" type="text" placeholder="Escreibe el codigo y presiona enter" onkeyup="buscarProducto(event, this, this.value)" autofocus>
                        <label for="codigo" id="resultado_error" style="color: red"></label>
                    </div>
                    <div class="col-12 col-sm-4">
                        <label>Nombre del producto</label>
                        <input class="form-control" id="nombre" name="nombre" type="text" disabled>
                    </div>
                    <div class="col-12 col-sm-4">
                        <label>Cantidad</label>
                        <input class="form-control" id="cantidad" name="cantidad" type="text" placeholder="Escreibe la cantidad y presiona enter">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-12 col-sm-4">
                        <label>Precion de compra</label>
                        <input class="form-control" id="precio_compra" name="precio_compra" type="text" placeholder="Escreibe el precio de compra y presiona enter" disabled>
                    </div>
                    <div class="col-12 col-sm-4">
                        <label>Subtotal</label>
                        <input class="form-control" id="subtotal" name="subtotal" type="text" disabled>
                    </div>
                    <div class="col-12 col-sm-4">
                        <label><br>&nbsp;</label>
                        <button class="btn btn-primary" id="agregar_producto" name="agregar_producto" type="button" onclick="agregarProducto(id_producto.value, cantidad.value, '<?php echo $id_compra; ?>')">Agregar producto</button>
                    </div>
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
                <div class="row">
                    <div class="col-12 col-sm-6 offset-md-6">
                        <label style="font-weight: bold; font-size: 30; text-align: center;">Total $</label>
                        <input type="text" id="total" name="total" class="form-control" style="font-weight: bold; font-size: 30; text-align: center;" value="0.00">
                        <button type="button" id="completa_compra" class="btn btn-success">Completar compra</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

</main>
<script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>

<script>
    $(document).ready(function() {
        $("#completa_compra").click(function() {
            let nFila = $("#tablaProductos tr").length;
            if (nFila < 2) {

            } else {
                $("#form_compra").submit();
            }
        });
    });

    function buscarProducto(e, tagCodigo, codigo) {
        var enterKey = 13;
        if (codigo != '') {
            if (e.which == enterKey) {
                $.ajax({
                    url: '<?= base_url('/productos/buscarPorCodigo'); ?>' + codigo,
                    dataType: 'json',
                    success: function(resultado) {
                        if (resultado == 0) {
                            $(tagCodigo).val('');
                        } else {

                            $("#resultado_error").html(resultado.error);

                            if (resultado.existe) {
                                $("#id_producto").val(resultado.datos.id);
                                $("#nombre").val(resultado.datos.nombre);
                                $("#cantidad").val(1);
                                $("#precio_compra").val(resultado.datos.precio_compra);
                                $("#subtotal").val(resultado.datos.precio_compra);
                                $("#cantidad").focus();
                            } else {
                                $("#id_producto").val('');
                                $("#nombre").val('');
                                $("#cantidad").val('');
                                $("#precio_compra").val('');
                                $("#subtotal").val('');
                            }
                        }
                    }
                });
            }
        }
    }

    function agregarProducto(id_producto, cantidad, id_compra) {
        if (id_producto != null && id_producto != 0 && cantidad > 0) {
            $.ajax({
                url: <?= json_encode(base_url('TemporalCompra/inserta')) ?> + '/' + id_producto + '/' + cantidad + '/' + id_compra,

                success: function(resultado) {
                    if (resultado == 0) {

                    } else {
                        var resultado = JSON.parse(resultado);
                        if (resultado.error == '') {
                            $("#tablaProductos tbody").empty();
                            $("#tablaProductos tbody").append(resultado.datos);
                            $("#total").val(resultado.total);
                            $("#id_producto").val('');
                            $("#codigo").val('');
                            $("#nombre").val('');
                            $("#cantidad").val('');
                            $("#precio_compra").val('');
                            $("#subtotal").val('');

                        }
                    }
                }
            });

        }
    }

    function eliminaProducto(id_producto, id_compra) {
        $.ajax({
            url: '<?= base_url('TemporalCompra/eliminar/') ?>' + id_producto + '/' + id_compra,
            success: function(resultado) {
                if (resultado == 0) {
                    $(tagCodigo).val('');
                } else {
                    var resultado = JSON.parse(resultado);
                    $("#tablaProductos tbody").empty();
                    $("#tablaProductos tbody").append(resultado.datos);
                    $("#total").val(resultado.total);
                }
            }
        });
    }
</script>