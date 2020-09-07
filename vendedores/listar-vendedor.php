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
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Lista vendedores</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="registros" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Nombre de fantasía</th>
                    <th>Nombre</th>
                    <th>Apellido </th>
                    <th>Direccion </th>
                    <th>Contacto </th>
                    <th>Social </th>
                    <th>Acciones </th>

                  </tr>
                </thead>
                <tbody>
                  <?php

                  try {
                    $sql = "SELECT id_vendedor, nombre_fantasia, nombre, apellido, direccion, contacto, social  FROM vendedores";
                    $resultado = $conn->query($sql);
                  } catch (Exception $th) {
                    echo 'Error: ' . $th->getMessage();
                  }
                  while ($vend = $resultado->fetch_assoc()) { ?>
                    <tr>

                      <td><?php echo $vend['nombre_fantasia']; ?></td>
                      <td><?php echo $vend['nombre']; ?></td>
                      <td><?php echo $vend['apellido']; ?></td>
                      <td><?php echo $vend['direccion']; ?></td>
                      <td><?php echo $vend['contacto']; ?></td>
                      <td><?php echo $vend['social']; ?></td>
                      <td>
                        <a href="editar-vendedor.php?id=<?php echo $vend['id_vendedor']; ?>" class="btn btn-sm btn-warning">
                          <i class="fas fa-pen-square"></i>
                        </a>
                        <a href="#" data-id="<?php echo $vend['id_vendedor']; ?>" data-tipo="vendedor" class="btn btn-sm btn-danger borrar_registro">
                          <i class="fas fa-trash"></i>
                        </a>
                      </td>
                    </tr>
                  <?php }; ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>Nombre de fantasía</th>
                    <th>Nombre</th>
                    <th>Apellido </th>
                    <th>Direccion </th>
                    <th>Contacto </th>
                    <th>Social </th>
                    <th>Acciones </th>

                  </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include_once __ROOT__ . '/includes/templates/footer.php'; ?>