<?php

  require '../modelo_league_partido.php';
  $ME = new Modelo_Excel();
  require_once '../../controller/connection.php';

  $columna_a = htmlspecialchars($_POST['columna_a'],ENT_QUOTES,'UTF-8');
  $columna_b = htmlspecialchars($_POST['columna_b'],ENT_QUOTES,'UTF-8');
  $columna_c = htmlspecialchars($_POST['columna_c'],ENT_QUOTES,'UTF-8');
  $columna_d = htmlspecialchars($_POST['columna_d'],ENT_QUOTES,'UTF-8');
  $columna_e = htmlspecialchars($_POST['columna_e'],ENT_QUOTES,'UTF-8');
  $columna_f = htmlspecialchars($_POST['columna_f'],ENT_QUOTES,'UTF-8');
  $idliga = htmlspecialchars($_POST['idliga'],ENT_QUOTES,'UTF-8');
  $fecha = DATE('Y-m-d');

  $arreglo_columna_a = explode(",", $columna_a);
  $arreglo_columna_b = explode(",", $columna_b);
  $arreglo_columna_c = explode(",", $columna_c);
  $arreglo_columna_d = explode(",", $columna_d);
  $arreglo_columna_e = explode(",", $columna_e);
  $arreglo_columna_f = explode(",", $columna_f);
  
  $sql="UPDATE `ligasbarrapartidos` SET estado_id= 1 WHERE liga_id = $idliga" ;
  $resultado = mysqli_query($con, $sql);

  if($resultado){
    for($i = 0; $i < count($arreglo_columna_a); $i++){
      $consulta = $ME -> Registrar_Excel($arreglo_columna_a[$i], $arreglo_columna_b[$i], $arreglo_columna_c[$i], $arreglo_columna_d[$i], $arreglo_columna_e[$i], $arreglo_columna_f[$i], $idliga, 2, $fecha);
    }

  }
  echo $consulta;
  
?>