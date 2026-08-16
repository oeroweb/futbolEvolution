<?php 
// $con = mysqli_connect('localhost', 'u781511255_evoluser', 'yTu?SkI3jG>', 'u781511255_evoluciones');
$con = mysqli_connect('localhost', 'root', '', 'dbfutbolevolution');

if (!$con) {
    echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
    echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
    echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
    exit;
}


?>