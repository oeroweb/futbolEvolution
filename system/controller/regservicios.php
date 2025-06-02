<?php 

	if(isset($_POST)){	
		session_start();			
		require_once 'connection.php';
		
		$destino ="oeroweb@gmail.com";  
		$titulo = 'Solicitan información de servicio, desde la web';
		$idusuario = isset($_POST['idusuario']) ? $_POST['idusuario'] : false;
    $name = mysqli_real_escape_string($con, isset($_POST['name']) ? $_POST['name'] : false);
    $email = mysqli_real_escape_string($con,isset($_POST['email']) ? $_POST['email'] : false);
    $phone = mysqli_real_escape_string($con, isset($_POST['phone']) ? $_POST['phone'] : false);

		if($idusuario){
			
			$sql2 ="SELECT * FROM usuarios WHERE id = $idusuario";
			$login = mysqli_query($con, $sql2);
			
			if($login && mysqli_num_rows($login) == 1){
				$usuario = mysqli_fetch_assoc($login);				
				$nombres = $usuario['nombres'] .' '. $usuario['apellidos'];
				$email = $usuario['email'];
				$phone = $usuario['telefono'];				

				$sql="INSERT INTO `registro_servicios`(nombre, correo, telefono, usuario_id, estado_id, fecha) VALUES ('$nombres', '$email', '$phone', '$idusuario', 2, CURDATE());";

				$resultado = mysqli_query($con,$sql);
		
				if($resultado){
					$_SESSION['completado'] = "Solicitud enviada de forma exitosa";	
					header("Location: ../../services.php");
				} else{
					$_SESSION['fallo'] = "Hubo un error; por favor volver a intentar";
					header("Location: ../../services.php");
				}
			}
		}	else {		
			$sql = "INSERT INTO registro_servicios (nombre, correo, telefono, fecha) VALUES ('$name', '$email', '$phone', CURDATE());";

			$resultado = mysqli_query($con, $sql);

			if($resultado){
				$_SESSION['completado'] = "Solicitud enviada de forma exitosa";	
				header("Location: ../../services.php");
			} else{
				$_SESSION['fallo'] = "Hubo un error; por favor volver a intentar";
				header("Location: ../../services.php");
			}
		}

		$contenido = '
      <html>
      <head>
        <title> '. $titulo . '</title>
      </head>
      <body>
        <h2 style="color:#0A4369">Nuevo cliente solicita información de servicio</h2><hr><p><strong>' . $name . '</strong>escribio por la web y solicita información para un nuevo servicio, su correo es <strong>' . $correo . '</strong> y su teléfono <strong>' . $phone . '</strong></p>
      </body>
      </html>
      ';
      
      $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
      $cabeceras .= 'Content-type: text/html; charset=utf-8' . "\r\n";  
			
			mail($destino, $titulo, $contenido, $cabeceras);
	}
?>
