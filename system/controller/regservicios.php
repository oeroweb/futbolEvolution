<?php 

	if(isset($_POST)){	
		session_start();			
		require_once 'connection.php';
		
		$destino ="oeroweb@gmail.com";  
		$titulo = 'Solicitan información de servicio, desde la web';
    $name = mysqli_real_escape_string($con, $_POST['nama']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
		
		$sql = "INSERT INTO registro_servicios (nombre, correo, telefono, fecha) VALUES ('$name', '$email', '$phone', CURDATE());";

		$resultado = mysqli_query($con, $sql);

		if($resultado){
			$_SESSION['completado'] = "Solicitud enviada de forma exitosa";	
			header("Location: ../../services.php");
		} else{
			$_SESSION['fallo'] = "Hubo un error; por favor volver a intentar";
			header("Location: ../../services.php");
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
