<?php define('__ROOT__', dirname(dirname(__FILE__))) ?>
<?php
include_once __ROOT__ . '/includes/funciones/funciones.php';
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$direccion = $_POST['direccion'];
$contacto = $_POST['contacto'];
$id_registro = $_POST['id_registro'];

//Crear nuevo cliente
if ($_POST['registro'] == 'nuevo') {

    try {
        $stmt = $conn->prepare('INSERT INTO clientes (nombre, apellido, direccion, contacto, fecha_agregado, editado) VALUES (?,?,?,?,NOW(),NOW())');
        $stmt->bind_param("ssss", $nombre, $apellido, $direccion, $contacto);
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

//editar/actualizar cliente
if ($_POST['registro'] == 'actualizar') {
    try {
        $stmt = $conn->prepare("UPDATE clientes SET nombre = ?, apellido = ?, direccion = ?, contacto = ?, editado = NOW() WHERE id_cliente = ?");
        $stmt->bind_param("sssss", $nombre, $apellido, $direccion, $contacto, $id_registro);
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


//elimina cliente
if ($_POST['registro'] == 'eliminar') {
    $id_borrar = $_POST['id'];
    try {

        $stmt = $conn->prepare("DELETE FROM clientes WHERE id_cliente = ?");
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
