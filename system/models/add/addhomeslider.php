<?php 
	if(isset($_POST)){
		session_start();
		require_once '../../controller/connection.php';
		
		$en_titulo = isset($_POST['en_titulo']) ? $_POST['en_titulo'] : false;		
    $es_titulo = isset($_POST['es_titulo']) ? $_POST['es_titulo'] : false;		
    $en_descripcion = isset($_POST['en_descripcion']) ? $_POST['en_descripcion'] : false;		
    $es_descripcion = isset($_POST['es_descripcion']) ? $_POST['es_descripcion'] : false;
		$tiempo = time();

		$nombre_imagen = $_FILES['imagen']['name'];
		$tipo_imagen = $_FILES['imagen']['type'];
		$extension = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
		
		if($tipo_imagen=="image/jpeg" || $tipo_imagen=="image/jpg" || $tipo_imagen=="image/png" || $tipo_imagen=="image/svg"){

			$carpeta_destino = $_SERVER['DOCUMENT_ROOT'] . '/assets/img/slides/';	
			// $carpeta_destino = $_SERVER['DOCUMENT_ROOT'] . '/PAGFutbolEvolution/assets/img/slides/';
			move_uploaded_file($_FILES['imagen']['tmp_name'], $carpeta_destino.$subir_imagen);		
			
			$sql="INSERT INTO `homeslider`(en_titulo, es_titulo, en_descripcion, es_descripcion, imagen, estado_id, fecha) VALUES ('$en_titulo', '$es_titulo', '$en_descripcion', '$es_descripcion', '$nombre_imagen', 2, CURDATE());";
			$resultado = mysqli_query($con,$sql);
	
			if($resultado){
				$_SESSION['completado'] = "El registro se completo de forma exitosa";	
				header("Location: ../../home.php");
			} else{
				$_SESSION['fallo'] = "Hubo un error; por favor volver a intentar";
				header("Location: ../../home.php");
			}		 		
		} else {					
			$_SESSION['fallo'] = "Error esto no es una imagen, vuele a probar";
			header("Location: ../../homeslider-add.php");
		}

	}
 	
?>