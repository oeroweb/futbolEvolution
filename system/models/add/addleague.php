<?php 
	if(isset($_POST)){
		session_start();
		require_once '../../controller/connection.php';
				
		$en_nombre = isset($_POST['en_nombre']) ? $_POST['en_nombre'] : false;		
		$es_nombre = isset($_POST['es_nombre']) ? $_POST['es_nombre'] : false;		
		$fecha = isset($_POST['fecha']) ? $_POST['fecha'] : false;		
		$idlocal = isset($_POST['idlocal']) ? $_POST['idlocal'] : false;	
    $en_descripcion = isset($_POST['en_descripcion']) ? $_POST['en_descripcion'] : false;			
    $es_descripcion = isset($_POST['es_descripcion']) ? $_POST['es_descripcion'] : false;			
		$tiempo = time();

		$nombre_imagen = $_FILES['imagen']['name'];
		$tipo_imagen = $_FILES['imagen']['type'];

    $subir_imagen = "";
		if($nombre_imagen){
			$subir_imagen = $tiempo . $nombre_imagen;
			$carpeta_destino = $_SERVER['DOCUMENT_ROOT'] . '/PAGFutbolEvolution/assets/img/ligas/';
			move_uploaded_file($_FILES['imagen']['tmp_name'], $carpeta_destino.$subir_imagen);			
		}

		$sql="INSERT INTO `ligas`(en_nombre, es_nombre, fecha_liga, en_descripcion, es_descripcion, imagen, local_id, estado_id, fecha) VALUES ('$en_nombre', '$es_nombre', '$fecha', '$en_descripcion', '$es_descripcion', '$subir_imagen', '$idlocal', 2, CURDATE());";
		$resultado = mysqli_query($con, $sql);

		if($resultado){
			$_SESSION['completado'] = "El registro se completo de forma exitosa";	
			header("Location: ../../league.php");
		} else{
			$_SESSION['fallo'] = "Hubo un error; por favor volver a intentar";
			header("Location: ../../league.php");
		}
	}
 	
?>