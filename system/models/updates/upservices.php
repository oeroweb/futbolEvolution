<?php
session_start();
require_once '../../controller/connection.php';

$id = $_POST['id'];
$en_titulo = isset($_POST['en_titulo']) ? $_POST['en_titulo'] : false;
$es_titulo = isset($_POST['es_titulo']) ? $_POST['es_titulo'] : false;
$en_subtitulo = isset($_POST['en_subtitulo']) ? $_POST['en_subtitulo'] : false;
$es_subtitulo = isset($_POST['es_subtitulo']) ? $_POST['es_subtitulo'] : false;
$en_descripcion = isset($_POST['en_descripcion']) ? $_POST['en_descripcion'] : false;
$es_descripcion = isset($_POST['es_descripcion']) ? $_POST['es_descripcion'] : false;
$documento = isset($_POST['documento']) ? $_POST['documento'] : false;
$tiempo = time();

$nombre_imagen = $_FILES['imagen']['name'];
$tipo_imagen = $_FILES['imagen']['type'];
$nombre_archivo = $_FILES['archivo']['name'];
$extension = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);

$subir_imagen = "";
$subir_archivo = "";

if ($nombre_imagen) {
  $subir_imagen = $tiempo .'.'. $extension;

  $carpeta_destino = $_SERVER['DOCUMENT_ROOT'] . '/assets/img/services/';	
  // $carpeta_destino = $_SERVER['DOCUMENT_ROOT'] . '/PAGFutbolEvolution/assets/img/services/';
  move_uploaded_file($_FILES['imagen']['tmp_name'], $carpeta_destino . $subir_imagen);
} else {
  $subir_imagen = $imagen_existente;
}

if ($nombre_archivo) {
  $subir_archivo = $nombre_archivo;

  $carpeta_destino = $_SERVER['DOCUMENT_ROOT'] . '/documentos/';	
  // $carpeta_destino = $_SERVER['DOCUMENT_ROOT'] . '/PAGFutbolEvolution/documentos/';
  move_uploaded_file($_FILES['archivo']['tmp_name'], $carpeta_destino . $subir_archivo);
} else {
  $subir_archivo = $documento;
}

$sql = "UPDATE servicios SET en_titulo='$en_titulo', es_titulo='$es_titulo', en_subtitulo='$en_subtitulo', es_subtitulo='$es_subtitulo', en_descripcion='$en_descripcion', es_descripcion='$es_descripcion', imagen='$subir_imagen', archivo='$subir_archivo'  WHERE id = $id;";

$resultado = mysqli_query($con, $sql);

if ($resultado) {
  $_SESSION['completado'] = "Actualizado forma exitosa";
  header("Location: ../../services.php");
} else {
  $_SESSION['fallo'] = "Hubo un error; por favor volver a intentar";
  header("Location: ../../services.php");
}
