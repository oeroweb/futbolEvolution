<?php

  require_once '../../controller/connection.php';

  $equipo_a = htmlspecialchars($_POST['equipo_a'],ENT_QUOTES,'UTF-8');
  $resultados = htmlspecialchars($_POST['resultados'],ENT_QUOTES,'UTF-8');
  $subtitulo = htmlspecialchars($_POST['subtitulo'],ENT_QUOTES,'UTF-8');
  $equipo_b = htmlspecialchars($_POST['equipo_b'],ENT_QUOTES,'UTF-8');
  $idLiga = $_POST['idLiga'];
  $fecha = DATE('Y-m-d');

  $arreglo_columna_a = explode(",", $equipo_a);
  $arreglo_columna_b = explode(",", $resultados);
  $arreglo_columna_c = explode(",", $subtitulo);
  $arreglo_columna_d = explode(",", $equipo_b);
  
  $sql="UPDATE `ligas_tb_fixture` SET estado_id= 1 where liga_id='$idLiga'";
  $resultado = mysqli_query($con, $sql);
  
  if ($resultado) { }
    $total = count($arreglo_columna_a);
    if (
      $total === count($arreglo_columna_b) &&
      $total === count($arreglo_columna_c) &&
      $total === count($arreglo_columna_d)     
    ) {
      $insertados = 0;

      for ($i = 0; $i < $total; $i++) {       
        $a = mysqli_real_escape_string($con, trim($arreglo_columna_a[$i]));
        $b = mysqli_real_escape_string($con, trim($arreglo_columna_b[$i]));
        $c = mysqli_real_escape_string($con, trim($arreglo_columna_c[$i]));
        $d = mysqli_real_escape_string($con, trim($arreglo_columna_d[$i]));

        $sql2 = "INSERT INTO ligas_tb_fixture (equipo_id_a, resultados, subtitulo, equipo_id_b, liga_id, estado_id, fecha) 
            VALUES ('$a', '$b', '$c', '$d', $idLiga, 2, CURDATE());";
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
 
  
?>