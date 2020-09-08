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
              <h3 class="card-title">Lista clientes</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="registros" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Usuario</th>
                    <th>Nombre</th>
                    <th>Direccion</th>
                    <th>Contacto</th>
                    <th>Acciones </th>
                  </tr>
                </thead>
                <tbody>
                  <?php

                  try {
                    $sql = 'SELECT id_cliente, nombre, apellido, direccion, contacto FROM clientes';
                    $resultado = $conn->query($sql);
                  } catch (Exception $th) {
                    echo 'Error: ' . $th->getMessage();
                  }
                  while ($cliente = $resultado->fetch_assoc()) { ?>
                    <tr>

                      <td><?php echo $cliente['nombre']; ?></td>
                      <td><?php echo $cliente['apellido']; ?></td>
                      <td><?php echo $cliente['direccion']; ?></td>
                      <td><?php echo $cliente['contacto']; ?></td>
                      <td>
                        <a href="editar-cliente.php?id=<?php echo $cliente['id_cliente']; ?>" class="btn btn-sm btn-warning">
                          <i class="fas fa-pen-square"></i>
                        </a>
                        <a href="#" data-id="<?php echo $cliente['id_cliente']; ?>" data-tipo="cliente" class="btn btn-sm btn-danger borrar_registro">
                          <i class="fas fa-trash"></i>
                        </a>
                      </td>
                    </tr>
                  <?php }; ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>Usuario</th>
                    <th>Nombre</th>
                    <th>Direccion</th>
                    <th>Contacto</th>
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