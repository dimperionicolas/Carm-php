$(document).ready(function () {

    //Validacion
    function CalcularToTal() {
        total = 0;
        precio_venta = $("#precio_venta").val();
        $(".cant").each(function () {
            total = total + $(this).val() * precio_venta;
        });
        $("#total").val(total);
    }

    function ValidarStock() {
        total = 0;
        cantidad = $("#cantidad").val();
        var $j_object = $(".cant");
        $j_object.each(function (i) {
            if (this.value == '') {
                aux = 0;
            } else {
                aux = parseInt(this.value);
            }
            total = total + aux;
        });
        if (total > 0 && total <= cantidad) {
            return true;
        } else {
            return false;
        }
    }

    function ValidarPrecio() {
        precio_unitario = $("#precio_venta").val();
        sugerido = $("#sugerido ").val();
        if (precio_unitario < sugerido) {
            alert("Estas intentando hacer una venta a un precio menor al sugerido");
        }
        return true;
    }

    function ValidarVenta() {
        if (ValidarStock() && ValidarPrecio()) {
            $('#crear_venta').prop('disabled', false);
        }
    }

    $('form').change(function (e) {
        $('#crear_venta').prop('disabled', true);
        CalcularToTal();
        ValidarVenta();
    });

    //Nueva compra y creado de producto    
    $('#guardar-registro').on('submit', function (e) {
        console.log("entra");
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

                    }
                    else if (resultado.stock != 'correcto' && resultado.detalle_ventas == 'correcto') {

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
                    setTimeout(() => {
                        window.location.href = "/AdCarmina/ventas/listar-venta.php";
                    }, 1000);

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

}); 