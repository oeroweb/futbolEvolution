<?php 
  if(isset($_POST)){
    session_start();
    require_once '../../controller/connection.php';
    
    $partidoid = isset($_POST['idDetallePartido']) ? $_POST['idDetallePartido'] : false;		
    $idUsuario = isset($_POST['idUsuario']) ? $_POST['idUsuario'] : false;		
    $posicion = isset($_POST['posicion']) ? $_POST['posicion'] : false;		

    $consulta = "SELECT * FROM partidos_jugados WHERE detallepartido_id='$partidoid' and usuario_id=$idUsuario;";
    $respuesta = mysqli_query($con, $consulta);

    if($respuesta && mysqli_num_rows($respuesta) >=1){   
      $_SESSION['completado'] = "Ya estas registrado";
      header("Location: ../../../game-detail.php?id=$partidoid");
    } else {
      $sql = "INSERT INTO partidos_jugados (detallepartido_id, usuario_id, posicion, estado_id, fecha) VALUES 
      ('$partidoid', $idUsuario, '$posicion', 2, CURDATE());";
      $resultado = mysqli_query($con,$sql);

      if ($resultado) {
        $_SESSION['completado'] = "Registro realizado de forma exitosa";
        header("Location: ../../../payment.php?id=$partidoid");
        // header("Location: ../../../game-detail.php?id=$partidoid");
      } else {
        $_SESSION['fallo'] = "Hubo un error; por favor volver a intentar";
        header("Location: ../../../game-detail.php?id=$partidoid");
      }
    }
  }

?>