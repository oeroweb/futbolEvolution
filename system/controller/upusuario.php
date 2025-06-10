<?php 
	if(isset($_POST)){		
		require_once 'connection.php';
			
		$id = isset($_POST['id']) ? $_POST['id'] : false;		
		$nombres = isset($_POST['nombre']) ? $_POST['nombre'] : false;		
    $apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : false;		
    $genero = isset($_POST['genero']) ? $_POST['genero'] : false;		
    $fec_nac = isset($_POST['fecha']) ? $_POST['fecha'] : false;
    $nacionalidad = isset($_POST['nacionalidad']) ? $_POST['nacionalidad'] : false;
    $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : false;
    $correo = isset($_POST['correo']) ? $_POST['correo'] : false;
    $password = isset($_POST['password']) ? $_POST['password'] : false;
    $rol = isset($_POST['rol']) ? $_POST['rol'] : false;
    $nivel = isset($_POST['nivel']) ? $_POST['nivel'] : false;
    $posicion = isset($_POST['posicion']) ? $_POST['posicion'] : false;
    $posicion2 = isset($_POST['posicion2']) ? $_POST['posicion2'] : false;
    $pie = isset($_POST['pie']) ? $_POST['pie'] : false;
				
		$sql="UPDATE `usuarios` SET nombres='$nombres', apellidos='$apellidos', genero='$genero', fec_nac='$fec_nac', nacionalidad='$nacionalidad', telefono='$telefono', clave='$password', rol='$rol', fecha=CURDATE() WHERE id = $id";
    $resultado = mysqli_query($con,$sql);
    
		if($resultado){
      echo json_encode(array('error' => false));
    }else{
      echo json_encode(array('error' => true));
    }	
	}
 	
?>