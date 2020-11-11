<?php define('__ROOT__',dirname(dirname(__FILE__))) ?>
<?php



include_once __ROOT__.'/includes/funciones/funciones.php';
$usuario = $_POST['usuario'];
$nombre = $_POST['nombre'];
$password = $_POST['password'];
$id_registro = $_POST['id_registro'];

//Crear nuevo administrador
if ($_POST['registro'] == 'nuevo') {
    $opciones = array(
        'cost' => 12
    );
    $password_hashed = password_hash($password, PASSWORD_BCRYPT, $opciones);
    try {
        $stmt = $conn->prepare("INSERT INTO administradores (usuario,nombre,password,editado) VALUES (?,?,?,NOW())");
        $stmt->bind_param("sss", $usuario, $nombre, $password_hashed);
        $stmt->execute();
        $id_registro = $stmt->insert_id;

        if ($id_registro > 0) {
            $response = array(
                'respuesta' => 'exito',
                'id_admin' => $id_registro
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
    die(json_encode($response));
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


