$(document).ready(function () {
    //TODO limpiar todos los campos luego de succes en submit


    //Validacion
    function ValidarDescripcion() {
        if (($('#descripcion').val() == null) || ($('#descripcion').val() == "")) {
            console.log('descripcion false');
            return false;
        } else {
            console.log('descripcion true');
            return true;
        }
    }
    function ValidarPrecio() {
        if (($('#precio').val() == null) || ($('#precio').val() == "") || ($('#precio').val() <= 0)) {
            console.log('precio false');

            return false;
        } else {
            console.log('precio true');
            return true;
        }
    }
    function ValidarStock() {
        if ($("#cantidad").val() == 0 || $("#cantidad").val() == '') {
            return false;
        }
        if ($("input[type=radio][name=rb_talle]:checked").val() == 'calzado') {
            cant = 0;
            var $j_object = $(".cant-talle-calzado");
            $j_object.each(function (i) {
                if (this.value == '') {
                    aux = 0;
                } else {
                    aux = parseInt(this.value);
                }
                cant = cant + aux;
            });
            if ($("#cantidad").val() == cant) {
                return true;
            }
        } else if ($("input[type=radio][name=rb_talle]:checked").val() == 'ropa') {
            var cant = 0;
            var $j_object = $(".cant-talle-ropa");
            $j_object.each(function (i) {
                if (this.value == '') {
                    aux = 0;
                } else {
                    aux = parseInt(this.value);
                }
                cant = cant + aux;
            });
            if ($("#cantidad").val() == cant) {
                return true;
            }
        } else if ($("input[type=radio][name=rb_talle]:checked").val() == 'indeterminado') {
            return true;
        } else {
            return false;
        }
    }


    function ValidarCompra() {
        $('#crear_producto').prop('disabled', true);
        if (ValidarStock() && ValidarDescripcion() && ValidarPrecio()) {
            $('#crear_producto').prop('disabled', false);
        }
    }
    
    $('form').change(function (e) {
        ValidarCompra();
    });





    //Nueva compra y creado de producto    
    $('#guardar-registro').on('submit', function (e) {
        e.preventDefault();
        var datos = $(this).serializeArray();
        console.log(datos);
        $.ajax({
            type: $(this).attr('method'),
            data: datos,
            url: $(this).attr('action'),
            dataType: 'JSON',
            success: function (data) {
                var resultado = data;
                console.log('Este es el resultado ' + resultado);
                console.log(resultado)
                if (resultado.respuesta == 'exito') {
                    if (resultado.stock == 'correcto' && resultado.detalle == 'correcto') {
                        Swal.fire(
                            'Correcto!!',
                            'Se guardó correctamente!',
                            'success'
                        );
                        setTimeout(() => {
                            window.location.href = "/AdCarmina/compras/listar-compra.php";
                        }, 1000);
    
                    }
                    else if (resultado.stock != 'correcto' && resultado.detalle == 'correcto') {

                        Swal.fire({
                            icon: 'warning',
                            title: 'Advertencia!!',
                            text: 'Producto creado! Falló la carga de stock!',
                        })
                    }
                    else if (resultado.stock == 'correcto' && resultado.detalle != 'correcto') {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Advertencia!!',
                            text: 'Producto creado! Falló la carga del detalle!',
                        })
                    }
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!!',
                        text: 'Error en la operacion!',
                    })
                }
            }
        })
    });

    //Eliminar cliente    
    $('.borrar_registro').on('click', function (e) {
        console.log("click");

        var id = $(this).attr('data-id');
        var tipo = $(this).attr('data-tipo');
        console.log(tipo)
        Swal.fire({
            title: '¿Estas seguro?',
            text: "Esta operación no se puede revertir!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Borrar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'post',
                    data: {
                        'id': id,
                        'registro': 'eliminar'
                    },
                    url: 'modelo-' + tipo + '.php',

                    success: function (data) {
                        console.log(data)
                        var resultado = JSON.parse(data);
                        if (resultado.respuesta == 'exito') {
                            Swal.fire(
                                'Borrado!',
                                'El producto fue borrado!',
                                'success'
                            )
                            jQuery('[data-id="' + resultado.id_eliminado + '"]').parents('tr').remove();
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!!',
                                text: 'No se borro el producto!',
                            })
                        }
                    }
                })
            }
        })
    })
}); 