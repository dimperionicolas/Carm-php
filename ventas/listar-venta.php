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
              <h3 class="card-title">Ventas realizadas</h3>
            </div>

            <!-- /.card-header -->
            <div class="card-body">
              <table id="registros" class="tabla-ventas table table-bordered table-striped table-hover">
                <thead>
                  <tr>
                    <th class="ordenamiento">Fecha</th>
                    <th>Producto</th>
                    <th>Talle</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Cliente</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  try {
                    $sql = "SELECT v.id_venta, dv.id_detalle, v.fecha_venta,dv.id_producto, dv.talle, dv.cantidad, dv.precio_venta, p.descripcion,c.nombre, c.apellido FROM ventas v,detalle_ventas dv, productos p, clientes c WHERE v.id_venta = dv.id_venta AND dv.id_producto = p.id_producto AND v.id_cliente = c.id_cliente ORDER BY v.fecha_venta DESC";
                    $resultado = $conn->query($sql);
                  } catch (Exception $th) {
                    echo 'Error: ' . $th->getMessage();
                  }
                  while ($venta = $resultado->fetch_assoc()) {
                  ?>
                    <tr>
                      <td><?php echo $venta['fecha_venta']; ?></td>
                      <td><?php echo $venta['descripcion']; ?></td>
                      <td><?php echo $venta['talle']; ?></td>
                      <td><?php echo $venta['cantidad']; ?></td>
                      <td><?php echo $venta['precio_venta']; ?></td>
                      <td><?php echo $venta['nombre'] . " " . $venta['apellido']; ?></td>
                    </tr>
                  <?php } ?>

                </tbody>
                <tfoot>
                  <tr>
                    <th>Fecha</th>
                    <th>Producto</th>
                    <th>Talle</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Cliente</th>
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