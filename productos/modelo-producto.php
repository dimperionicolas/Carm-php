<?php define('__ROOT__', dirname(dirname(__FILE__))) ?>
<?php
include_once __ROOT__ . '/includes/funciones/funciones.php';
// TOOD pasarlo todo a clase como mejora
//se ve por la pestaña network




// echo "<pre>";
// var_dump($_POST);
// echo "</pre>";

//nombre del producto
$nombre = $_POST['descripcion'];
//reseña sobre el producto
$comentario = $_POST['comentario'];
//vendedor del producto
$vendedor = $_POST['vendedor'];
//precio del costo del producto
$precio = $_POST['precio'];
//precio sugerido a la venta
$sugerido = $_POST['sugerido'];
//si llega algun id registro (en listas)
$id_registro = $_POST['id_registro'];
//cantidad de productos 
$cantidad = $_POST['cantidad'];
//radio button enviado (indeterminado, calzado o ropa)
$rb_talle = $_POST['rb-talle'];
//stock calzado ()
$st_calzado = $_POST['st_calz'];
//cantidad de elementos en array de talles y cantidad
$cant_calzados = count($st_calzado['talle']);
//stock ropa ()
$st_ropa = $_POST['st_ropa'];
//cantidad de elementos en array de talles y cantidad
$cant_ropa = count($st_ropa);


//Crear nuevo producto
if ($_POST['registro'] == 'nuevo') {

    //bandera para saber si se insertaron correctamente los valores en stock
    try {
        $stmt = $conn->prepare('INSERT INTO productos (descripcion, id_vendedor, comentario, precio, sugerido, fecha_agregado, editado) VALUES (?, ?, ?, ?, ?, NOW(), NOW())');
        $stmt->bind_param("sisdd", $nombre, $vendedor, $comentario, $precio, $sugerido);
        $stmt->execute();
        $id_registro = $stmt->insert_id;

        //si logra insertar el registro, procede a insertar cantidades, detalladas o no
        if ($id_registro > 0) {

            if ($rb_talle == "indeterminado") {

                try {
                    $stmt = $conn->prepare("INSERT INTO stock (id_producto, cant, talle) VALUES (?, ?, 'ind')");
                    $stmt->bind_param("ii", $id_registro, $cantidad);
                    $stmt->execute();
                    //numero registro devuelto
                    $reg_stock = $stmt->affected_rows;
                    echo "Numero de registro (indet) devuelto: " . $reg_stock;
                    if ($reg_stock <= 0) {
                        $control = false;
                    } else {
                        $control = true;
                    }
                } catch (\Throwable $th) {
                    $errorStock =  'Error en stock: ' . $th->getMessage();
                }
            } elseif ($rb_talle == "calzado") {
                try {
                    for ($i = 0; $i < $cant_calzados - 1; $i++) {
                        $stmt = $conn->prepare('INSERT INTO stock (id_producto, talle, cant) VALUES (?, ?, ?)');
                        $stmt->bind_param("isi", $id_registro, $st_calzado['talle'][$i], $st_calzado['cant'][$i]);
                        $stmt->execute();
                        $reg_stock = $stmt->affected_rows;
                        if ($reg_stock <= 0) {
                            $control = false;
                        } else {
                            $control = true;
                        }
                        $reg_stock = 0;
                    }
                } catch (\Throwable $th) {
                    $errorStock = 'Error en stock: ' . $th->getMessage();
                }
            } elseif ($rb_talle == "ropa") {
                try {
                    echo '<pre>';
                    var_dump($st_ropa);
                    echo '</pre>';
                    foreach ($st_ropa as $rtalle => $value) {
                        foreach ($value as $key2 => $rcant) {
                            $stmt = $conn->prepare('INSERT INTO stock (id_producto, talle, cant) VALUES (?, ?, ?)');
                            $stmt->bind_param("isi", $id_registro, $rtalle, $rcant);
                            $stmt->execute();
                            $reg_stock = $stmt->affected_rows;
                            echo "Numero de registro (ropa) devuelto: " . $reg_stock . " <br>";
                            if ($reg_stock <= 0) {
                                $control = false;
                            } else {
                                $control = true;
                            }
                            $reg_stock = 0;
                            echo $rtalle . '->' . $rcant . '<br>';
                        }
                    }
                } catch (\Throwable $th) {
                    $errorStock = 'Error en stock: ' . $th->getMessage();
                }
            }
            if ($control == true) {
                $response = array(
                    'respuesta' => 'exito',
                    'id_producto' => $id_registro,
                    'stock' => 'correcto',
                );
            } else {
                $response = array(
                    'respuesta' => 'exito',
                    'id_vendedor' => $id_registro,
                    'stock' => $errorStock
                );
            }
        }
        $stmt->close();
        $conn->close();
    } catch (\Throwable $th) {
        $response = array(
            'respuesta' => 'Error: ' . $th->getMessage(),
        );
    }
    echo json_encode($response);
}













//editar/actualizar cliente
if ($_POST['registro'] == 'actualizar') {
    try {
        $stmt = $conn->prepare('UPDATE productos SET descripcion = ?, id_vendedor = ?, comentario = ?, precio = ?, sugerido = ?, editado = NOW() WHERE id_producto = ?');
        $stmt->bind_param("sisddi", $descripcion, $vendedor, $comentario, $precio, $sugerido, $id_registro);
        $stmt->execute();
        $id_registro = $stmt->insert_id;

        if ($stmt->affected_rows) {
            $response = array(
                'respuesta' => 'exito',
                'id_actualizado' => $stmt->insert_id
            );
            // } else {
            //     $response = array(
            //         'respuesta' => 'error'
            //     );
        };
        $stmt->close();
        $conn->close();
    } catch (\Throwable $th) {
        $response = array(
            'respuesta' => 'Error: ' . $th->getMessage(),
        );
    }
    // TODO por que lo pone como die(json_encode($response); y le funciona?
    echo json_encode($response);
}


//elimina cliente
if ($_POST['registro'] == 'eliminar') {
    $id_borrar = $_POST['id'];
    try {

        $stmt = $conn->prepare("DELETE FROM productos WHERE id_producto = ?");
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
    } catch (\Throwable $th) {
        $response = array(
            'respuesta' => 'Error: ' . $th->getMessage(),
        );
    }
    die(json_encode($response));
}





// echo $descripcion;
// echo "<br>";
// echo $comentario;
// echo "<br>";
// echo $vendedor;
// echo "<br>";
// echo $id_registro;
// die();


//agrega productos al stock dependiendo de si existe o es nuevo
// function agregar_stock($conn, $detalle, $id_registro)
// {
//     try {
//         $sql = "SELECT * FROM stock WHERE id_producto = $id_registro";
//         $resultado = $conn->query($sql);
//         if ($resultado) {
//             //si existe el dato en la tabla añadirle update
//         } else {
//             for ($i = 0; $i < count($detalle['talle']); $i++) {
//                 $stmt = $conn->prepare('INSERT INTO stock (id_producto, talle, cant) VALUES (?, ?, ?)');
//                 $stmt->bind_param("isi", $id_registro, $detalle['talle'][$i], $detalle['cant'][$i]);
//                 $stmt->execute();
//                 $reg_stock = $stmt->insert_id;
//             }
//         }
//         return ;
//     } catch (\Throwable $th) {
//         $response = array(
//             'stock' => 'Error en el stock: ' . $th->getMessage(),
//         );
//     };
// };
