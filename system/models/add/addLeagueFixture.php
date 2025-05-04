<?php

  require '../modelo_fixture.php';
  $ME = new Modelo_Fixture();

  $equipo_a = htmlspecialchars($_POST['equipo_a'],ENT_QUOTES,'UTF-8');
  $resultados = htmlspecialchars($_POST['resultados'],ENT_QUOTES,'UTF-8');
  $equipo_b = htmlspecialchars($_POST['equipo_b'],ENT_QUOTES,'UTF-8');
  $idLiga = $_POST['idLiga'];
  $fecha = DATE('Y-m-d');

  $array_equipo_a = explode(",", $equipo_a);
  $array_resultados = explode(",", $resultados);
  $array_equipo_b = explode(",", $equipo_b);
  
  
  for($i = 0; $i < count($array_equipo_a); $i++){
    $consulta = $ME -> Registrar_Excel($array_equipo_a[$i], $array_resultados[$i], $array_equipo_b[$i], $idLiga, 2, $fecha);
  }
  echo $consulta; 
  
?>