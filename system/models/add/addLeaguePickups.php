<?php

require_once '../../controller/connection.php';

$columna_a = htmlspecialchars($_POST['columna_a'], ENT_QUOTES, 'UTF-8');
$columna_b = htmlspecialchars($_POST['columna_b'], ENT_QUOTES, 'UTF-8');
$columna_c = htmlspecialchars($_POST['columna_c'], ENT_QUOTES, 'UTF-8');
$columna_d = htmlspecialchars($_POST['columna_d'], ENT_QUOTES, 'UTF-8');
$columna_e = htmlspecialchars($_POST['columna_e'], ENT_QUOTES, 'UTF-8');
$columna_f = htmlspecialchars($_POST['columna_f'], ENT_QUOTES, 'UTF-8');
$columna_g = htmlspecialchars($_POST['columna_g'], ENT_QUOTES, 'UTF-8');
$columna_h = htmlspecialchars($_POST['columna_h'], ENT_QUOTES, 'UTF-8');
$columna_i = htmlspecialchars($_POST['columna_i'], ENT_QUOTES, 'UTF-8');
$columna_j = htmlspecialchars($_POST['columna_j'], ENT_QUOTES, 'UTF-8');
$columna_k = htmlspecialchars($_POST['columna_k'], ENT_QUOTES, 'UTF-8');
$columna_l = htmlspecialchars($_POST['columna_l'], ENT_QUOTES, 'UTF-8');
$columna_m = htmlspecialchars($_POST['columna_m'], ENT_QUOTES, 'UTF-8');
$columna_n = htmlspecialchars($_POST['columna_n'], ENT_QUOTES, 'UTF-8');
$fecha = DATE('Y-m-d');

$arreglo_columna_a = explode(",", $columna_a);
$arreglo_columna_b = explode(",", $columna_b);
$arreglo_columna_c = explode(",", $columna_c);
$arreglo_columna_d = explode(",", $columna_d);
$arreglo_columna_e = explode(",", $columna_e);
$arreglo_columna_f = explode(",", $columna_f);
$arreglo_columna_g = explode(",", $columna_g);
$arreglo_columna_h = explode(",", $columna_h);
$arreglo_columna_i = explode(",", $columna_i);
$arreglo_columna_j = explode(",", $columna_j);
$arreglo_columna_k = explode(",", $columna_k);
$arreglo_columna_l = explode(",", $columna_l);
$arreglo_columna_m = explode(",", $columna_m);
$arreglo_columna_n = explode(",", $columna_n);

$total = count($arreglo_columna_a);
if (
  $total === count($arreglo_columna_b) &&
  $total === count($arreglo_columna_c) &&
  $total === count($arreglo_columna_d) &&
  $total === count($arreglo_columna_e) &&
  $total === count($arreglo_columna_f) &&
  $total === count($arreglo_columna_g) &&
  $total === count($arreglo_columna_h) &&
  $total === count($arreglo_columna_i) &&
  $total === count($arreglo_columna_j) &&
  $total === count($arreglo_columna_k) &&
  $total === count($arreglo_columna_l) &&
  $total === count($arreglo_columna_m) &&
  $total === count($arreglo_columna_n)
) {
  $insertados = 0;

  for ($i = 0; $i < $total; $i++) {
    $a = mysqli_real_escape_string($con, trim($arreglo_columna_a[$i]));
    $b = mysqli_real_escape_string($con, trim($arreglo_columna_b[$i]));
    $c = mysqli_real_escape_string($con, trim($arreglo_columna_c[$i]));
    $d = mysqli_real_escape_string($con, trim($arreglo_columna_d[$i]));
    $e = mysqli_real_escape_string($con, trim($arreglo_columna_e[$i]));
    $f = mysqli_real_escape_string($con, trim($arreglo_columna_f[$i]));
    $g = mysqli_real_escape_string($con, trim($arreglo_columna_g[$i]));
    $h = mysqli_real_escape_string($con, trim($arreglo_columna_h[$i]));
    $i = mysqli_real_escape_string($con, trim($arreglo_columna_i[$i]));
    $j = mysqli_real_escape_string($con, trim($arreglo_columna_j[$i]));
    $k = mysqli_real_escape_string($con, trim($arreglo_columna_k[$i]));
    $l = mysqli_real_escape_string($con, trim($arreglo_columna_l[$i]));
    $m = mysqli_real_escape_string($con, trim($arreglo_columna_m[$i]));
    $n = mysqli_real_escape_string($con, trim($arreglo_columna_n[$i]));

    $sql = "INSERT INTO `detallepartido`(id, local_id, fecha_partido, genero, hora, costo, total_jugadores, total_equipos, en_nivel, beneficio1, beneficio2, beneficio3, beneficio4, beneficio5, estado_id, fecha) VALUES ('$a', '$b', '$c', '$d', '$e', '$f', '$g', '$h','$i', 2, 2, 2, 2, 2, 2, CURDATE());";
    $ingreso = mysqli_query($con, $sql);
    var_dump($sql);
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
