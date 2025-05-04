<?php 
	if(isset($_POST)){
		session_start();
		require_once '../../controller/connection.php';
		
		$id= $_POST['id'];		
		$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;		
    $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;		
		$tiempo = time();

		$nombre_imagen = $_FILES['imagen']['name'];
		$tipo_imagen = $_FILES['imagen']['type'];
		
		$subir_imagen = "";
		if($tipo_imagen=="image/jpeg" || $tipo_imagen=="image/jpg" || $tipo_imagen=="image/png" || $tipo_imagen=="image/svg"){
			$subir_imagen = $tiempo . $nombre_imagen;

			//$carpeta_destino = $_SERVER['DOCUMENT_ROOT'] . '/assets/img/slides/';	
			$carpeta_destino = $_SERVER['DOCUMENT_ROOT'] . '/PAGFutbolEvolution/assets/img/equipos/';
			move_uploaded_file($_FILES['imagen']['tmp_name'], $carpeta_destino.$subir_imagen);		
			
			$sql="INSERT INTO `equipos`(id, nombre, descripcion, imagen, estado_id, fecha) VALUES ('$id','$nombre', '$descripcion', '$subir_imagen', 2, CURDATE());";
			$resultado = mysqli_query($con,$sql);
	
			if($resultado){
				$_SESSION['completado'] = "El registro se completo de forma exitosa";	
				header("Location: ../../game.php");
			} else{
				$_SESSION['fallo'] = "Hubo un error; por favor volver a intentar";
				header("Location: ../../game.php");
			}		 		
		} else {					
			$_SESSION['fallo'] = "Error esto no es una imagen, vuele a probar";
			header("Location: ../../gameteams-add.php");
		}

	}
 	
?>