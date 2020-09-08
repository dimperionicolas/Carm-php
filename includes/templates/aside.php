<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="#" class="brand-link">
    <!-- TODO -->
    <img src="#" alt="CarLog" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Carmina</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="#" class="img-circle elevation-2" alt="Foto">
      </div>
      <div class="info">
        <a href="#" class="d-block"><?php echo $_SESSION['nombre']; ?></a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Operaciones
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?php echo $base_path ?>/ventas/crear-venta.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Venta</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo $base_path ?>/compras/crear-compra.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Compras</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo $base_path ?>/productos/crear-producto.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Inventario</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-header">Otros</li>

        <!-- Administradores -->
        <?php if ($_SESSION['nivel'] == 1) { ?>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Administradores <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo $base_path ?>/administradores/crear-admin.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Crear</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo $base_path ?>/administradores/listar-admin.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Listar/Eliminar</p>
                </a>
              </li>
            </ul>
          </li>
        <?php } ?>

        <!-- <li class="nav-item">
              <a href="calendario.php" class="nav-link">
                <i class="nav-icon far fa-calendar-alt"></i>
                <p>
                  Calendario
                  <span class="badge badge-info right"></span>
                </p>
              </a>
            </li> -->

        <!-- Vendedores -->
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Vendedores <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?php echo $base_path ?>/vendedores/crear-vendedor.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Crear</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo $base_path ?>/vendedores/listar-vendedor.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Listar/Eliminar</p>
              </a>
            </li>
          </ul>
        </li>

        <!-- clientes -->
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Clientes <i class="right fas fa-angle-left"></i>
            </p>
          </a>

          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?php echo $base_path ?>/clientes/crear-cliente.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Crear</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo $base_path ?>/clientes/listar-cliente.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Listar/Eliminar</p>
              </a>
            </li>
          </ul>
        </li>

        <!-- productos -->
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Productos <i class="right fas fa-angle-left"></i>
            </p>
          </a>

          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?php echo $base_path ?>/productos/crear-producto.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Crear</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo $base_path ?>/productos/listar-producto.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Listar/Eliminar</p>
              </a>
            </li>
          </ul>
        </li>


        <!-- historial -->
        <li class="nav-item">
          <a href="historial.php" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Ver historial movimientos</p>
          </a>
        </li>
      </ul>

    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->

</aside>