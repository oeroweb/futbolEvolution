<?php 

	function mostrarError($errores, $campo){
		$alerta = '';
		if(isset($errores[$campo]) && !empty($campo)){
			$alerta = "<div class='alerta alerta-error'>" .$errores[$campo]."</div>";			
		}
		return $alerta;
	}

	function borrarErrores(){
		$borrado = false;		

		if(isset($_SESSION['completado'])){
			$_SESSION['completado'] = null;
			$borrado = true;
		}

		if(isset($_SESSION['fallo'])){
			$_SESSION['fallo'] = null;
			$borrado = true;
		}	

		return $borrado;
	}
	
  // GENERANDO TOKEN
	function generandoTokenClave($length = 20) {
    return substr(str_shuffle(str_repeat($x='0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklymopkz', ceil($length/strlen($x)) )),1,$length);
	}

  // obtener todos
	function selectalldatos($conexion, $tabla){
		$sql = "SELECT * FROM $tabla";

		$datos = mysqli_query($conexion, $sql);
		if($datos && mysqli_num_rows($datos) >=1){
			$resultado = $datos;
		}else{
			$resultado = '';
		}
		return $resultado;
	}
	
	function obtenerdatos($conexion, $tabla, $id){
		$sql = "SELECT * FROM $tabla where id = $id";

		$datos = mysqli_query($conexion, $sql);
		if($datos && mysqli_num_rows($datos) >=1){
			$resultado = $datos;
		}else{
			$resultado = '';
		}
		return $resultado;
	}

	function obtenerTodosDatosActivos($conexion, $tabla){
		$sql = "SELECT * FROM $tabla where estado_id = 2";

		$datos = mysqli_query($conexion, $sql);
		if($datos && mysqli_num_rows($datos) >=1){
			$resultado = $datos;
		}else{
			$resultado = '';
		}
		return $resultado;
	}

	function obtenerdatoactivos($conexion, $tabla, $id){
		$sql = "SELECT * FROM $tabla where id = $id and estado_id = 1";

		$datos = mysqli_query($conexion, $sql);
		if($datos && mysqli_num_rows($datos) >=1){
			$resultado = $datos;
		}else{
			$resultado = '';
		}
		return $resultado;
	}
	

	
?>