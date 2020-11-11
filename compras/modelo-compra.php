<?php define('__ROOT__', dirname(dirname(__FILE__))) ?>
<?php
include_once __ROOT__ . '/includes/funciones/funciones.php';

//si llega algun id registro (en listas), puede estar vacio
$id_registro = $_POST['id_registro'];

//nombre del producto
$nombre = $_POST['descripcion'];

//reseña sobre el producto
$comentario = $_POST['comentario'];

//vendedor del producto
$vendedor = $_POST['vendedor'];

//precio del costo del producto unitario(manualmente calcular el costo con envios o demas valores q lo afecten)
$precio = $_POST['precio'];

//precio sugerido a la venta
$sugerido = $_POST['sugerido'];

//cantidad de productos 
$cantidad = $_POST['cantidad'];

//radio button enviado (indeterminado, calzado o ropa)
$rbtn_talle = $_POST['rb_talle'];

//stock multi array calzado(talle(descr),cantidad(cant))
$st_calzado = $_POST['st_calz'];

//stock ropa (talle,cantidad)
$st_ropa = $_POST['st_ropa'];


/**Nueva compra  
 * 1-Insert en la tabla compras del vendedor y la fecha (id_compra auto incremental)
 *  En caso de no funcionar arroja error y termina la operacion.
 * 2-Insert en la tabla producto
 *  En caso de no funcionar arroja error y termina la operacion.
 * 3 - Insert en la tabla detalle compra
 *  En caso de no funcionar arroja error y pero continua la operacion.
 * 4 - Insert en la tabla stock
 *  En caso de no funcionar arroja error y pero continua la operacion.
 */
