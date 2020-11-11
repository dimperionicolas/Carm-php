$(document).ready(function () {

    //configuracion datatable
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

    // TODO bloquea el boton si no valida, ver
    $('#crear_registro').attr('disabled', true);

    // validacion para que coincidan los passwords
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

    // Para productos
    /****************************************************************************************************/
    /** propone el valor sugerido al 40% */
    $('#precio').on('change', function () {
        var sugerido = this.value * 1.4;
        $('#sugerido').val(sugerido.toFixed(2));
    })


    /** oculta o muestra los divs de talles */
    $('input[type=radio][name="rb_talle"]').change(function () {
        $('div#talles-calzado').hide();
        $('div#talles-ropa').hide();
        if (this.value == 'calzado') {
            $('div#talles-calzado').show();
        } else if (this.value == 'ropa') {
            $('div#talles-ropa').show();
        }
    });

    /** agregar tr de talle-calzado al presionar icono*/
    $(".agregar-fila").click(function () {
        console.log('click');
        var tr = "<tr><td><input type='number' name='st_calz[talle][]' placeholder='37'  class='talle-calzado col-sm-4'></td><td><input type='number' name='st_calz[cant][]' placeholder='1' min='0' class='cant-talle-calzado col-sm-4'></td><td><i class='fas fa-minus-circle remover-fila' style='cursor: pointer;'></i></td></tr>";
        $("#t-calzado").append(tr);
    });

    /** remueve fila si no es la ultima */
    $(document).on('click', '.remover-fila', function (event) {
        if ($(this).closest('tr').index() == 0 && $(this).closest('tr').next().index() == -1) {
            alert("Defina los talles o selecciones no detallar");
        } else {
            $(this).closest('tr').remove();
        }
    });


});

