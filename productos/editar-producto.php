<?php define('__ROOT__',dirname(dirname(__FILE__))) ?>
<?php include_once __ROOT__.'/includes/funciones/sesiones.php'; ?>
<?php include_once __ROOT__.'/includes/funciones/funciones.php'; ?>
<?php include_once __ROOT__.'/includes/templates/header.php'; ?>
<?php include_once __ROOT__.'/includes/templates/aside.php'; ?>
<?php include_once __ROOT__.'/includes/templates/topbar.php'; ?>


<?php
//Valida que el get sea un entero 
$id = $_GET['id'];
if (!filter_var($id, FILTER_VALIDATE_INT)) {
  //TODO redirigir si no ingresa un entero, 
  //supuestamente el die deberia cancelar todo y anular la pagin
  die("Error!!");
};
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
        <h2 class="card-title">Editar producto <small></small></h2>
      </div>

      <div class="row">
        <div class="col-md-8">

          <form role="form" name="guardar-registro" id="guardar-registro" method="POST" action="modelo-producto.php">
            <?php
            $sql = "SELECT * FROM productos WHERE id_producto = $id";
            $resultado = $conn->query($sql);
            $producto = $resultado->fetch_assoc();
            ?>
            <div class="card-body">
            <div class="form-group">
                <label for="descripcion">Descripción: </label>
                <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Ingresar descripcion" value="<?php echo $producto['descripcion'] ?>" >
              </div>
              
              <div class="row">
                <div class="col-sm-6">
                  <!-- textarea -->
                  <div class="form-group">
                    <label for="comentario">Comentarios: </label>
                    <textarea class="form-control" rows="3" name="comentario" placeholder="Añada un comentario..." ><?php echo $producto['comentario'] ?></textarea>
                  </div>
                </div>
              </div>

              <div class="col-sm-6">
                <div class="form-group">
                  <label>Seleccione un vendedor</label>
                  <select class="form-control" name="vendedor">
                    <?php
                    try {
                      $sql = 'SELECT * FROM vendedores';
                      $resultado = $conn->query($sql);
                    } catch (\Throwable $th) {
                      echo 'Error: ' . $th->getMessage();
                    }
                    while ($vendedor = $resultado->fetch_assoc()) {
                      if ($vendedor['id_vendedor']==$producto['id_vendedor']) {
                        echo '<option value='.$vendedor['id_vendedor'].' selected >' . $vendedor['nombre_fantasia'] . ' ' . $vendedor['nombre'] . '</option>';
                      }
                      echo '<option value='.$vendedor['id_vendedor'].'> ' . $vendedor['nombre_fantasia'] . ' ' . $vendedor['nombre'] . '</option>';
                    }
                    ?>
                  </select>
                  <a href="<?php echo $base_path ?>/vendedores/crear-vendedor.php" class="nav-link">Nuevo vendedor</a>
                </div>
                <!-- select -->
              </div>


            </div>
            <!-- /.card-body -->

        </div>
      </div>
      <div class="card-footer">
        <input type="hidden" name="registro" value="actualizar">
        <input type="hidden" name="id_registro" value="<?php echo $id; ?>">
        <button type="submit" class="btn btn-primary">Actualizar</button>
      </div>
      </form>


    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include_once __ROOT__.'/includes/templates/footer.php'; ?>