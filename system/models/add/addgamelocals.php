<?php
if (isset($_POST)) {
	session_start();
	require_once '../../controller/connection.php';

	$en_nombre = isset($_POST['en_nombre']) ? $_POST['en_nombre'] : false;
	$en_direccion = isset($_POST['en_direccion']) ? $_POST['en_direccion'] : false;
	$url_google = isset($_POST['url_google']) ? $_POST['url_google'] : false;		
  $url_apple = isset($_POST['url_apple']) ? $_POST['url_apple'] : false;
	$tiempo = time();

	$nombre_imagen1 = $_FILES['imagen1']['name'];
	$tipo_imagen1 = $_FILES['imagen1']['type'];
	$nombre_imagen2 = $_FILES['imagen2']['name'];
	$tipo_imagen2 = $_FILES['imagen2']['type'];
	$nombre_imagen3 = $_FILES['imagen3']['name'];
	$tipo_imagen3 = $_FILES['imagen3']['type'];
	$nombre_imagen4 = $_FILES['imagen4']['name'];
	$tipo_imagen4 = $_FILES['imagen4']['type'];
	$nombre_imagen5 = $_FILES['imagen5']['name'];
	$tipo_imagen5 = $_FILES['imagen5']['type'];

	$subir_imagen1 = "";
	$subir_imagen2 = "";
	$subir_imagen3 = "";
	$subir_imagen4 = "";
	$subir_imagen5 = "";

	//$carpeta_destino = $_SERVER['DOCUMENT_ROOT'] . '/assets/img/slides/';	
	$carpeta_destino = $_SERVER['DOCUMENT_ROOT'] . '/PAGFutbolEvolution/assets/img/partidos/';

	if ($nombre_imagen1) {
		if ($tipo_imagen1 == "image/jpeg" || $tipo_imagen1 == "image/jpg" || $tipo_imagen1 == "image/png" || $tipo_imagen4 == "image/svg") {
			$subir_imagen1 = $tiempo . $nombre_imagen1;

			move_uploaded_file($_FILES['imagen1']['tmp_name'], $carpeta_destino . $subir_imagen1);
		} else {
			$_SESSION['fallo'] = "Error la imagen 1 no es una imagen, vuele a probar";
			header("Location: ../../gamelocals-add.php");
			die();
		}
	}

	if ($nombre_imagen2) {
		if ($tipo_imagen2 == "image/jpeg" || $tipo_imagen2 == "image/jpg" || $tipo_imagen2 == "image/png" || $tipo_imagen4 == "image/svg") {
			$subir_imagen2 = $tiempo . $nombre_imagen2;

			move_uploaded_file($_FILES['imagen2']['tmp_name'], $carpeta_destino . $subir_imagen2);
		} else {
			$_SESSION['fallo'] = "Error la imagen 2 no es una imagen, vuele a probar";
			header("Location: ../../gamelocals-add.php");
			die();
		}
	}

	if ($nombre_imagen3) {
		if ($tipo_imagen3 == "image/jpeg" || $tipo_imagen3 == "image/jpg" || $tipo_imagen3 == "image/png" || $tipo_imagen4 == "image/svg") {
			$subir_imagen3 = $tiempo . $nombre_imagen3;

			move_uploaded_file($_FILES['imagen3']['tmp_name'], $carpeta_destino . $subir_imagen3);
		} else {
			$_SESSION['fallo'] = "Error la imagen 3 no es una imagen, vuele a probar";
			header("Location: ../../gamelocals-add.php");
			die();
		}
	}

	if ($nombre_imagen4) {
		if ($tipo_imagen4 == "image/jpeg" || $tipo_imagen4 == "image/jpg" || $tipo_imagen4 == "image/png" || $tipo_imagen4 == "image/svg") {
			$subir_imagen4 = $tiempo . $nombre_imagen4;

			move_uploaded_file($_FILES['imagen4']['tmp_name'], $carpeta_destino . $subir_imagen4);
		} else {
			$_SESSION['fallo'] = "Error la imagen 4 no es una imagen, vuele a probar";
			header("Location: ../../gamelocals-add.php");
			die();
		}
	}
	
	if ($nombre_imagen5) {
		if ($tipo_imagen5 == "image/jpeg" || $tipo_imagen5 == "image/jpg" || $tipo_imagen5 == "image/png" || $tipo_imagen5 == "image/svg") {
			$subir_imagen5 = $tiempo . $nombre_imagen5;

			move_uploaded_file($_FILES['imagen5']['tmp_name'], $carpeta_destino . $subir_imagen5);
		} else {
			$_SESSION['fallo'] = "Error la imagen 5 no es una imagen, vuele a probar";
			header("Location: ../../gamelocals-add.php");
			die();
		}
	}

	$sql = "INSERT INTO partidoslocales (en_nombre, en_direccion, imagen1, imagen2, imagen3, imagen4, imagen5, url_google, url_apple, estado_id, fecha) VALUES ('$en_nombre', '$en_direccion', '$subir_imagen1', '$subir_imagen2', '$subir_imagen3', '$subir_imagen4', '$subir_imagen5', '$url_google', '$url_apple', 2, CURDATE());";

	$resultado = mysqli_query($con, $sql);

	if ($resultado) {
		$_SESSION['completado'] = "El registro se completo de forma exitosa";
		header("Location: ../../game.php");
	} else {
		$_SESSION['fallo'] = "Hubo un error; por favor volver a intentar";
		header("Location: ../../game.php");
	}
}
