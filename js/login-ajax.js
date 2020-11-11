$(document).ready(function () {

    $("#usuario").focus();

    $('#login-admin').on('submit', function (e) {
        e.preventDefault();

        var datos = $(this).serializeArray();
        $.ajax({
            type: $(this).attr('method'),
            data: datos,
            url: $(this).attr('action'),
            dataType: 'JSON',
            success: function (data) {
                var resultado = data;
                if (resultado.respuesta == 'exitoso') {
                    Swal.fire(
                        'Login correcto!!',
                        'Bienvenido(a) ' + resultado.usuario + '!!',
                        'success'
                    )
                    setTimeout(() => {
                        window.location.href = '../index.php';
                    }, 1000);
                }
                else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Usuario o Password incorrecto!',
                        text: 'No se cargó el administrador!',
                    })
                }

            }

        })

    });
});