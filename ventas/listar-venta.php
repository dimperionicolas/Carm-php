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
              <table id="registros" class="table table-bordered table-striped table-hover">
                <thead>
                  <tr>
                    <th>Fecha</th>
                    <th>Cliente</th>
                    <th>Monto</th>
                    <th>Detallar</th>
                  </tr>
                </thead>
                <tbody>
                  <!--SELECT ventas.id_venta, ventas.fecha_venta, clientes.id_cliente, clientes.nombre, clientes.apellido, detalle_ventas.cantidad, productos.descripcion FROM ventas, clientes, detalle_ventas, productos where ventas.id_venta = detalle_ventas.id_venta AND detalle_ventas.id_producto = productos.id_producto -->
                </tbody>
                <tfoot>
                  <tr>
                    <th>Fecha</th>
                    <th>Cliente</th>
                    <th>Monto</th>
                    <th>Detallar</th>
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