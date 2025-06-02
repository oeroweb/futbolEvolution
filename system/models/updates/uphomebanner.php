<?php 
	if(isset($_POST)){
		session_start();
		require_once '../../controller/connection.php';
		
		$id= $_POST['id'];		
		$en_titulo = isset($_POST['en_titulo']) ? $_POST['en_titulo'] : false;		
    $es_titulo = isset($_POST['es_titulo']) ? $_POST['es_titulo'] : false;		
    $en_descripcion = isset($_POST['en_descripcion']) ? $_POST['en_descripcion'] : false;		
    $es_descripcion = isset($_POST['es_descripcion']) ? $_POST['es_descripcion'] : false;
		
		$sql="UPDATE homebanner SET en_titulo='$en_titulo', es_titulo='$es_titulo', en_descripcion='$en_descripcion', es_descripcion='$es_descripcion' WHERE id = $id;";
		$resultado = mysqli_query($con,$sql);

		if($resultado){
			$_SESSION['completado'] = "Actualizado forma exitosa";	
			header("Location: ../../home.php");
		} else{
			$_SESSION['fallo'] = "Hubo un error; por favor volver a intentar";
			header("Location: ../../home.php");
		}
	}
 	
?>