<?php 
	session_start();
	require_once '../../controller/connection.php';
	
	$ligaid = isset($_POST['ligaid']) ? $_POST['ligaid'] : false;		
	$en_titulo = isset($_POST['en_titulo']) ? $_POST['en_titulo'] : false;		
	$es_titulo = isset($_POST['es_titulo']) ? $_POST['es_titulo'] : false;		
	$en_descripcion = isset($_POST['en_descripcion']) ? $_POST['en_descripcion'] : false;		
	$es_descripcion = isset($_POST['es_descripcion']) ? $_POST['es_descripcion'] : false;

	$nombre_archivo = $_FILES['archivo']['name'];
	$subir_archivo = "";
	
	if ($nombre_archivo) {
		$subir_archivo = $nombre_archivo;
	
		$carpeta_destino = $_SERVER['DOCUMENT_ROOT'] . '/documentos/';	
		// $carpeta_destino = $_SERVER['DOCUMENT_ROOT'] . '/PAGFutbolEvolution/documentos/';
		move_uploaded_file($_FILES['archivo']['tmp_name'], $carpeta_destino . $subir_archivo);
	} 
	
	$sql = "INSERT INTO ligasfixture (en_titulo, es_titulo, en_descripcion, es_descripcion, archivo, liga_id, estado_id, fecha) VALUES ('$en_titulo', '$es_titulo', '$en_descripcion', '$es_descripcion', '$subir_archivo', $ligaid, 2, CURDATE());";

	$resultado = mysqli_query($con,$sql);

	if($resultado){
		$_SESSION['completado'] = "Añadido de forma exitosa";	
		header("Location: ../../league.php");
	} else{
		$_SESSION['fallo'] = "Hubo un error; por favor volver a intentar";
		header("Location: ../../league.php");
	}

?>