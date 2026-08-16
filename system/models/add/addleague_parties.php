<?php 
	if(isset($_POST)){
		session_start();
		require_once '../../controller/connection.php';
		
		$ligaid = isset($_POST['id']) ? $_POST['id'] : false;		
		$en_titulo = isset($_POST['en_titulo']) ? $_POST['en_titulo'] : false;		
    $es_titulo = isset($_POST['es_titulo']) ? $_POST['es_titulo'] : false;		
    $en_descripcion = isset($_POST['en_descripcion']) ? $_POST['en_descripcion'] : false;		
    $es_descripcion = isset($_POST['es_descripcion']) ? $_POST['es_descripcion'] : false;
		
    $sql="INSERT INTO `ligaspartidos`(en_titulo, es_titulo, en_descripcion, es_descripcion, liga_id, estado_id, fecha) VALUES ('$en_titulo','$es_titulo', '$en_descripcion', '$es_descripcion', $ligaid, 2, CURDATE());";

		$resultado = mysqli_query($con,$sql);

		if($resultado){
			$_SESSION['completado'] = "Actualizado forma exitosa";	
			header("Location: ../../league.php");
		} else{
			$_SESSION['fallo'] = "Hubo un error; por favor volver a intentar";
			header("Location: ../../league.php");
		}
	}
 	
?>