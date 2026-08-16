<?php 
  if(isset($_POST)){
		session_start();
		require_once '../../controller/connection.php';
		
		$idDetalle= $_POST['idDetalle'];		
    $items1 = ($_POST['idequipo']);
    $items2 = ($_POST['resultado']);
    $fecha = DATE('Y-m-d');

    while(true){
      $item1 = current($items1);
      $item2 = current($items2);

      $equipo  = (($item1 !== false) ? $item1 : '');
      $goles  = (($item2 !== false) ? $item2 : '');

      $valores = '("'.$idDetalle. '","' .$equipo. '",' .$goles. ',' . 2 . ',"'. $fecha .'"),';
      $valores_final = substr($valores, 0, -1);
      
      $sql="INSERT INTO `detallepartido_equipos`( detallepartido_id, equipo_id, cantidad_goles, estado_id, fecha) VALUES $valores_final";
      $resultado = mysqli_query($con,$sql);      
      
      $item1 = next($items1);
      $item2 = next($items2);

      if($item1  === false && $item2  === false ) break;

      if($resultado){
        $_SESSION['completado'] = "Actualizado forma exitosa";	
        header("Location: ../../league.php");
      } else{
        $_SESSION['fallo'] = "Hubo un error; por favor volver a intentar";
        header("Location: ../../league.php");
      }		
    }
  } else {
    header("Location: ../../league.php");
  }
	 		
?>