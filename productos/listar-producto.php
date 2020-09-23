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
              <h3 class="card-title">Lista productos</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="registros" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Producto</th>
                    <th>Comentario</th>
                    <th>Vendedor</th>
                    <th>Acciones </th>
                  </tr>
                </thead>
                <tbody>
                  <?php

                  try {
                    $sql = 'SELECT p.id_producto, p.descripcion, p.comentario, p.imagen, v.nombre_fantasia, v.nombre, v.apellido FROM productos AS p, vendedores as v WHERE v.id_vendedor = p.id_vendedor';
                    $resultado = $conn->query($sql);
                  } catch (Exception $th) {
                    echo 'Error: ' . $th->getMessage();
                  }
                  while ($producto = $resultado->fetch_assoc()) { ?>
                    <tr>

                      <td><?php echo $producto['descripcion']; ?></td>
                      <td><?php echo $producto['comentario']; ?></td>
                      <td><?php echo $producto['nombre_fantasia'] . '' . $producto['nombre'] . ' ' . $producto['apellido'] ?></td>
                      <td>
                        <a href="editar-producto.php?id=<?php echo $producto['id_producto']; ?>" class="btn btn-sm btn-warning">
                          <i class="fas fa-pen-square"></i>
                        </a>
                        <a href="#" data-id="<?php echo $producto['id_producto']; ?>" data-tipo="producto" class="btn btn-sm btn-danger borrar_registro">
                          <i class="fas fa-trash"></i>
                        </a>
                      </td>
                    </tr>
                  <?php }; ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>Producto</th>
                    <th>Comentario</th>
                    <th>Vendedor</th>
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