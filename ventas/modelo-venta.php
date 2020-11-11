<?php define('__ROOT__', dirname(dirname(__FILE__))) ?>
<?php
include_once __ROOT__ . '/includes/funciones/funciones.php';

//si llega algun id registro (en listas), puede estar vacio
$id_registro = $_POST['id_registro'];

//id del producto
$id_producto = $_POST['id_producto'];

//cliente del producto
$cliente = $_POST['cliente'];

//precio del costo del producto unitario(manualmente calcular el costo con envios o demas valores q lo afecten)
$precio = $_POST['precio'];

//cantidad de productos 
$cantidad = $_POST['cantidad'];

//cliente 1 = sin cliente

/**Nueva venta  
 * 1-Insert en la tabla ventas con cliente y la fecha (id_venta auto incremental)
 *  En caso de no funcionar arroja error y termina la operacion.
 * 2- Actualiza stock
 *  En caso de no funcionar arroja error y termina la operacion.
 * 3 - Insert en la tabla detalle venta
 *  En caso de no funcionar arroja error pero continua la operacion.
 */
if ($_POST['registro'] == 'nuevo') {
    /** 1 - Insert para nueva venta en la tabla ventas 
     * Inicialmente solo fuunciona para agregar de a un tipo de producto
     */
    try {
        $stmt = $conn->prepare('INSERT INTO ventas (id_cliente, fecha_venta) VALUES (?, NOW())');
        $stmt->bind_param("i", $cliente);
        $stmt->execute();
        $id_ins_venta = $stmt->insert_id;
        /**Si la venta no ingresa devuelve error y anula la operacion */
        if ($id_ins_venta < 0) {
            $response = array(
                'respuesta' => 'error',
                'error' => 'Error al crear nueva venta'
            );
            die(json_encode($response));
        }
    } catch (\Throwable $th) {
        $response = array(
            'respuesta' => 'Error: ' . $th->getMessage(),
        );
    }

    /** 2 - Actualizar tabla Stock
     * En caso satisfactorio se procede a insertar detalle de stock
     */
    if (gettype($cantidad) == 'array') {
        foreach ($cantidad as $talle => $key1) {
            foreach ($key1 as $key2 => $cant) {
                if ($cant == 0) {
                    continue;
                }
                // array del producto con talle y cant vendidos
                $detalle_productos[$talle] = $cant;

                // Obtener stock de producto y talle especidico antes de venta para calcular nuevo stock
                $sql = "SELECT cant FROM stock WHERE id_producto = $id_producto AND talle = \"$talle\"";
                $resultado = $conn->query($sql);
                if ($resultado) {
                    $producto = $resultado->fetch_assoc();
                } else {
                    $response = array(
                        'respuesta' => 'error',
                        'error' => 'Error al crear nuevo producto'
                    );
                    die(json_encode($response));
                }
                // Calculo del nuevo valor a insertar en stock
                $nuevoStocck = $producto["cant"] - $cant;

                try {
                    $stmt = $conn->prepare('UPDATE stock SET cant = ? WHERE id_producto = ? AND talle = ?');
                    $stmt->bind_param("iis", $nuevoStocck, $id_producto, $talle);
                    $stmt->execute();
                    $id_ins_stock = $stmt->insert_id;
                    /**Si el producto no ingresa devuelve error y anula la operacion, TODO se debe eliminar la operacion de venta */
                    if ($id_ins_stock < 0) {
                        $response = array(
                            'respuesta' => 'error',
                            'error' => 'Error al crear nuevo producto'
                        );
                        die(json_encode($response));
                    }
                    $response = array(
                        'respuesta' => 'exito',
                    );
                } catch (\Throwable $th) {
                    $response = array(
                        'respuesta' => 'Error: ' . $th->getMessage(),
                    );
                }
            }
        }
        /** 3 - venta y stock satisfactorios se procede a ingresar detalle_ventas */
        /**Insert en tabla detalle_ventas  */
        try {
            $sql = "SELECT id_detalle FROM `detalle_ventas` ORDER BY id_detalle DESC LIMIT 1";
            $resultado = $conn->query($sql);
        } catch (Exception $th) {
            echo 'Error: ' . $th->getMessage();
        }
        if ($resultado) {
            $ultimo = $resultado->fetch_assoc();
            foreach ($detalle_productos as $talle => $cantidad) {
                $ultimo = intval($ultimo)  + 1;
                try {
                    $stmt = $conn->prepare('INSERT INTO detalle_ventas (id_detalle, id_venta, id_producto, talle, cantidad, precio_venta) VALUES (?, ?, ?, ?, ?, ?)');
                    $stmt->bind_param("iiisid", $ultimo, $id_ins_venta, $id_producto, $talle, $cantidad, $precio);
                    $stmt->execute();
                    $id_ins_detvent = $stmt->insert_id;
                    if (!($id_ins_detvent < 0)) {
                        $response = array(
                            'respuesta' => 'exito',
                            'venta' => 'exito',
                            'id_venta' => $id_ins_venta,
                            'stock' => 'exito',
                            'id_producto' => $id_producto,
                            'detalle_ventas' => 'exito',
                        );
                    } else {
                        $response = array(
                            'venta' => 'exito',
                            'id_venta' => $id_ins_venta,
                            'producto' => 'exito',
                            'stock' => 'exito',
                            'id_producto' => $id_producto,
                            'detalle_ventas' => 'error',
                        );
                    }
                } catch (\Throwable $th) {
                    $response = array(
                        'respuesta' => 'Error3: ' . $th->getMessage(),
                    );
                }
            }
        }
    } else {
        // Obtener stock de producto y talle especidico antes de venta para calcular nuevo stock
        $sql = "SELECT cant FROM stock WHERE id_producto = $id_producto";
        $resultado = $conn->query($sql);
        if ($resultado) {
            $producto = $resultado->fetch_assoc();
        } else {
            $response = array(
                'respuesta' => 'error',
                'error' => 'Error al crear nuevo producto'
            );
            die(json_encode($response));
        }
        // Calculo del nuevo valor a insertar en stock
        $nuevoStocck = $producto["cant"] - $cantidad;

        try {
            $stmt = $conn->prepare('UPDATE stock SET cant = ? WHERE id_producto = ?');
            $stmt->bind_param("ii", $nuevoStocck, $id_producto);
            $stmt->execute();
            $id_ins_stock = $stmt->insert_id;
            /**Si el producto no ingresa devuelve error y anula la operacion, TODO se debe eliminar la operacion de venta */
            if ($id_ins_stock < 0) {
                $response = array(
                    'respuesta' => 'error',
                    'error' => 'Error al crear nuevo producto7'
                );
                die(json_encode($response));
            }
            $response = array(
                'respuesta' => 'exito',
            );
        } catch (\Throwable $th) {
            $response = array(
                'respuesta' => 'Error: ' . $th->getMessage(),
            );
        }

        /** 3 - venta y stock satisfactorios se procede a ingresar detalle_ventas */
        /**Insert en tabla detalle_ventas  */
        try {
            $sql = "SELECT id_detalle FROM `detalle_ventas` ORDER BY id_detalle DESC LIMIT 1";
            $resultado = $conn->query($sql);
        } catch (Exception $th) {
            echo 'Error: ' . $th->getMessage();
        }
        if ($resultado) {
            $ultimo = $resultado->fetch_assoc();
            $ultimo = intval($ultimo)  + 1;
            try {
                $stmt = $conn->prepare('INSERT INTO detalle_ventas (id_detalle, id_venta, id_producto, talle, cantidad, precio_venta) VALUES (?, ?, ?, \'ind\', ?, ?)');
                $stmt->bind_param("iiiid", $ultimo, $id_ins_venta, $id_producto, $cantidad, $precio);
                $stmt->execute();
                $id_ins_detvent = $stmt->insert_id;
                if (!($id_ins_detvent < 0)) {
                    $response = array(
                        'respuesta' => 'exito',
                        'venta' => 'exito',
                        'id_venta' => $id_ins_venta,
                        'stock' => 'exito',
                        'id_producto' => $id_producto,
                        'detalle_ventas' => 'exito',
                    );
                } else {
                    $response = array(
                        'venta' => 'exito',
                        'id_venta' => $id_ins_venta,
                        'producto' => 'exito',
                        'stock' => 'exito',
                        'id_producto' => $id_producto,
                        'detalle_ventas' => 'error',
                    );
                }
            } catch (\Throwable $th) {
                $response = array(
                    'respuesta' => 'Error3: ' . $th->getMessage(),
                );
            }
        }
    };



    $stmt->close();
    $conn->close();
    die(json_encode($response));
}
