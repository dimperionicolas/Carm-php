<footer class="main-footer">
  <div class="float-right d-none d-sm-block">
    <b>Version</b> 3.0.5
  </div>
  <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights
  reserved.
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper se abre en el header.php-->


<!-- jQuery -->
<script src="<?php echo $base_path ?>/js/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo $base_path ?>/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo $base_path ?>/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo $base_path ?>/js/demo.js"></script>
<!-- SweetAlert -->
<script src="<?php echo $base_path ?>/js/sweetalert.min.js"></script>
<!-- DataTables -->
<script src="<?php echo $base_path ?>/js/jquery.dataTables.min.js"></script>
<script src="<?php echo $base_path ?>/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo $base_path ?>/js/dataTables.responsive.min.js"></script>
<script src="<?php echo $base_path ?>/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo $base_path ?>/js/login-ajax.js"></script>


<!-- En base a que pagina apunta, carga uno u otro archivo -->
<?php
$archivo = basename($_SERVER["PHP_SELF"]);
$pagina = str_replace(".php", "", $archivo);
if ($pagina == 'crear-admin') {
  echo '<script src="'.$base_path.'/js/admin-ajax.js"></script>';
} else if ($pagina == 'crear-vendedor') {
  echo '<script src="'.$base_path.'/js/vendedor-ajax.js"></script>';
}

?>

<!-- 
  <script src="<?php echo $base_path ?>/js/admin-ajax.js"></script>
<script src="<?php echo $base_path ?>/js/vendedor-ajax.js"></script> 
-->

<script src="<?php echo $base_path ?>/js/app.js"></script>

</body>

</html>