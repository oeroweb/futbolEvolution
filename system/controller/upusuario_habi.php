<?php 
	if(isset($_POST)){		
		require_once 'connection.php';
			
		$id = isset($_POST['id']) ? $_POST['id'] : false;
    $nombres = isset($_POST['nombre']) ? $_POST['nombre'] : false;		
    $apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : false;
    $correo = isset($_POST['correo']) ? $_POST['correo'] : false;
    $password = isset($_POST['password']) ? $_POST['password'] : false;
		$nivel_fb = isset($_POST['nivel_fb']) ? $_POST['nivel_fb'] : false;		
    $nivel = isset($_POST['nivel']) ? $_POST['nivel'] : false;		
    $posicion1 = isset($_POST['posicion1']) ? $_POST['posicion1'] : false;		
    $posicion2 = isset($_POST['posicion2']) ? $_POST['posicion2'] : false;   
    $pie = isset($_POST['pie']) ? $_POST['pie'] : false;
    $mvp = isset($_POST['mvp']) ? $_POST['mvp'] : 0;
    $partidos = isset($_POST['partidos']) ? $_POST['partidos'] : 0;
		
    $newMvp = 0;
    $newPartidos = 0;

    if($mvp >= 1){      
      $newMvp = $mvp;
    } else {     
      $newMvp = 0;
    }
    
    if($partidos >= 1){
      $newPartidos = $partidos;
    } else {
      $newPartidos = 0;
    }

		$sql="UPDATE `usuarios` SET nombres='$nombres', apellidos='$apellidos', nivel_juego='$nivel', posicion='$posicion1', posicion_dos='$posicion2', pie_dominante='$pie', nivel_interno='$nivel_fb', partidos_jugados=$newPartidos, mvp=$newMvp, fecha=CURDATE() WHERE id = $id";
    $resultado = mysqli_query($con,$sql);    

		if($resultado){
      echo json_encode(array('error' => false));
    }else{
      echo json_encode(array('error' => true));
    }	
	}
 	
?>