if ($_POST['registro'] == 'nuevo') {
    /** 1 - Insert para nueva compra en la tabla compras 
     * Inicialmente solo fuunciona para agregar de a un tipo de producto
     */
    try {
        $stmt = $conn->prepare('INSERT INTO compras (id_vendedor, fecha_compra) VALUES (?, NOW())');
        $stmt->bind_param("i", $vendedor);
        $stmt->execute();
        $id_compra = $stmt->insert_id;
        /**Si la compra no ingresa devuelve error y anula la operacion */
        if ($id_compra < 0) {
            $response = array(
                'respuesta' => 'error',
                'error' => 'Error al crear nueva compra'
            );
            die(json_encode($response));
        }
    } catch (\Throwable $th) {
        $response = array(
            'respuesta' => 'Error: ' . $th->getMessage(),
        );
    }

    /** 2 - Insert para un producto nuevo
     * En caso satisfactorio se procede a insertar detalle de stock
     */
    $cant_ropa = count($st_ropa);
    $cant_calzados = count($st_calzado['talle']);
    try {
        $stmt = $conn->prepare('INSERT INTO productos (descripcion, id_vendedor, comentario, precio, sugerido, fecha_agregado, editado) VALUES (?, ?, ?, ?, ?, NOW(), NOW())');
        $stmt->bind_param("sisdd", $nombre, $vendedor, $comentario, $precio, $sugerido);
        $stmt->execute();
        $id_producto = $stmt->insert_id;
        /**Si el producto no ingresa devuelve error y anula la operacion, TODO se debe eliminar la operacion de compra */
        if ($id_producto < 0) {
            $response = array(
                'respuesta' => 'error',
                'error' => 'Error al crear nuevo producto'
            );
            die(json_encode($response));
        }
    } catch (\Throwable $th) {
        $response = array(
            'respuesta' => 'Error: ' . $th->getMessage(),
        );
    }

    /** 3 - Compra y productos satisfactorios se procede a ingresar detalle y stock */

    /**Insert en tabla detalle  */
    try {
        $stmt = $conn->prepare('INSERT INTO detalle_compras (id_compra, id_producto, precio_compra, cantidad) VALUES (?, ?, ?, ?)');
        $stmt->bind_param("iidi", $id_compra, $id_producto, $precio, $cantidad);
        $stmt->execute();
        $id_detcomp = $stmt->insert_id;
        if ($id_detcomp > 0) {
            $response = array(
                'compra' => 'exito',
                'id_compra' => $id_compra,
                'producto' => 'exito',
                'id_producto' => $id_producto,
                'detalle' => 'correcto',
                'id_detcomp' => $id_detcomp,
            );
        } else {
            $response = array(
                'compra' => 'exito',
                'id_compra' => $id_compra,
                'producto' => 'exito',
                'id_producto' => $id_producto,
                'detalle' => 'error',
            );
        }
    } catch (\Throwable $th) {
        $response = array(
            'respuesta' => 'Error3: ' . $th->getMessage(),
        );
    }

    /** 4 - Insert en tabla stock
     *  $id_registro > 0 
     * $id_registro es el valor devuelto en la accion sobre la base de datos
     * de ser mayor a cero se tratara de una operacion exitosa
     */
    if ($rbtn_talle == "indeterminado") {
        /** $rbtn_talle == "indeterminado"
         * $rbtn_talle se encuentra indeterminado, sin detallar
         * solo indicara la cantidad de unidades bajo el talle "ind" por no ser especifico 
         */
        try {
            $stmt = $conn->prepare("INSERT INTO stock (id_producto, cant, talle) VALUES (?, ?, 'ind')");
            $stmt->bind_param("ii", $id_producto, $cantidad);
            $stmt->execute();
            $reg_stock = $stmt->affected_rows;
            if ($reg_stock > 0) {
                $response['stock'] = 'correcto';
            } else {
                $response['stock'] = 'error';
            }
        } catch (\Throwable $th) {
            $errorStock =  'Error en stock: ' . $th->getMessage();
        }
    } elseif ($rbtn_talle == "calzado") {
        /** $rbtn_talle == "calzado"
         * $rbtn_talle indica que se trata de calzado, por lo que la estructura es distinta
         * procede a insertar detallando cantidad y talle en stock
         */
        try {
            for ($i = 0; $i < $cant_calzados; $i++) {
                $stmt = $conn->prepare('INSERT INTO stock (id_producto, talle, cant) VALUES (?, ?, ?)');
                $stmt->bind_param("isi", $id_producto, $st_calzado['talle'][$i], $st_calzado['cant'][$i]);
                $stmt->execute();
                $reg_stock = $stmt->affected_rows;
                if ($reg_stock > 0) {
                    $response['stock'] = 'correcto';
                } else {
                    $response['stock'] = 'error';
                }
            }
        } catch (\Throwable $th) {
            $errorStock = 'Error en stock: ' . $th->getMessage();
        }
    } elseif ($rbtn_talle == "ropa") {
        /** $rbtn_talle == "ropa"
         * $rbtn_talle indica que se trata de ropa, por lo que la estructura es distinta
         * procede a insertar detallando cantidad y talle en stock
         */
        try {
            foreach ($st_ropa as $rtalle => $value) {
                foreach ($value as $key2 => $rcant) {
                    if ($rcant == 0) {
                        continue;
                    }
                    $stmt = $conn->prepare('INSERT INTO stock (id_producto, talle, cant) VALUES (?, ?, ?)');
                    $stmt->bind_param("isi", $id_producto, $rtalle, $rcant);
                    $stmt->execute();
                    $reg_stock = $stmt->affected_rows;
                    if ($reg_stock > 0) {
                        $response['stock'] = 'correcto';
                    } else {
                        $response['stock'] = 'error';
                    }
                }
            }
        } catch (\Throwable $th) {
            $errorStock = 'Error en stock: ' . $th->getMessage();
        }
    }

    $stmt->close();
    $conn->close();
    /** Este $response es resultado de todas operaciones exitosas */
    $response['respuesta'] = 'exito';
    die(json_encode($response));
}
