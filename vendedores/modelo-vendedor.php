<?php
define('__ROOT__', dirname(dirname(__FILE__)));
include_once __ROOT__.'/includes/funciones/funciones.php';
$fantasia = $_POST['fantasia'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$direccion = $_POST['direccion'];
$contacto = $_POST['contacto'];
$social = $_POST['red_social'];

$id_registro = $_POST['id_registro'];


//Crear nuevo vendedor
if ($_POST['registro'] == 'nuevo') {
    try {
        $stmt = $conn->prepare("INSERT INTO vendedores (nombre_fantasia, nombre, apellido, direccion, contacto, social, fecha_agregado, editado) VALUES (?,?,?,?,?,?,NOW(),NOW())");
        $stmt->bind_param("ssssss", $fantasia, $nombre, $apellido, $direccion, $contacto, $social);
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
    echo json_encode($response);
}

//editar/actualizar vendedor
if ($_POST['registro'] == 'actualizar') {
    try {
        $stmt = $conn->prepare("UPDATE vendedores SET nombre_fantasia = ?, nombre = ?, apellido = ?, direccion = ?, contacto = ?, social = ?, editado = NOW() WHERE id_vendedor = ?");
        $stmt->bind_param("ssssssi", $fantasia, $nombre, $apellido, $direccio, $contacto, $social, $id_registro);
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


//elimina vendedor
if ($_POST['registro'] == 'eliminar') {
    $id_borrar = $_POST['id'];
    try {

        $stmt = $conn->prepare("DELETE FROM vendedores WHERE id_vendedor = ?");
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
