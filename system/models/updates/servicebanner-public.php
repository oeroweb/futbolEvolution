<?php

if (isset($_GET)) {
  session_start();
  require_once '../../controller/connection.php';

  $id = $_GET['id'];

  $sql = "UPDATE servicios set estado_id = 2 WHERE id = $id";
  $resultado = mysqli_query($con, $sql);

  if ($resultado) {
    $_SESSION['completado'] = "Actualizado de forma exitosa!";
    header("Location: ../../services.php");
  } else {
    $_SESSION['fallo'] = "Hubo un error, por favor volver a intentar";
    header("Location: ../../services.php");
  }
}
