$(document).ready(function () {
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
                console.log(resultado);
                // if (resultado.respuesta == 'exito') {
                //     Swal.fire(
                //         'Correcto!!',
                //         'Se guardó correctamente!',
                //         'success'
                //     );
                //     window.location.href = '../index.php';
                // }
                // else {
                //     Swal.fire({
                //         icon: 'error',
                //         title: 'Error!!',
                //         text: 'No se cargó el producto!',
                //     })
                // }
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
                        }
                    }
                })
            }
        })
    })
}); 