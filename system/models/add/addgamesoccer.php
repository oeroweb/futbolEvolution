<?php 
	if(isset($_POST)){
		session_start();
		require_once '../../controller/connection.php';
		
		$id = isset($_POST['id']) ? $_POST['id'] : false;		
		$idlocal = isset($_POST['idlocal']) ? $_POST['idlocal'] : false;		
    $fechapartido = isset($_POST['fecha']) ? $_POST['fecha'] : false;		
    $genero = isset($_POST['genero']) ? $_POST['genero'] : false;		
    $hora = isset($_POST['hora']) ? $_POST['hora'] : false;
    $costo = isset($_POST['costo']) ? $_POST['costo'] : false;
    $total_jugadores = isset($_POST['total_jugadores']) ? $_POST['total_jugadores'] : false;
    $idversus = isset($_POST['idversus']) ? $_POST['idversus'] : false;
    $nivel = isset($_POST['nivel']) ? $_POST['nivel'] : false;
    $beneficio1 = isset($_POST['beneficio1']) ? $_POST['beneficio1'] : 1;
    $beneficio2 = isset($_POST['beneficio2']) ? $_POST['beneficio2'] : 1;
    $beneficio3 = isset($_POST['beneficio3']) ? $_POST['beneficio3'] : 1;
    $beneficio4 = isset($_POST['beneficio4']) ? $_POST['beneficio4'] : 1;
    $beneficio5 = isset($_POST['beneficio5']) ? $_POST['beneficio5'] : 1;		
				
		$sql="INSERT INTO `detallepartido`(id, fecha_partido, hora, genero, total_jugadores, en_nivel, costo, beneficio1, beneficio2, beneficio3, beneficio4, beneficio5, local_id, cantidad_id, estado_id, fecha) VALUES ('$id','$fechapartido', '$hora', '$genero', '$total_jugadores', '$nivel', '$costo', '$beneficio1', '$beneficio2', '$beneficio3', '$beneficio4', '$beneficio5', '$idlocal', '$idversus', 2, CURDATE());";
		$resultado = mysqli_query($con,$sql);


		if($resultado){
			$_SESSION['completado'] = "El registro se completo de forma exitosa";	
			header("Location: ../../game.php");
		} else{
			$_SESSION['fallo'] = "Hubo un error; por favor volver a intentar";
			header("Location: ../../game.php");
		}		 		
		 

	}
 	
?>