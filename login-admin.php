<?php
include_once "includes/funciones/funciones.php";
$usuario = $_POST['usuario'];
$password = $_POST['password'];

//loguear y verificar administrador
if (isset($_POST['login-admin'])) {
    try {
        // include_once "includes/funciones/funciones.php";
        $stmt = $conn->prepare("SELECT * FROM administradores WHERE usuario = ?");
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $stmt->bind_result($id_admin, $usuario_admin, $nombre_admin, $password_admin, $editado, $nivel);
        if ($stmt->affected_rows) {
            $existe = $stmt->fetch();
            if ($existe) {
                if (password_verify($password, $password_admin)) {
                    session_start();
                    $_SESSION['usuario'] = $usuario_admin;
                    $_SESSION['nombre'] = $nombre_admin;
                    $_SESSION['nivel'] = $nivel;
                    $response = array(
                        'respuesta' => 'exitoso',
                        'usuario' => $nombre_admin
                    );
                } else {
                    $response = array(
                        'respuesta' => 'error'
                    );
                }
            } else {
                $response = array(
                    'respuesta' => 'error'
                );
            }
        }
        $stmt->close();
        $conn->close();
    } catch (Exception $th) {
        echo 'Error: ' . $th->getMessage();
    }
    die(json_encode($response));
}
