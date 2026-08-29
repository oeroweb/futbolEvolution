<?php 

  if(isset($_POST)){
    session_start();
    require_once '../../controller/connection.php';
  
    $id = $_POST['id'];
    $idDetallePartido = $_POST['idDetallePartido'];
    $motivo = $_POST['motivo'];
    
    // $sql = "DELETE FROM partidos_jugados WHERE id = $idDetallePartido";
    $sql2 = "UPDATE partidos_jugados set detallepartido_id = '', motivo = '$motivo', estado_id = 1 WHERE id = $idDetallePartido";
   
    $resultado = mysqli_query($con, $sql2);
    
    if($resultado){
      $_SESSION['completado'] = "Eliminado de forma exitosa!";	
      header("Location: ../../gamesoccerplayers.php?id=$id");
    } else{
      $_SESSION['fallo'] = "Hubo un error, por favor volver a intentar";
      header("Location: ../../gamesoccerplayers.php?id=$id");
    }
  }
?>
