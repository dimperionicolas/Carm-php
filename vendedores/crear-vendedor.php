<?php define('__ROOT__',dirname(dirname(__FILE__))) ?>
<?php include_once __ROOT__.'/includes/funciones/sesiones.php'; ?>
<?php include_once __ROOT__.'/includes/templates/header.php'; ?>
<?php include_once __ROOT__.'/includes/templates/aside.php'; ?>
<?php include_once __ROOT__.'/includes/templates/topbar.php'; ?>

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
        <h2 class="card-title">Agregar vendedor <small></small></h2>
      </div>

      <div class="row">
        <div class="col-md-8">

          <form role="form" name="guardar-registro" id="guardar-registro" method="POST" action="modelo-vendedor.php">

            <div class="card-body">
              <div class="form-group">
                <label for="fantasia">Nombre de fantasía: </label>
                <input type="text" class="form-control" id="fantasia" name="fantasia" placeholder="Nombre de fantasía">
              </div>

              <div class="form-group">
                <label for="nombre">Nombre: </label>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingresar un nombre">
              </div>

              <div class="form-group ">
                <label for="apellido">Apellido: </label>
                <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Ingresar un apellido">
              </div>

              <div class="form-group ">
                <label for="direccion">Direccion: </label>
                <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Ingresar dirección">
              </div>

              <div class="form-group ">
                <label for="contacto">Contacto: </label>
                <input type="text" class="form-control" id="contacto" name="contacto" placeholder="Ingresar telefono">
              </div>

              <div class="form-group ">
                <label for="red_social">Social: </label>
                <input type="text" class="form-control" id="red_social" name="red_social" placeholder="Ingresar Instagram, Facebook o Web">
              </div>

            </div>
            <!-- /.card-body -->

        </div>
      </div>

      <div class="card-footer">
        <input type="hidden" name="registro" value="nuevo">
        <button type="submit" class="btn btn-primary" id="crear_vendedor">Agregar</button>
      </div>
      </form>


    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include_once __ROOT__.'/includes/templates/footer.php'; ?>