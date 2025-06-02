<?php
session_start();
require_once '../../controller/connection.php';

$id = $_POST['id'];
$en_nombre = isset($_POST['en_nombre']) ? $_POST['en_nombre'] : false;
$es_nombre = isset($_POST['es_nombre']) ? $_POST['es_nombre'] : false;
$fecha = isset($_POST['fecha']) ? $_POST['fecha'] : false;
$idlocal = isset($_POST['idlocal']) ? $_POST['idlocal'] : false;
$en_descripcion = isset($_POST['en_descripcion']) ? $_POST['en_descripcion'] : false;
$es_descripcion = isset($_POST['es_descripcion']) ? $_POST['es_descripcion'] : false;
$imagen_existente = isset($_POST['imagen_existente']) ? $_POST['imagen_existente'] : false;
$tiempo = time();

$nombre_imagen = $_FILES['imagen']['name'];
$tipo_imagen = $_FILES['imagen']['type'];
$extension = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);

$subir_imagen = "";
if ($nombre_imagen) {
  $subir_imagen = $tiempo .'.'. $extension;

  $carpeta_destino = $_SERVER['DOCUMENT_ROOT'] . '/assets/img/ligas/';	
  // $carpeta_destino = $_SERVER['DOCUMENT_ROOT'] . '/PAGFutbolEvolution/assets/img/ligas/';
  move_uploaded_file($_FILES['imagen']['tmp_name'], $carpeta_destino . $subir_imagen);
} else {
  $subir_imagen = $imagen_existente;
}

$sql = "UPDATE ligas SET en_nombre='$en_nombre', es_nombre='$es_nombre', fecha_liga='$fecha', local_id='$idlocal', en_descripcion='$en_descripcion', es_descripcion='$es_descripcion', imagen='$subir_imagen' WHERE id = $id;";

$resultado = mysqli_query($con, $sql);

if ($resultado) {
  $_SESSION['completado'] = "Actualizado forma exitosa";
  header("Location: ../../league.php");
} else {
  $_SESSION['fallo'] = "Hubo un error; por favor volver a intentar";
  header("Location: ../../league.php");
}
