<?php 
  if(isset($_POST)){
    session_start();
    require_once '../../controller/connection.php';
    
    $partidoid = isset($_POST['idDetallePartido']) ? $_POST['idDetallePartido'] : false;
    $posicion = isset($_POST['posicion']) ? $_POST['posicion'] : false;
    $idUsuarios = isset($_POST['idUsuario']) ? $_POST['idUsuario'] : array();
    echo "Partido ID: " . $partidoid . "<br>";
    echo "jugadores: " . implode(", ", $idUsuarios) . "<br>";

  if (!empty($idUsuarios)) {
      $resultado = true;
      foreach ($idUsuarios as $idUsuario) {
          $idUsuario = (int) $idUsuario;
          $sql = "INSERT INTO partidos_jugados 
                  (detallepartido_id, usuario_id, posicion, estado_id, fecha) 
                  VALUES 
                  ('$partidoid', '$idUsuario', '$posicion', 2, CURDATE())";

          if (!mysqli_query($con, $sql)) {
              $resultado = false;
              break;
          }
      }

      if ($resultado) {
          $_SESSION['completado'] = "Registros realizados de forma exitosa";
      } else {
          $_SESSION['fallo'] = "Hubo un error; por favor volver a intentar";
      }
  } else {
      $_SESSION['fallo'] = "No se recibieron jugadores para registrar";
  }

  header("Location: ../../gamesoccerplayers.php?id=$partidoid");
  }

?>