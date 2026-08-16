<?php

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
    $total = count($array_equipo);
    if (
      $total === count($array_pj) &&
      $total === count($array_g) &&
      $total === count($array_e) &&
      $total === count($array_p) &&
      $total === count($array_gf) &&
      $total === count($array_gc) &&
      $total === count($array_dg) &&
      $total === count($array_pts)
    ) {
      $insertados = 0;

      for ($i = 0; $i < $total; $i++) {       
        $a = mysqli_real_escape_string($con, trim($array_equipo[$i]));
        $b = mysqli_real_escape_string($con, trim($array_pj[$i]));
        $c = mysqli_real_escape_string($con, trim($array_g[$i]));
        $d = mysqli_real_escape_string($con, trim($array_e[$i]));
        $e = mysqli_real_escape_string($con, trim($array_p[$i]));
        $f = mysqli_real_escape_string($con, trim($array_gf[$i]));
        $g = mysqli_real_escape_string($con, trim($array_gc[$i]));
        $h = mysqli_real_escape_string($con, trim($array_dg[$i]));
        $j = mysqli_real_escape_string($con, trim($array_pts[$i]));

        $sql2 = "INSERT INTO `ligas_tb_posiciones`(`equipo_id`, `pj`, `g`, `e`, `p`, `gf`, `gc`, `dg`, `pts`, `liga_id`, `estado_id`, `fecha`) 
            VALUES ('$a', '$b', '$c', '$d', '$e', '$f', '$g','$h','$j', $idLiga, 2, CURDATE());";
        $ingreso = mysqli_query($con, $sql2);

        if ($ingreso) {
          $insertados++;
        }
      }

      if (mysqli_affected_rows($con) > 0) {
        echo json_encode(array('error' => false));
      } else {
        echo json_encode(array('error' => true));
      }
    }
  }
  
?>