<?php define('__ROOT__', dirname(__FILE__)) ?>
<?php require_once __ROOT__ . '/includes/funciones/sesiones.php'; ?>
<?php include __ROOT__ . '/includes/templates/header.php'; ?>
<?php include __ROOT__ . '/includes/templates/aside.php'; ?>
<?php include __ROOT__ . '/includes/templates/topbar.php'; ?>

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
        <h3 class="card-title">General</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
          <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fas fa-times"></i></button>
        </div>
      </div>
      <div class="card-body">

        <!-- Primera fila -->
        <div class="row">

          <!-- Ventas -->
          <div class="col-lg-2 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <!-- TODO consulta cantidad de ventas -->
                <h3>xx</h3>
                <p>Ventas</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="<?php echo $base_path ?>/ventas/listar-venta.php" class="small-box-footer">Ver <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->

          <!-- Ganancias -->
          <div class="col-lg-2 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <!--TODO crear dato de ganancia mensual con consulta -->
                <h3>
                  $xx
                </h3>
                <p>Ganancias</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">Ver <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->

          <!-- Clientes -->
          <div class="col-lg-2 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>xx</h3>
                <p>Clientes</p>
              </div>
              <div class="icon">
                <i class="ion ion-person"></i>
              </div>
              <a href="<?php echo $base_path ?>/clientes/listar-cliente.php" class="small-box-footer">Ver <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->

          <!-- Productos -->
          <div class="col-lg-2 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>xx</h3>
                <p>Productos</p>
              </div>
              <div class="icon">
                <i class="ion-social-buffer"></i>
              </div>
              <a href="<?php echo $base_path ?>/productos/listar-producto.php" class="small-box-footer">Ver <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->

          <!-- xxxx -->
          <div class="col-lg-2 col-6">
            <!-- small box -->
            <div class="small-box bg-muted">
              <div class="inner">
                <h3>xx</h3>
                <p>xxx</p>
              </div>
              <div class="icon">
                <i class="ion-social-buffer"></i>
              </div>
              <a href="#" class="small-box-footer">Ver <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->

          <!-- xxxxx -->
          <div class="col-lg-2 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <!-- TODO consulta cantidad de ventas -->
                <h3>xx</h3>
                <p>xxx</p>
              </div>
              <div class="icon">

                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">Ver <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->

        </div>
        <!-- /.row -->


      </div>
      <!-- /.card-body -->


      <div class="card-footer row">
        <div class="col-lg-3 col-6">
          <a href="<?php echo $base_path ?>/productos/listar-producto.php">Nueva venta</a>
        </div>
        <div class=" col-lg-3 col-6">
          <a href=" <?php echo $base_path ?>/compras/crear-compra.php">Nueva compra</a>
        </div>
        <div class="col-lg-3 col-6">
          <a href=" <?php echo $base_path ?>/clientes/crear-cliente.php">Nueva cliente</a>
        </div>
        <div class="col-lg-3 col-6">
          <a href=" <?php echo $base_path ?>/productos/crear-producto.php">Nuevo producto</a>
        </div>
      </div>
      <!-- /.card-footer-->
    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include_once __ROOT__ . '/includes/templates/footer.php'; ?>
<!-- TODO crear confirmacion por parte de admin para eliminar entradas
o un historial de cambios
o un pendiente para revision
 -->
 <!-- TODO solapa del mismo color correspondiente en el index -->