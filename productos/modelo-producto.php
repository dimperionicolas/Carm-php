<?php define('__ROOT__', dirname(dirname(__FILE__))) ?>
<?php
include_once __ROOT__ . '/includes/funciones/funciones.php';
// TOOD pasarlo todo a clase como mejora

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
$rbtn_talle = $_POST['rb_talle'];
//stock calzado ()
$st_calzado = $_POST['st_calz'];
//cantidad de elementos en array de talles y cantidad
//stock ropa ()
$st_ropa = $_POST['st_ropa'];
//cantidad de elementos en array de talles y cantidad


/**Actualiza todos los valores del producto, menos la cantidad */
if ($_POST['registro'] == 'actualizar') {
    try {
        $stmt = $conn->prepare('UPDATE productos SET descripcion = ?, comentario = ?, precio = ?, sugerido = ?, editado = NOW() WHERE id_producto = ?');
        $stmt->bind_param("ssiii", $nombre, $comentario, $precio, $sugerido, $id_registro);
        $stmt->execute();
        $id_registro = $stmt->insert_id;

        if ($stmt->affected_rows) {
            $response = array(
                'respuesta' => 'exito',
                'producto' => $id_registro
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

//**Crea un producto sin ser comprado a un proveedor */
// if ($_POST['registro'] == 'nuevo') {
//     $cant_ropa = count($st_ropa);
//     $cant_calzados = count($st_calzado['talle']);
//     try {
//         $stmt = $conn->prepare('INSERT INTO productos (descripcion, id_vendedor, comentario, precio, sugerido, fecha_agregado, editado) VALUES (?, ?, ?, ?, ?, NOW(), NOW())');
//         $stmt->bind_param("sisdd", $nombre, $vendedor, $comentario, $precio, $sugerido);
//         $stmt->execute();
//         $id_registro = $stmt->insert_id;
//         //si logra insertar el registro, procede a insertar cantidades, detalladas o no
//         if ($id_registro > 0) {
//             //inserta sin detallar
//             if ($rbtn_talle == "indeterminado") {
//                 try {
//                     $stmt = $conn->prepare("INSERT INTO stock (id_producto, cant, talle) VALUES (?, ?, 'ind')");
//                     $stmt->bind_param("ii", $id_registro, $cantidad);
//                     $stmt->execute();
//                     //numero registro devuelto
//                     $reg_stock = $stmt->affected_rows;
//                     if ($reg_stock <= 0) {
//                         $control = false;
//                     } else {
//                         $control = true;
//                     }
//                 } catch (\Throwable $th) {
//                     $errorStock =  'Error en stock: ' . $th->getMessage();
//                 }
//                 //inserta detallando talles de calzado
//             } elseif ($rbtn_talle == "calzado") {
//                 try {
//                     for ($i = 0; $i < $cant_calzados; $i++) {
//                         $stmt = $conn->prepare('INSERT INTO stock (id_producto, talle, cant) VALUES (?, ?, ?)');
//                         $stmt->bind_param("isi", $id_registro, $st_calzado['talle'][$i], $st_calzado['cant'][$i]);
//                         $stmt->execute();
//                         $reg_stock = $stmt->affected_rows;
//                         if ($reg_stock <= 0) {
//                             $control = false;
//                         } else {
//                             $control = true;
//                         }
//                         $reg_stock = 0;
//                     }
//                 } catch (\Throwable $th) {
//                     $errorStock = 'Error en stock: ' . $th->getMessage();
//                 }
//                 //inserta detallando talles de ropa
//             } elseif ($rbtn_talle == "ropa") {
//                 try {
//                     foreach ($st_ropa as $rtalle => $value) {
//                         foreach ($value as $key2 => $rcant) {
//                             if ($rcant == 0) {
//                                 continue;
//                             }
//                             $stmt = $conn->prepare('INSERT INTO stock (id_producto, talle, cant) VALUES (?, ?, ?)');
//                             $stmt->bind_param("isi", $id_registro, $rtalle, $rcant);
//                             $stmt->execute();
//                             $reg_stock = $stmt->affected_rows;
//                             if ($reg_stock <= 0) {
//                                 $control = false;
//                             } else {
//                                 $control = true;
//                             }
//                             $reg_stock = 0;
//                         }
//                     }
//                 } catch (\Throwable $th) {
//                     $errorStock = 'Error en stock: ' . $th->getMessage();
//                 }
//             }
//             //controla si el stock se ingreso correctamente
//             if ($control == true) {
//                 $response = array(
//                     'respuesta' => 'exito',
//                     'id_producto' => $id_registro,
//                     'stock' => 'correcto',
//                 );
//             } else {
//                 $response = array(
//                     'respuesta' => 'exito',
//                     'id_vendedor' => $id_registro,
//                     'stock' => $errorStock
//                 );
//             }
//         }
//         $stmt->close();
//         $conn->close();
//     } catch (\Throwable $th) {
//         $response = array(
//             'respuesta' => 'Error: ' . $th->getMessage(),
//         );
//     }
//     die(json_encode($response));
// }




/**Borrar un producto no registrado de un proveedor */
// if ($_POST['registro'] == 'eliminar') {
//     $id_borrar = $_POST['id'];
//     try {
//         $stmt = $conn->prepare("DELETE FROM stock WHERE id_producto = ?");
//         $stmt->bind_param("i", $id_borrar);
//         $stmt->execute();
//         if ($stmt->affected_rows) {
//             $stmt = $conn->prepare("DELETE FROM productos WHERE id_producto = ?");
//             $stmt->bind_param("i", $id_borrar);
//             $stmt->execute();
//             if ($stmt->affected_rows) {
//                 $response = array(
//                     'respuesta' => 'exito',
//                     'id_eliminado' => $id_borrar,
//                     'producto' => 'exito',
//                     'stock' => 'exito',
//                 );
//             } else {
//                 $response = array(
//                     'respuesta' => 'exito',
//                     'id_eliminado' => $id_borrar,
//                     'producto' => 'exito',
//                     'stock' => 'error',
//                 );
//             }
//         } else {
//             $response = array(
//                 'respuesta' => 'error',
//                 'producto' => 'escapo',
//                 'stock' => 'error'
//             );
//         };
//         $stmt->close();
//         $conn->close();
//     } catch (\Throwable $th) {
//         $response = array(
//             'respuesta' => 'Error: ' . $th->getMessage(),
//         );
//     }
//     die(json_encode($response));
// }
