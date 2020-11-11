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
              <table id="registros" class="table table-bordered table-striped table-hover">
                <thead>
                  <tr>
                    <th>Fecha compra</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Vendedor</th>
                    <th>Total</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  try {
                    $sql = 'SELECT c.id_compra, c.fecha_compra, p.descripcion,dc.precio_compra,dc.cantidad, v.nombre_fantasia,v.nombre,v.apellido FROM compras c, detalle_compras dc, productos p, vendedores v WHERE c.id_compra = dc.id_compra and dc.id_producto = p.id_producto and v.id_vendedor = c.id_vendedor ORDER BY c.fecha_compra ASC';
                    $resultado = $conn->query($sql);
                  } catch (Exception $th) {
                    echo 'Error: ' . $th->getMessage();
                  }
                  while ($res = $resultado->fetch_assoc()) { ?>
                    <tr>
                      <td><?php echo $res['fecha_compra']; ?></td>
                      <td><?php echo $res['descripcion']; ?></td>
                      <td><?php echo $res['cantidad']; ?></td>
                      <td><?php echo $res['precio_compra']; ?></td>
                      <td><?php echo $res['nombre_fantasia'] . '' . $res['nombre'] . ' ' . $res['apellido'] ?></td>
                      <td><?php
                          $total = floatval($res['precio_compra']) * intval($res['cantidad']);
                          echo $total; ?></td>
                    </tr>
                  <?php }; ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>Fecha compra</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Vendedor</th>
                    <th>Total</th>
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