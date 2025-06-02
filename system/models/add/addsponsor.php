<?php 
	if(isset($_POST)){
		session_start();
		require_once '../../controller/connection.php';
		
		$idusuario = isset($_POST['idusuario']) ? $_POST['idusuario'] : false;
    $liga = isset($_POST['liga']) ? $_POST['liga'] : false;
		$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
		$capitan = isset($_POST['capitan']) ? $_POST['capitan'] : false;	
    $correo = isset($_POST['correo']) ? $_POST['correo'] : false;
    $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : false;   

		if($idusuario){
			
			$sql2 ="SELECT * FROM usuarios WHERE id = $idusuario";
			$login = mysqli_query($con, $sql2);
			
			if($login && mysqli_num_rows($login) == 1){
				$usuario = mysqli_fetch_assoc($login);
				
				$capitan2 = $usuario['nombres'] .' '. $usuario['apellidos'];
				$email = $usuario['email'];
				$phone = $usuario['telefono'];				

				$sql="INSERT INTO `sponsor`(nombre, capitan, liga, correo, telefono, usuario_id, estado_id, fecha) VALUES ('$nombre', '$capitan2', '$liga', '$email', '$phone', '$idusuario', 2, CURDATE());";

				$resultado = mysqli_query($con,$sql);
		
				if($resultado){
					$_SESSION['completado'] = "El registro se completo de forma exitosa";	
					header("Location: ../../../sponsor.php");
				} else{
					$_SESSION['fallo'] = "Hubo un error; por favor volver a intentar";
					header("Location: ../../../sponsor.php");
				}
			}
		}	else {

			$sql="INSERT INTO `sponsor`(nombre, capitan, liga, correo, telefono, estado_id, fecha) VALUES ('$nombre', '$capitan', '$liga', '$correo', '$telefono', 2, CURDATE());";
				
			$resultado = mysqli_query($con,$sql);
			
			if($resultado){
				$_SESSION['completado'] = "El registro se completo de forma exitosa";	
				header("Location: ../../../sponsor.php");
			} else{
				$_SESSION['fallo'] = "Hubo un error; por favor volver a intentar";
				header("Location: ../../../sponsor.php");
			}
		} 	
	}

 	header("Location: ../../../sponsor.php");
?>