<?php 
		session_start();
		require_once '../../controller/connection.php';
		
		$id= $_POST['id'];		
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

		$sql="UPDATE detallepartido SET fecha_partido='$fechapartido', hora='$hora', genero='$genero', total_jugadores='$total_jugadores', en_nivel='$nivel', costo='$costo', beneficio1='$beneficio1', beneficio2='$beneficio2', beneficio3='$beneficio3', beneficio4='$beneficio4', beneficio5='$beneficio5', local_id='$idlocal', cantidad_id='$idversus', estado_id=2 WHERE id = '$id';";
		
		$resultado = mysqli_query($con,$sql);

		if($resultado){
      $_SESSION['completado'] = "Actualizado forma exitosa";	
      header("Location: ../../league.php");
    } else{
      $_SESSION['fallo'] = "Hubo un error; por favor volver a intentar";
      header("Location: ../../league.php");
    }		 		
 	
?>