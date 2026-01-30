<?php 
		session_start();
		require_once '../../controller/connection.php';
		
		$id= $_POST['id'];		
		$descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;		
    $correo = isset($_POST['correo']) ? $_POST['correo'] : false;
    $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : false;		
    $url_global = isset($_POST['url_global']) ? $_POST['url_global'] : false;
    $url_facebook = isset($_POST['url_facebook']) ? $_POST['url_facebook'] : false;
    $url_instagram = isset($_POST['url_instagram']) ? $_POST['url_instagram'] : false;
    $url_youtube = isset($_POST['url_youtube']) ? $_POST['url_youtube'] : false;

		$sql="UPDATE globales SET descripcion='$descripcion', correo='$correo', telefono='$telefono', url_global='$url_global', url_facebook='$url_facebook', url_instagram='$url_instagram', url_youtube='$url_youtube' WHERE id = '$id';";
		$resultado = mysqli_query($con,$sql);

		if($resultado){
      $_SESSION['completado'] = "Actualizado forma exitosa";	
      header("Location: ../../globales.php");
    } else{
      $_SESSION['fallo'] = "Hubo un error; por favor volver a intentar";
      header("Location: ../../globales.php");
    }		 		
 	
?>