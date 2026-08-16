<?php 
  if(isset($_POST)){
		session_start();
		require_once '../../controller/connection.php';
		
		$idDetalle = isset($_POST['idDetalle']) ? $_POST['idDetalle'] : false;	
		$id = isset($_POST['id']) ? $_POST['id'] : false;	
    $idequipo = isset($_POST['idequipo']) ? $_POST['idequipo'] : false;		
    $goles = isset($_POST['goles']) ? $_POST['goles'] : false;		
      
    $sql="UPDATE detallepartido_equipos SET equipo_id ='$idequipo', cantidad_goles =$goles WHERE id = $id;";
    $resultado = mysqli_query($con,$sql);
    
		if($resultado){
      $_SESSION['completado'] = "Actualizado forma exitosa";	
      header("Location: ../../gamesoccerteams.php?id=$idDetalle");
    } else{
      $_SESSION['fallo'] = "Hubo un error; por favor volver a intentar";
      header("Location: ../../gamesoccerteams.php?id=$idDetalle");
    } 		
  } else {
    header("Location: ../../league.php");
  }		
 	
?>