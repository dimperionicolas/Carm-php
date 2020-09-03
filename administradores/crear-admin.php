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
        <h2 class="card-title">Crear administrador <small></small></h2>
      </div>

      <div class="row">
        <div class="col-md-8">

          <form role="form" name="guardar-registro" id="guardar-registro" method="POST" action="modelo-admin.php">

            <div class="card-body">
              <div class="form-group">
                <label for="usuario">Usuario</label>
                <input type="text" class="form-control" id="usuario" name= "usuario" placeholder="Ingresar usuario">
              </div>

              <div class="form-group">
                <label for="nombre">Nombre: </label>
                <input type="text" class="form-control" id="nombre" name= "nombre" placeholder="Ingresar un nombre">
              </div>

              <div class="form-group ">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name= "password" placeholder="Ingresar una contraseña">
              </div>

              <div class="form-group ">
                <label for="password">Repetir Password</label>
                <input type="password" class="form-control" id="repetir_password" name= "repetir_password" placeholder="Repetir contraseña">
                <span id="resultado_password" class="help-block"></span>
              </div>
            </div>
            <!-- /.card-body -->

        </div>
      </div>

      <div class="card-footer">
        <input type="hidden" name="registro" value="nuevo">
        <button type="submit" class="btn btn-primary" id="crear_registro">Agregar</button>
      </div>
      </form>


    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include_once __ROOT__.'/includes/templates/footer.php'; ?>