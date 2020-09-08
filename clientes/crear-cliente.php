<?php define('__ROOT__', dirname(dirname(__FILE__))) ?>
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
        <h2 class="card-title">Crear cliente <small></small></h2>
      </div>

      <div class="row">
        <div class="col-md-8">

          <form role="form" name="guardar-registro" id="guardar-registro" method="POST" action="modelo-cliente.php">

            <div class="card-body">

              <div class="form-group">
                <label for="nombre">Nombre: </label>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingresar un nombre">
              </div>

              <div class="form-group ">
                <label for="apellido">Apellido</label>
                <input type="apellido" class="form-control" id="apellido" name="apellido" placeholder="Ingresar un apellido">
              </div>

              <div class="form-group ">
                <label for="direccion">Direccion: </label>
                <input type="direccion" class="form-control" id="direccion" name="direccion" placeholder="Ingresar una dirección">
              </div>

              <div class="form-group ">
                <label for="contacto">Contacto: </label>
                <input type="contacto" class="form-control" id="contacto" name="contacto" placeholder="Ingresar un contacto">
              </div>


            </div>
            <!-- /.card-body -->

        </div>
      </div>

      <div class="card-footer">
        <input type="hidden" name="registro" value="nuevo">
        <!-- id="crear_cliente" para agregar validaciones en app.js-->
        <button type="submit" class="btn btn-primary" id="crear_cliente">Agregar</button>
      </div>
      </form>


    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include_once __ROOT__ . '/includes/templates/footer.php'; ?>