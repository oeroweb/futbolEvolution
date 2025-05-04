<?php 
		session_start();
		require_once '../../controller/connection.php';
		
		$id= $_POST['id'];		
		$idequipo1 = isset($_POST['idequipo1']) ? $_POST['idequipo1'] : false;		
    $idequipo2 = isset($_POST['idequipo2']) ? $_POST['idequipo2'] : false;		
    $resultado_equipo1 = isset($_POST['resultado_equipo1']) ? $_POST['resultado_equipo1'] : false;		
    $resultado_equipo2 = isset($_POST['resultado_equipo2']) ? $_POST['resultado_equipo2'] : false;  

		$sql="UPDATE detallepartido SET equipo1_id ='$idequipo1', equipo2_id ='$idequipo2', resultado_equipo1 ='$resultado_equipo1', resultado_equipo2 ='$resultado_equipo2' WHERE id = '$id';";
		
		$resultado = mysqli_query($con,$sql);

		if($resultado){
      $_SESSION['completado'] = "Actualizado forma exitosa";	
      header("Location: ../../game.php");
    } else{
      $_SESSION['fallo'] = "Hubo un error; por favor volver a intentar";
      header("Location: ../../game.php");
    }		 		
 	
?>