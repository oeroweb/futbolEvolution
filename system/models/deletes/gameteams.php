<?php 

  if(isset($_GET)){
    session_start();
    require_once '../../controller/connection.php';
  
    $id = $_GET['id'];
    
    $sql = "UPDATE equipos set estado_id = 3 WHERE id = '$id'";
    $resultado = mysqli_query($con, $sql);
    
    if($resultado){
      $_SESSION['completado'] = "Eliminado de forma exitosa!";	
      header("Location: ../../game.php");
    } else{
      $_SESSION['fallo'] = "Hubo un error, por favor volver a intentar";
      header("Location: ../../game.php");
    }
  }
?>
