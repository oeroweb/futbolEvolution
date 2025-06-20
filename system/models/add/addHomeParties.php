<?php  
  require_once '../../controller/connection.php';

  $columna_a = htmlspecialchars($_POST['columna_a'], ENT_QUOTES, 'UTF-8');
  $columna_b = htmlspecialchars($_POST['columna_b'], ENT_QUOTES, 'UTF-8');
  $columna_c = htmlspecialchars($_POST['columna_c'], ENT_QUOTES, 'UTF-8');
  $columna_d = htmlspecialchars($_POST['columna_d'], ENT_QUOTES, 'UTF-8');
  $columna_e = htmlspecialchars($_POST['columna_e'], ENT_QUOTES, 'UTF-8');
  $columna_f = htmlspecialchars($_POST['columna_f'], ENT_QUOTES, 'UTF-8');
  $fecha = DATE('Y-m-d');

  $arreglo_columna_a = explode(",", $columna_a);
  $arreglo_columna_b = explode(",", $columna_b);
  $arreglo_columna_c = explode(",", $columna_c);
  $arreglo_columna_d = explode(",", $columna_d);
  $arreglo_columna_e = explode(",", $columna_e);
  $arreglo_columna_f = explode(",", $columna_f);

  $sql = "UPDATE `homebarrapartidos` SET estado_id= 1";
  $resultado = mysqli_query($con, $sql);

  if ($resultado) {
    $total = count($arreglo_columna_a);
    if (
      $total === count($arreglo_columna_b) &&
      $total === count($arreglo_columna_c) &&
      $total === count($arreglo_columna_d) &&
      $total === count($arreglo_columna_e) &&
      $total === count($arreglo_columna_f)
    ) {
      $insertados = 0;

      for ($i = 0; $i < $total; $i++) {       
        $a = mysqli_real_escape_string($con, trim($arreglo_columna_a[$i]));
        $b = mysqli_real_escape_string($con, trim($arreglo_columna_b[$i]));
        $c = mysqli_real_escape_string($con, trim($arreglo_columna_c[$i]));
        $d = mysqli_real_escape_string($con, trim($arreglo_columna_d[$i]));
        $e = mysqli_real_escape_string($con, trim($arreglo_columna_e[$i]));
        $f = mysqli_real_escape_string($con, trim($arreglo_columna_f[$i]));

        $sql2 = "INSERT INTO `homebarrapartidos`(`equipo_id_a`, `en_titulo`, `en_descripcion`, `resultados`, `en_subtitulo`, `equipo_id_b`, `estado_id`, `fecha`) 
            VALUES ('$a', '$b', '$c', '$d', '$e', '$f', 2, CURDATE());";
        $ingreso = mysqli_query($con, $sql2);

        if ($ingreso) {
          $insertados++;
        }
      }

      if (mysqli_affected_rows($db) > 0) {
        echo json_encode(array('error' => false));
      } else {
        echo json_encode(array('error' => true));
      }
    }
  }
