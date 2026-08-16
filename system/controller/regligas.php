<?php 

	if(isset($_POST)){	
		session_start();			
		require_once 'connection.php';		
		
		$idusuario = isset($_POST['idusuario']) ? $_POST['idusuario'] : false;
		$idliga = isset($_POST['idliga']) ? $_POST['idliga'] : false;
		$nombreEquipo  = isset($_POST['name']) ? $_POST['name'] : false;
		$capitan = isset($_POST['capitan']) ? $_POST['capitan'] : false;
		$correo = isset($_POST['correo']) ? $_POST['correo'] : false;	
    $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : false;
		
		if($idusuario){
			$sql2 ="SELECT * FROM usuarios WHERE id = $idusuario";
			$login = mysqli_query($con, $sql2);
			
			if($login && mysqli_num_rows($login) == 1){
				$usuario = mysqli_fetch_assoc($login);				
				$capitan2 = $usuario['nombres'] .' '. $usuario['apellidos'];
				$phone = $usuario['telefono'];				
				$email = $usuario['email'];
				
				$sql="INSERT INTO ligas_inscripcion (usuario_id, liga_id, capitan, nombre_equipo, telefono, correo, estado_id, fecha) VALUES 
				($idusuario, $idliga, '$capitan2', '$nombreEquipo', '$phone', '$email', 2, CURDATE());";
				$resultado = mysqli_query($con, $sql);
				
				if($resultado){
					$_SESSION['completado'] = "Gracias por inscribir a tu equipo $nombreEquipo";	
					header("Location: ../../league-detail.php?id=$idliga");
				} else{
					$_SESSION['fallo'] = "Hubo un error; por favor volver a intentar";
					header("Location: ../../league-detail.php?id=$idliga");
				}
			}
		}	else {
			$sql = "INSERT INTO ligas_inscripcion (liga_id, capitan, nombre_equipo, telefono, correo, estado_id, fecha) VALUES 
			($idliga, '$capitan', '$nombreEquipo', '$telefono', '$correo', 2, CURDATE());";
			$resultado = mysqli_query($con, $sql);
			
			if($resultado){
				$_SESSION['completado'] = "Gracias por inscribir a tu equipo $nombreEquipo";	
				header("Location: ../../league-detail.php?id=$idliga");
			} else{
				$_SESSION['fallo'] = "Hubo un error; por favor volver a intentar";
				header("Location: ../../league-detail.php?id=$idliga");
			}
		}
	}
?>
