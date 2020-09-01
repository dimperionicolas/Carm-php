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
<script src="js/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="js/demo.js"></script>
<!-- SweetAlert -->
<script src="js/sweetalert.min.js"></script>
<!-- DataTables -->
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap4.min.js"></script>
<script src="js/dataTables.responsive.min.js"></script>
<script src="js/responsive.bootstrap4.min.js"></script>
<script src="js/login-ajax.js"></script>


<!-- En base a que pagina apunta, carga uno u otro archivo -->
<?php
$archivo = basename($_SERVER["PHP_SELF"]);
$pagina = str_replace(".php", "", $archivo);
if ($pagina == 'crear-admin') {
  echo '<script src="js/admin-ajax.js"></script>';
} else if ($pagina == 'crear-vendedor') {
  echo '<script src="js/vendedor-ajax.js"></script>';
}

?>

<!-- 
  <script src="js/admin-ajax.js"></script>
<script src="js/vendedor-ajax.js"></script> 
-->

<script src="js/app.js"></script>

</body>

</html>