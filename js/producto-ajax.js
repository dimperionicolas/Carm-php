$(document).ready(function () {
    //TODO limpiar todos los campos luego de succes en submit
    //


    //Editar y crear producto    
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
                if (resultado.respuesta == 'exito' && resultado.stock == 'correcto') {
                    Swal.fire(
                        'Correcto!!',
                        'Se guardó correctamente!',
                        'success'
                    );
                }
                else if (resultado.respuesta == 'exito' && resultado.stock != 'correcto') {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Advertencia!!',
                        text: 'Producto creado! Falló la carga de stock!',
                    })
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!!',
                        text: 'No se cargo el producto!',
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