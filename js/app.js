$(document).ready(function () {
    //ver o eliminar
    // $('.sidebar-menu').tree()


    $('#registros').DataTable({
        "paging": true,
        "pageLength": 10,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        "language": {
            paginate: {
                previous: "Anterior",
                next: "Siguiente"
            },
            info: "Mostrando _START_ a _END_ de _TOTAL_ resultados",
            emptyTable: "No hay registros",
            infoEmpty: "0 registros",
            search: "Buscar"
        }
    });

    $('#crear_registro').attr('disabled', true);

    $('#repetir_password').on('blur', function () {

        var password = $('#password').val();
        var password_nuevo = $('#repetir_password').val();

        if (password == password_nuevo) {
            $('#resultado_password').text('Correcto');
            $('input#password').addClass('is-valid').removeClass('is-invalid');
            $('input#repetir_password').addClass('is-valid').removeClass('is-invalid');
            $('#crear_registro').attr('disabled', false);

        } else {
            $('#resultado_password').text('Los passwords con coinciden.');
            $('input#password').addClass('is-invalid').removeClass('is-valid');
            $('input#repetir_password').addClass('is-invalid').removeClass('is-valid');

        }


    });

    // $('#crear-vendedor').attr('disabled', true);
// validar que contacto sea int 
// validar que exista alguna forma de conctacto 
// validar que exista algun nombre o apellido o fantasia




});
