<?php
include_once __ROOT__.'/includes/funciones/config.php';
function usuario_autenticado()
{
    global $base_path;
    if (!revisar_usuario()) {
        header('Location:'.$base_path.'/login/login.php');
        exit();
    }
}
function revisar_usuario()
{
    return  isset($_SESSION['usuario']);
}

session_start();
usuario_autenticado();


