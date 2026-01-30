<?php 
	if(isset($_POST)){
		session_start();
		require_once '../../controller/connection.php';
		
		$id= $_POST['id'];		
		$en_titulo = isset($_POST['en_titulo']) ? $_POST['en_titulo'] : false;		
    $es_titulo = isset($_POST['es_titulo']) ? $_POST['es_titulo'] : false;		
    $en_descripcion = isset($_POST['en_descripcion']) ? $_POST['en_descripcion'] : false;		
    $es_descripcion = isset($_POST['es_descripcion']) ? $_POST['es_descripcion'] : false;
    $imagen_existente = isset($_POST['imagen_existente']) ? $_POST['imagen_existente'] : false;
		$tiempo = time();

		$nombre_imagen = $_FILES['imagen']['name'];
		$tipo_imagen = $_FILES['imagen']['type'];
		$extension = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);

    $subir_imagen = "";
		if($nombre_imagen){
			if($tipo_imagen=="image/jpeg" || $tipo_imagen=="image/jpg" || $tipo_imagen=="image/png" || $tipo_imagen4=="image/svg"){
				$subir_imagen = $tiempo .'.'. $extension;
			
				$carpeta_destino = $_SERVER['DOCUMENT_ROOT'] . '/assets/img/partidos/';	
				move_uploaded_file($_FILES['imagen']['tmp_name'], $carpeta_destino.$subir_imagen);
			} else {					
				$_SESSION['fallo'] = "Error esto no es una imagen, vuele a probar";
				header("Location: ../../gamebanner-edit.php?id=$id");
				die();
			}		
		}else{
			$subir_imagen = $imagen_existente;
		}	

		$sql="UPDATE partidosbanner SET en_titulo='$en_titulo', es_titulo='$es_titulo', en_descripcion='$en_descripcion', es_descripcion='$es_descripcion', imagen='$subir_imagen' WHERE id = $id;";		
		$resultado = mysqli_query($con,$sql);

		if($resultado){
      $_SESSION['completado'] = "Actualizado forma exitosa";	
      header("Location: ../../game.php");
    } else{
      $_SESSION['fallo'] = "Hubo un error; por favor volver a intentar";
      header("Location: ../../game.php");
    }
	}				 		
 	
?>