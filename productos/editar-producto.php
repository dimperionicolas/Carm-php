<?php define('__ROOT__', dirname(dirname(__FILE__))) ?>
<?php include_once __ROOT__ . '/includes/funciones/sesiones.php'; ?>
<?php include_once __ROOT__ . '/includes/funciones/funciones.php'; ?>
<?php include_once __ROOT__ . '/includes/templates/header.php'; ?>
<?php include_once __ROOT__ . '/includes/templates/aside.php'; ?>
<?php include_once __ROOT__ . '/includes/templates/topbar.php'; ?>


<?php
//Valida que el get sea un entero 
$id = $_GET['id'];
if (!filter_var($id, FILTER_VALIDATE_INT)) {
    //TODO redirigir si no ingresa un entero, 
    //supuestamente el die deberia cancelar todo y anular la pagin
    die("Error!!");
};
try {
    $sql = "SELECT p.descripcion,p.comentario,p.imagen,p.sugerido,v.nombre_fantasia,v.nombre,v.apellido FROM productos as p, vendedores as v WHERE p.id_vendedor = v.id_vendedor AND p.id_producto = $id";
    
    $resultado = $conn->query($sql);
} catch (Exception $th) {
    echo 'Error: ' . $th->getMessage();
}
$producto = $resultado->fetch_assoc();
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">

            <div class="card-header">
                <h2 class="card-title">
                    En construccion
                    <!-- <?php echo $producto['descripcion'];  ?> -->
                     <small></small></h2>
            </div>

            <div class="row">
                <div class="col-md-8">
                   
                    <form role="form" name="guardar-registro" id="guardar-registro" method="POST" action="modelo-producto.php">

                        <div class="card-body">
                            <div class="row">
                                <!-- Columna izquierda -->
                                <div class="col-md-6">


                                    <!-- Descripción -->
                                    <div class="form-group">
                                        <label for="descripcion">Descripción: </label>
                                        <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Ingresar un descripcion">
                                    </div>

                                    <!-- Comentarios -->
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <!-- textarea -->
                                            <div class="form-group">
                                                <label for="comentario">Comentarios: </label>
                                                <textarea class="form-control" rows="3" name="comentario" placeholder="Añada un comentario..."></textarea>
                                            </div>
                                        </div>
                                    </div>


                                    <!-- select vendedor -->
                                    <div class="form-group ">
                                        <label for="vendedor">Seleccione un vendedor:</label>
                                        <select class="form-control" name="vendedor">
                                            <?php
                                            try {
                                                $sql = 'SELECT * FROM vendedores';
                                                $resultado = $conn->query($sql);
                                            } catch (Exception $th) {
                                                echo 'Error: ' . $th->getMessage();
                                            }
                                            while ($vendedor = $resultado->fetch_assoc()) {
                                                echo '<option value=' . $vendedor['id_vendedor'] . '>' . $vendedor['nombre_fantasia'] . ' ' . $vendedor['nombre'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                        <a href="<?php echo $base_path ?>/vendedores/crear-vendedor.php" class="nav-link">Nuevo vendedor</a>
                                    </div>

                                    <!-- select Precio y sugerido-->
                                    <div class="form-row">
                                        <div class="form-group col-sm-6">
                                            <label for="precio">Precio: </label>
                                            <input type="number" class="form-control" id="precio" step="0.02" name="precio" placeholder="Costo de compra">
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="sugerido">Sugerido <small>(40%)</small>: </label>
                                            <input type="number" step="0.02" class="form-control" id="sugerido" name="sugerido" placeholder="Precio sugerido">
                                        </div>
                                    </div>

                                </div>

                                <!-- Columna derecha -->
                                <div class="col-md-6">


                                    <!-- Cantidad stock -->
                                    <div class="form-group">
                                        <label for="cantidad">Cantidad: </label>
                                        <input type="number" class="form-control" id="cantidad" name="cantidad" placeholder="Ingresar un cantidad">
                                    </div>

                                    <!-- Radio buttons tipo talles-->
                                    <!-- TODO css padding left para div y sacar $nbsp; -->
                                    <div class="form-group">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            &nbsp;
                                            &nbsp;
                                            &nbsp;
                                            <input type="radio" id="calzado" name="rb_talle" value="calzado" class="custom-control-input">
                                            <label class="custom-control-label" for="calzado">Calzado</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="ropa" name="rb_talle" value="ropa" class="custom-control-input">
                                            <label class="custom-control-label" for="ropa">Ropa</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="indeterminado" name="rb_talle" value="indeterminado" class="custom-control-input" checked>
                                            <label class="custom-control-label" for="indeterminado">No detallar</label>
                                        </div>
                                    </div>

                                    <!-- div de talles calzado -->
                                    <div class="form-group text-center" id="talles-calzado" style="display: none;">
                                        <label>Talles<small class="text-bold">&nbsp;(Ingresar talle y cantidad)</small>: </label>
                                        <table id="t-calzado" class="table table-bordered table-sm table-striped table-hover table-responsive-sm col-sm-12">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Talle</th>
                                                    <th scope="col">Cantidad</th>
                                                    <th scope="col"><i class="fas fa-plus-circle agregar-fila" style="cursor: pointer;"></i></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <input type="number" name="st_calz[talle][]" placeholder="37" class="talle-calzado col-sm-4">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="st_calz[cant][]" placeholder="1" min="0" class="cant-talle-calzado col-sm-4">
                                                    </td>
                                                    <td><i class="fas fa-minus-circle remover-fila" style="cursor: pointer;"></i></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <!-- div de talles ropa -->
                                    <div class="form-group" id="talles-ropa" style="display: none;">
                                        <div class="form-group text-center">
                                            <label>Talles<small class="text-bold">&nbsp;(Ingresar talle y cantidad)</small>: </label>
                                            <table id="t-ropa" class="table table-bordered table-striped table-sm table-hover table-responsive-sm ">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Talle</th>
                                                        <th scope="col">Cantidad</th>
                                                        <th scope="col">Talle</th>
                                                        <th scope="col">Cantidad</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td scope="row">XS</td>
                                                        <td>
                                                            <input type="number" name="st_ropa[xs][]" placeholder="1" min="0" class="cant-talle-ropa col-sm-5">
                                                        </td>
                                                        <td scope="row">L</td>
                                                        <td>
                                                            <input type="number" name="st_ropa[l][]" placeholder="1" min="0" class="cant-talle-ropa col-sm-5">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td scope="row">S</td>
                                                        <td>
                                                            <input type="number" name="st_ropa[s][]" placeholder="1" min="0" class="cant-talle-ropa col-sm-5">
                                                        </td>
                                                        <td scope="row">XL</td>
                                                        <td>
                                                            <input type="number" name="st_ropa[xl][]" placeholder="1" min="0" class="cant-talle-ropa col-sm-5">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td scope="row">M</td>
                                                        <td>
                                                            <input type="number" name="st_ropa[m][]" placeholder="1" min="0" class="cant-talle-ropa col-sm-5">
                                                        </td>
                                                        <td scope="row">XXL</td>
                                                        <td>
                                                            <input type="number" name="st_ropa[xxl][]" placeholder="1" min="0" class="cant-talle-ropa col-sm-5">
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <!-- Submit -->
                            <div class="card-footer text-right">
                                <input type="hidden" name="registro" value="nuevo">
                                <!--TODO id="crear_cliente" para agregar validaciones en app.js-->
                                <button type="submit" class="btn btn-primary col-sm-12" id="crear_producto">Agregar</button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>

        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->

</div>
<!-- /.content-wrapper -->

<?php include_once __ROOT__ . '/includes/templates/footer.php'; ?>