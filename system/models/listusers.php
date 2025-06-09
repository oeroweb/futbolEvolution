<?php

require_once '../controller/connection.php';
  $sql = "SELECT u.*, e.nombre as nombreestado FROM usuarios u INNER JOIN paises p on u.nacionalidad = p.id INNER JOIN estados e on u.estado_id = e.id WHERE u.estado_id = 2;";
  // $sql = "SELECT u.*, e.nombre as nombreestado FROM usuarios u INNER JOIN paises p on u.nacionalidad = p.iso INNER JOIN estados e on u.estado_id = e.id  WHERE u.estado_id = 2";

  $result = mysqli_query($con, $sql);

  if(!$result){
    die("Error! Fallo de Comunicación");
  }else{
    while($data = mysqli_fetch_assoc($result)){
      $arreglo['data'][]= $data;
      
    }
    echo json_encode($arreglo);
  }
mysqli_free_result($result);
mysqli_close($con);

?>