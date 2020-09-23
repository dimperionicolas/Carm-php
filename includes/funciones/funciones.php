<?php
class nicoexception extends \Exception{}
set_error_handler(function (int $errno, string $errstr, string $errfile = null, int $errline = null, array $errcontext = null) {
    // if ($errno == E_WARNING) {
    //     echo 'Es un alerta';
    // }
    var_dump(['Errno' => $errno, 'Errstr' => $errstr]);
    E_ALL | ~E_NOTICE;
    throw new nicoexception('probandp'.$errstr);
    // throw new Exception($errstr);
},   E_ALL ^ E_NOTICE);

try {
    $conn = new mysqli('localhost', 'root', 'root', 'CarminaDB', 3306);
} catch (\Throwable $th) {
    die($th->getMessage());
}
