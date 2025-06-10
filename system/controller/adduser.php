<?php 
	if(isset($_POST)){
		session_start();
		require_once 'connection.php';
			
		$nombres = isset($_POST['nombre']) ? $_POST['nombre'] : false;		
    $apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : false;		
    $genero = isset($_POST['genero']) ? $_POST['genero'] : false;		
    $fec_nac = isset($_POST['fecha']) ? $_POST['fecha'] : false;
    $nacionalidad = isset($_POST['nacionalidad']) ? $_POST['nacionalidad'] : false;
    $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : false;
    $correo = isset($_POST['correo']) ? $_POST['correo'] : false;
    $password = isset($_POST['password']) ? $_POST['password'] : false;
    $nivel = isset($_POST['nivel']) ? $_POST['nivel'] : false;
    $posicion = isset($_POST['posicion']) ? $_POST['posicion'] : false;
    $posicion2 = isset($_POST['posicion2']) ? $_POST['posicion2'] : false;
    $pie = isset($_POST['pie']) ? $_POST['pie'] : false;
				
		$sql="INSERT INTO `usuarios`(nombres, apellidos, genero, fec_nac, nacionalidad, telefono, email, clave, rol, nivel_juego, posicion, posicion_dos, pie_dominante, estado_id, fecha) VALUES ('$nombres','$apellidos', '$genero', '$fec_nac', '$nacionalidad', '$telefono', '$correo', '$password', 'jugador', '$nivel', '$posicion', '$posicion2', '$pie', 2, CURDATE());";
		$resultado = mysqli_query($con,$sql);
		
		if($resultado){
      echo json_encode(array('error' => false));
    }else{
      echo json_encode(array('error' => true));
    }
		
	}
 	
?>