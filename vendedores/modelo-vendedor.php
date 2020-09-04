<?php
 define('__ROOT__',dirname(dirname(__FILE__)));
include_once 'includes/funciones/funciones.php';
$fantasia = $_POST['fantasia'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$direccion = $_POST['direccion'];
$contacto = $_POST['contacto'];
$social = $_POST['social'];

$id_registro = $_POST['id_registro'];

//Crear nuevo administrador
if ($_POST['registro'] == 'nuevo') {
    try {
        $stmt = $conn->prepare("INSERT INTO vendedores (nombre_fantasia,nombre,apellido,direccion,contacto,social,fecha_agregado,editado) VALUES (?,?,?,?,?,?,NOW(),NOW())");
        $stmt->bind_param("ssssis", $fantasia, $nombre, $apellido, $direccion, $contacto, $social);
        $stmt->execute();
        $id_registro = $stmt->insert_id;

        if ($id_registro > 0) {
            $response = array(
                'respuesta' => 'exito',
                'id_vendedor' => $id_registro
            );
        } else {
            $response = array(
                'respuesta' => 'error'
            );
        };
        $stmt->close();
        $conn->close();
    } catch (Exception $th) {
        $response = array(
            'respuesta' => 'Error: ' . $th->getMessage()
        );
    }
    die(json_encode($response));
}

//editar/actualizar administrador
if ($_POST['registro'] == 'actualizar') {

    if (empty($_POST['password'])) {
        $stmt = $conn->prepare("UPDATE administradores SET usuario = ?, nombre = ?, editado = NOW() WHERE id_admin = ?");
        $stmt->bind_param("ssi", $usuario, $nombre, $id_registro);
    } else {
        $opciones = array(
            'cost' => 12
        );

        $password_hashed = password_hash($password, PASSWORD_BCRYPT, $opciones);

        $stmt = $conn->prepare("UPDATE administradores SET usuario = ?, nombre = ?,password = ?, editado = NOW() WHERE id_admin = ?");
        $stmt->bind_param("sssi", $usuario, $nombre, $password_hashed, $id_registro);
    }

    try {
        $stmt->execute();
        $id_registro = $stmt->insert_id;

        if ($stmt->affected_rows) {
            $response = array(
                'respuesta' => 'exito',
                'id_actualizado' => $stmt->insert_id
            );
        } else {
            $response = array(
                'respuesta' => 'error'
            );
        };
        $stmt->close();
        $conn->close();
    } catch (Exception $th) {
        echo 'Error: ' . $th->getMessage();
    }
    // TODO por que lo pone como die(json_encode($response); y le funciona?
    echo json_encode($response);
}


//elimina administrador
if ($_POST['registro'] == 'eliminar') {
    $id_borrar = $_POST['id'];
    try {

        $stmt = $conn->prepare("DELETE FROM administradores WHERE id_admin = ?");
        $stmt->bind_param("i", $id_borrar);

        $stmt->execute();

        if ($stmt->affected_rows) {
            $response = array(
                'respuesta' => 'exito',
                'id_eliminado' => $id_borrar
            );
        } else {
            $response = array(
                'respuesta' => 'error'
            );
        };
        $stmt->close();
        $conn->close();
    } catch (Exception $th) {
        echo 'Error: ' . $th->getMessage();
    }
    die(json_encode($response));
}
