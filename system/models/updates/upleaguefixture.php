<?php 
	session_start();
	require_once '../../controller/connection.php';
	
	$id= $_POST['id'];		
	$en_titulo = isset($_POST['en_titulo']) ? $_POST['en_titulo'] : false;		
	$es_titulo = isset($_POST['es_titulo']) ? $_POST['es_titulo'] : false;		
	$en_descripcion = isset($_POST['en_descripcion']) ? $_POST['en_descripcion'] : false;		
	$es_descripcion = isset($_POST['es_descripcion']) ? $_POST['es_descripcion'] : false;
	$documento = isset($_POST['documento']) ? $_POST['documento'] : false;

	$tiempo = time();

	$nombre_archivo = $_FILES['archivo']['name'];
	$subir_archivo = "";
	
	if ($nombre_archivo) {
		$subir_archivo = $nombre_archivo;
	
		$carpeta_destino = $_SERVER['DOCUMENT_ROOT'] . '/documentos/';
		// $carpeta_destino = $_SERVER['DOCUMENT_ROOT'] . '/PAGFutbolEvolution/documentos/';
		move_uploaded_file($_FILES['archivo']['tmp_name'], $carpeta_destino . $subir_archivo);
	} else {
		$subir_archivo = $documento;
	}
	
	$sql="UPDATE ligasfixture SET en_titulo='$en_titulo', es_titulo='$es_titulo', en_descripcion='$en_descripcion', es_descripcion='$es_descripcion', archivo='$subir_archivo' WHERE liga_id = $id;";

	$resultado = mysqli_query($con,$sql);

	if($resultado){
		$_SESSION['completado'] = "Actualizado forma exitosa";	
		header("Location: ../../league.php");
	} else{
		$_SESSION['fallo'] = "Hubo un error; por favor volver a intentar";
		header("Location: ../../league.php");
	}

?>