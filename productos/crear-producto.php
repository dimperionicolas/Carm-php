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
        <h2 class="card-title">Crear producto <small></small></h2>
      </div>

      <div class="row">
        <div class="col-md-8">

          <form role="form" name="guardar-registro" id="guardar-registro" method="POST" action="modelo-producto.php">

            <div class="card-body">

              <div class="form-group">
                <label for="descripcion">Descripción: </label>
                <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Ingresar un descripcion">
              </div>

              <div class="row">
                <div class="col-sm-6">
                  <!-- textarea -->
                  <div class="form-group">
                    <label>Comentarios</label>
                    <textarea class="form-control" rows="3" placeholder="Añada un comentario..."></textarea>
                  </div>
                </div>
              </div>
              <!-- TODO while php cargar vendedores -->
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Seleccione un vendedor</label>
                  <select class="form-control">
                    <option>
                    </option>
                  </select>
                  <a href="<?php echo $base_path ?>/vendedores/crear-vendedor.php" class="nav-link">Nuevo vendedor</a>


                </div>
                <!-- select -->
              </div>

              <!-- text input -->
              <!-- <div class="col-sm-6">
                <div class="form-group">
                  <label>Text</label>
                  <input type="text" class="form-control" placeholder="Enter ...">
                </div>
              </div> -->


              <!-- checkbox -->
              <!-- <div class="col-sm-6">
                  <div class="form-group">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox">
                      <label class="form-check-label">Checkbox</label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" checked>
                      <label class="form-check-label">Checkbox checked</label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" disabled>
                      <label class="form-check-label">Checkbox disabled</label>
                    </div>
                  </div>
                </div> -->



              <!-- radio -->
              <!-- <div class="col-sm-6">
                  <div class="form-group">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="radio1">
                      <label class="form-check-label">Radio</label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="radio1" checked>
                      <label class="form-check-label">Radio checked</label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" disabled>
                      <label class="form-check-label">Radio disabled</label>
                    </div>

                  </div>

                </div> -->







              <!-- <div class="form-group">
                <label class="col-form-label" for="inputSuccess"><i class="fas fa-check"></i> Input with
                  success</label>
                <input type="text" class="form-control is-valid" id="inputSuccess" placeholder="Enter ...">
              </div> -->
              <!-- <div class="form-group">
                <label class="col-form-label" for="inputWarning"><i class="far fa-bell"></i> Input with
                  warning</label>
                <input type="text" class="form-control is-warning" id="inputWarning" placeholder="Enter ...">
              </div> -->
              <!-- <div class="form-group">
                <label class="col-form-label" for="inputError"><i class="far fa-times-circle"></i> Input with
                  error</label>
                <input type="text" class="form-control is-invalid" id="inputError" placeholder="Enter ...">
              </div> -->


              <!-- <label for="customFile">Custom File</label> -->
              <!-- <div class="form-group">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="customFile">
                  <label class="custom-file-label" for="customFile">Choose file</label>
                </div>
              </div> -->

            </div>
            <!-- /.card-body -->


            <div class="card-footer">
              <input type="hidden" name="registro" value="nuevo">
              <!-- id="crear_cliente" para agregar validaciones en app.js-->
              <button type="submit" class="btn btn-primary" id="crear_producto">Agregar</button>
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