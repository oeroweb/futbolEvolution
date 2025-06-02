<?php

  require '../modelo_excel.php';
  $ME = new Modelo_Excel();
  require_once '../../controller/connection.php';

  $equipo = htmlspecialchars($_POST['equipo'],ENT_QUOTES,'UTF-8');
  $pj = htmlspecialchars($_POST['pj'],ENT_QUOTES,'UTF-8');
  $g = htmlspecialchars($_POST['g'],ENT_QUOTES,'UTF-8');
  $e = htmlspecialchars($_POST['e'],ENT_QUOTES,'UTF-8');
  $p = htmlspecialchars($_POST['p'],ENT_QUOTES,'UTF-8');
  $gf = htmlspecialchars($_POST['gf'],ENT_QUOTES,'UTF-8');
  $gc = htmlspecialchars($_POST['gc'],ENT_QUOTES,'UTF-8');
  $dg = htmlspecialchars($_POST['dg'],ENT_QUOTES,'UTF-8');
  $pts = htmlspecialchars($_POST['pts'],ENT_QUOTES,'UTF-8');
  $idLiga = $_POST['idLiga'];
  $fecha = DATE('Y-m-d');

  $array_equipo = explode(",", $equipo);
  $array_pj = explode(",", $pj);
  $array_g = explode(",", $g);
  $array_e = explode(",", $e);
  $array_p = explode(",", $p);
  $array_gf = explode(",", $gf);
  $array_gc = explode(",", $gc);
  $array_dg = explode(",", $dg);
  $array_pts = explode(",", $pts);
  
  $sql="UPDATE `ligas_tb_posiciones` SET estado_id= 1 where liga_id='$idLiga'";
  $resultado = mysqli_query($con, $sql);

  if($resultado){
    for($i = 0; $i < count($array_equipo); $i++){
      $consulta = $ME -> Registrar_Excel($array_equipo[$i], $array_pj[$i], $array_g[$i], $array_e[$i], $array_p[$i], $array_gf[$i], $array_gc[$i], $array_dg[$i], $array_pts[$i], $idLiga, 2, $fecha);
    }
  }
  echo $consulta;
  
?>