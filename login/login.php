<?php define('__ROOT__',dirname(dirname(__FILE__))) ?>
<?php include_once __ROOT__.'/includes/templates/header.php'; ?>
<?php
session_start();
$cerrar_sesion = $_GET['cerrar_sesion'];
if ($cerrar_sesion) {
  session_destroy();
}
?>


<div class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <!-- TODO ref inicio -->
      <a href="#"><b>Carmina</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Iniciar sesión</p>


        <form role="form" name="login-admin" id="login-admin" method="POST" action="login-admin.php">
          <div class="input-group mb-3">
            <input type="text" class="form-control" name="usuario" placeholder="Usuario">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" name="password" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>

          <div class="social-auth-links text-center mb-3">
            <input type="hidden" name="login-admin" value="1">
            <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
          </div>
          <!-- /.col -->
      </div>
      </form>


      <!-- /.social-auth-links -->
      <!-- 
      <p class="mb-1">
        <a href="forgot-password.html">Olvide mi contraseña </a>
      </p>
      <p class="mb-0">
        <a href="register.html" class="text-center">Register a new membership</a>
      </p> -->
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
</div>

<?php include_once __ROOT__.'/includes/templates/footer.php'; ?>