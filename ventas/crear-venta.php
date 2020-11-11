<?php define('__ROOT__', dirname(dirname(__FILE__))) ?>
<?php include_once __ROOT__ . '/includes/funciones/funciones.php'; ?>
<?php include_once __ROOT__ . '/includes/funciones/sesiones.php'; ?>
<?php include_once __ROOT__ . '/includes/templates/header.php'; ?>
<?php include_once __ROOT__ . '/includes/templates/aside.php'; ?>
<?php include_once __ROOT__ . '/includes/templates/topbar.php'; ?>

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
        <h2 class="card-title">Nueva venta <small></small></h2>
      </div>

      <div class="row">
        <div class="col-md-8">

          <form role="form" name="guardar-registro" id="guardar-registro" method="POST" action="modelo-venta.php">

            <div class="card-body">
              <div class="row">
                <!-- Columna izquierda -->
                <div class="col-md-6">
                  <!-- Producto -->
                  <div class="form-group">
                    <label for="descripcion">Producto: </label>
                    <?php
                    $id = $_GET['id'];
                    if (!filter_var($id, FILTER_VALIDATE_INT)) {
                      echo '<input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Seleccione un producto" disabled>';
                    } else {
                      try {
                        $sql = "SELECT p.id_producto, p.descripcion, p.comentario, p.sugerido, SUM(s.cant) as 'cantidad', p.imagen FROM productos AS p,stock as s WHERE p.id_producto = s.id_producto AND p.id_producto = $id GROUP BY p.id_producto";
                        $resultado = $conn->query($sql);
                      } catch (Exception $th) {
                        echo 'Error: ' . $th->getMessage();
                      }
                      if ($resultado) {
                        $producto = $resultado->fetch_assoc();
                        echo '<input type="text" class="form-control" id="descripcion" name="descripcion" disabled value="' . $producto['descripcion'] . '">';
                      }
                    };
                    ?>
                    <a href="<?php echo $base_path ?>/productos/listar-producto.php" class="nav-link"> Cambiar producto </a>
                  </div>
                  <!-- Comentarios -->
                  <div class="row">
                    <div class="col-sm-12">
                      <!-- textarea -->
                      <div class="form-group">
                        <label>Observación del producto: </label>
                        <input type="text" class="form-control" value="<?php echo $producto['comentario']; ?>" disabled>
                      </div>
                    </div>
                  </div>
                  <!-- select cliente -->
                  <div class="form-group ">
                    <label for="cliente">Seleccione un cliente:</label>
                    <select class="form-control" name="cliente">
                      <?php
                      try {
                        $sql = 'SELECT * FROM clientes';
                        $resultado = $conn->query($sql);
                      } catch (Exception $th) {
                        echo 'Error: ' . $th->getMessage();
                      }
                      while ($cliente = $resultado->fetch_assoc()) {
                        echo '<option value=' . $cliente['id_cliente'] . '>' . $cliente['nombre'] . ' ' . $cliente['apellido'] . '</option>';
                      }
                      ?>
                    </select>
                    <a href="<?php echo $base_path ?>/clientes/crear-cliente.php" class="nav-link">Nuevo cliente</a>
                  </div>
                  <!-- select Precio y sugerido-->
                  <div class="form-row">
                    <div class="form-group col-sm-6">
                      <label for="sugerido">Sugerido <small>x Unidad</small>: </label>
                      <input type="number" step="0.02" class="form-control" id="sugerido" name="sugerido" disabled value="<?php echo $producto['sugerido'] ?>">
                    </div>
                    <div class="form-group col-sm-6">
                      <label for="precio">Precio final <small>x Unidad</small>: </label>
                      <input type="number" class="form-control" id="precio_venta" step="1" name="precio" value="<?php echo $producto['sugerido'] ?>">
                    </div>
                  </div>
                </div>

                <!-- Columna derecha -->
                <div class="col-md-6">


                  <!-- Cantidad stock -->
                  <div class="form-group">
                    <label for="cantidad">En stock: </label>
                    <input type="number" class="form-control" id="cantidad" disabled value="<?php echo $producto['cantidad'] ?>">

                  </div>


                  <?php
                  $talles = array('xs', 's', 'm', 'l', 'xl', 'xxl');
                  try {
                    $sql = "SELECT talle, cant FROM stock WHERE id_producto = $id";
                    $resultado = $conn->query($sql);
                  } catch (Exception $th) {
                    echo 'Error: ' . $th->getMessage();
                  }
                  if ($resultado) {
                    $stock = $resultado->fetch_assoc();

                    /**Si se trata de un entero seran  talles para calzado */
                    if (filter_var($stock['talle'], FILTER_VALIDATE_INT)) {
                      echo "
                        <div class=\"form-group text-center\" id=\"talles-calzado\">
                        <table id=\"t-calzado\" class=\"tabla-venta table table-bordered table-sm table-striped table-hover table-responsive-sm col-sm-12\">
                          <thead>
                            <tr>
                              <th scope=\"col\">Talle</th>
                              <th scope=\"col\">Cantidad</th>
                              <th scope=\"col\">#</th>
                            </tr>
                          </thead>
                          <tbody>";
                      do {
                        echo "<tr>
                              <td>" . $stock['talle'] . "</td>
                              <td>" . $stock['cant'] . "</td>
                              <td class=\"w-25\"><input type=\"number\" name=\"cantidad[" . $stock['talle'] . "][]\" value=\"0\" class=\"w-75 cant\"></td>
                            </tr>";
                      } while ($stock = $resultado->fetch_assoc());
                      echo "</tbody>
                        </table>
                      </div>";

                      /**Si coincide con 'ind' seran talles unicos o no detallados */
                    } elseif ($stock['talle'] == 'ind') {
                      echo "<label>No hay detalle: </label>";
                      echo "<label for=\"cantidad\">Cantidad: </label>";
                      echo "<input type=\"number\" name=\"cantidad\" value=\"0\" class=\"cant tabla-venta form-control col-sm-3\">";

                      /**Si se encuetran los talles dentro del array se trata de ropa*/
                    } elseif (in_array($stock['talle'], $talles)) {
                      echo "
                      <div class=\"form-group\" id=\"talles-ropa\" >
                          <div class=\"form-group text-center\">
                            <table id=\"t-ropa\" class=\"tabla-venta table table-bordered table-striped table-sm table-hover table-responsive-sm \">
                              <thead>
                                <tr>
                                  <th scope=\"col\">Talle</th>
                                  <th scope=\"col\">Cantidad</th>                              
                                  <th scope=\"col\">#</th>
                                </tr>
                              </thead>
                              <tbody>";
                      do {
                        echo "<tr>
                                      <td >" . $stock['talle'] . "</td>
                                      <td >" . $stock['cant'] . "</td>
                                      <td class=\"w-25\"><input type=\"number\" name=\"cantidad[" . $stock['talle'] . "][]\" value=\"0\" class=\"cant w-75\"></td>
                                    </tr>";
                      } while ($stock = $resultado->fetch_assoc());
                      echo "
                              </tbody>
                            </table>
                          </div>
                        </div>
                      ";
                    } else {
                      echo "Sucedio algun error con los talles";
                    }
                  } else {
                    echo "No se realizó la consulta";
                  };
                  ?>
                </div>
              </div>
              <div class="form-group">
                <label for="Total">Total: </label>
                <input type="number" class="form-control" disabled id="total">
              </div>
              <!-- Submit -->
              <div class="card-footer text-right">
                <input type="hidden" name="registro" value="nuevo">
                <input type="hidden" name="id_producto" value="<?php echo $_GET['id'] ?>">
                <!--TODO id="crear_cliente" para agregar validaciones en app.js-->
                <button type="submit" class="btn btn-primary col-sm-12" disabled id="crear_venta">Aceptar</button>
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