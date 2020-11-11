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
            <i class="nav-icon fas fa-bars"></i>
            <p>Menu</i>
            </p>
          </a>
        </li>

        <!-- TODO cargar icono para cada li -->

        <!-- Administradores -->
        <?php if ($_SESSION['nivel'] == 1) { ?>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="fas fa-crown nav-icon"></i>
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

        <!-- Ventas -->
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="fas fa-hand-holding-usd nav-icon"></i>
            <p>Ventas <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?php echo $base_path ?>/productos/listar-producto.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Nueva venta</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo $base_path ?>/ventas/listar-venta.php" class="nav-link">
                <i class="far fa-list-alt nav-icon"></i>
                <p>Listar</p>
              </a>
            </li>
          </ul>
        </li>

        <!-- Compras -->
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="fas fa-cart-plus nav-icon"></i>
            <p>Compras <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?php echo $base_path ?>/compras/crear-compra.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Nueva compra</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo $base_path ?>/compras/listar-compra.php" class="nav-link">
                <i class="far fa-list-alt nav-icon"></i>
                <p>Listar</p>
              </a>
            </li>
          </ul>
        </li>


        <!-- Gastos -->
        <!-- <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="fas fa-file-invoice-dollar nav-icon"></i>
            <p>Gastos <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?php echo $base_path ?>/gastos/crear-gasto.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Crear</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo $base_path ?>/gastos/listar-gasto.php" class="nav-link">
                <i class="far fa-list-alt nav-icon"></i>
                <p>Listar</p>
              </a>
            </li>
          </ul>
        </li> -->


        <!-- Vendedores -->
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="fas fa-store nav-icon"></i>
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
                <i class="far fa-list-alt nav-icon"></i>
                <p>Listar/Eliminar</p>
              </a>
            </li>
          </ul>
        </li>



        <!-- clientes -->
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="fas fa-users nav-icon"></i>
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
                <i class="far fa-list-alt nav-icon"></i>
                <p>Listar/Eliminar</p>
              </a>
            </li>
          </ul>
        </li>

        <!-- productos -->
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="fas fa-box-open nav-icon"></i>
            <p>Productos <i class="right fas fa-angle-left"></i>
            </p>
          </a>

          <ul class="nav nav-treeview">
         
            <li class="nav-item">
              <a href="<?php echo $base_path ?>/productos/listar-producto.php" class="nav-link">
                <i class="far fa-list-alt nav-icon"></i>
                <p>Listar/Eliminar</p>
              </a>
            </li>
          </ul>
        </li>


        <!-- historial -->
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="far fa-folder-open nav-icon"></i>
            <p>Ver historial movimientos</p>
          </a>
        </li>
      </ul>

    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
  <!-- TODO cuando se despliega otro li, cerrar los que esten abiertos -->

</aside>