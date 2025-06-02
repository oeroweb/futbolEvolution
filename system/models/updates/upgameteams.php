<?php 
	if(isset($_POST)){
		session_start();
		require_once '../../controller/connection.php';
		
		$id= $_POST['id'];		
		$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;		
    $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;		
		$imagen_existente = isset($_POST['imagen_existente']) ? $_POST['imagen_existente'] : false;
		$tiempo = time();

		$nombre_imagen = $_FILES['imagen']['name'];
		$tipo_imagen = $_FILES['imagen']['type'];
		$extension = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);

		$subir_imagen = "";
		if($nombre_imagen){
			$subir_imagen = $tiempo .'.'. $extension;
			
			$carpeta_destino = $_SERVER['DOCUMENT_ROOT'] . '/assets/img/equipos/';	
			// $carpeta_destino = $_SERVER['DOCUMENT_ROOT'] . '/PAGFutbolEvolution/assets/img/equipos/';
			move_uploaded_file($_FILES['imagen']['tmp_name'], $carpeta_destino.$subir_imagen);			
		}else{
			$subir_imagen = $imagen_existente;
		}
		die();

		$sql="UPDATE equipos SET nombre='$nombre', descripcion='$descripcion', imagen='$subir_imagen' WHERE id = '$id';";
		$resultado = mysqli_query($con,$sql);

		if($resultado){
			$_SESSION['completado'] = "Actualizado forma exitosa";	
			header("Location: ../../globales.php");
		} else{
			$_SESSION['fallo'] = "Hubo un error; por favor volver a intentar";
			header("Location: ../../globales.php");
		}		 		

	}
 	
?>