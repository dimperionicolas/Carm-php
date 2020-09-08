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
        <h2 class="card-title">Editar cliente <small></small></h2>
      </div>

      <div class="row">
        <div class="col-md-8">

          <form role="form" name="guardar-registro" id="guardar-registro" method="POST" action="modelo-cliente.php">
            <?php
            $sql = "SELECT * FROM clientes WHERE id_cliente = $id";
            $resultado = $conn->query($sql);
            $admin = $resultado->fetch_assoc();
            ?>
            <div class="card-body">
              <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingresar nombre" value="<?php echo $admin['nombre'] ?>">
              </div>

              <div class="form-group">
                <label for="apellido">Apellido: </label>
                <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Ingresar un apellido" value="<?php echo $admin['apellido'] ?>">
              </div>

              <div class="form-group">
                <label for="direccion">Direccion: </label>
                <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Ingresar un direccion" value="<?php echo $admin['direccion'] ?>">
              </div>

              <div class="form-group">
                <label for="contacto">Contacto: </label>
                <input type="text" class="form-control" id="contacto" name="contacto" placeholder="Ingresar un contacto" value="<?php echo $admin['contacto'] ?>">
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