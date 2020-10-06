$(document).ready(function () {

    //ver o eliminar
    // $('.sidebar-menu').tree()

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


    //TODO utilizar css de admin ltd para errores
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


    // $('#crear-vendedor').attr('disabled', true);
    // validar que contacto sea int 
    // validar que exista alguna forma de conctacto 
    // validar que exista algun nombre o apellido o fantasia


    // Para listar producto
    /****************************************************************************************************/
    // <!-- TODO si borro registros la tabala tiene menos de diez entradas, si ordeno por columna, aparecen tr faltantes pero no funcionan. app.js no funciona en td no cargados con la pagina, agregar addEvent $(document).ready(function(){
    //     addAEvent();

    //     $.get("....", function(data){

    //         $('.div').html(data.loquesea);
    //         addAEvent();
    //     });

    // }); -->






    // Para crear producto
    /****************************************************************************************************/
    /** propone el valor sugerido al 40% */
    $('#precio').on('change', function () {
        var sugerido = this.value * 1.4;
        $('#sugerido').val(sugerido.toFixed(2));
    })


    /** oculta o muestra los divs de talles */
    $('input[type=radio][name="rb_talle"]').change(function () {
        console.log("click rbd");
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

    /** 
     * TODO validar que no se envien talles iguales en varias filas
     * al apretar submit debe verificar que si el radio button esta presionado valide talle unico
    */

});

