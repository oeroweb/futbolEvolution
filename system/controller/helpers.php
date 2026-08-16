<?php
require_once 'connection.php';

function mostrarError($errores, $campo)
{
	$alerta = '';
	if (isset($errores[$campo]) && !empty($campo)) {
		$alerta = "<div class='alerta alerta-error'>" . $errores[$campo] . "</div>";
	}
	return $alerta;
}

function borrarErrores()
{
	$borrado = false;

	if (isset($_SESSION['completado'])) {
		$_SESSION['completado'] = null;
		$borrado = true;
	}

	if (isset($_SESSION['fallo'])) {
		$_SESSION['fallo'] = null;
		$borrado = true;
	}

	if (isset($_SESSION['error_login'])) {
		$_SESSION['error_login'] = null;
		$borrado = true;
	}

	return $borrado;
}

function formatearFecha($fecha_string, $formato_salida = 'm/d/Y')
{
	$fecha = strtotime($fecha_string);

	if ($fecha === false) {
		return false;
	}
	return date($formato_salida, $fecha);
}

function formatearId($numero, $prefijo)
{
	$longitudTotal = 7; // 'P' + 6 dígitos numéricos	
	$numeroFormateado = sprintf("%0" . ($longitudTotal - 1) . "d", $numero);

	$idFormateado = "$prefijo" . $numeroFormateado;

	return $idFormateado;
}

function convertirNumeroAFecha($numero_dias, $formato = 'Y-m-d')
{
	// Crear un objeto DateTime con la fecha de inicio de Excel
	$fecha_base = new DateTime('1899-12-30');

	// Sumar el número de días al objeto DateTime
	// Usamos 'P' de 'Period' seguido del número de días y 'D' de 'Days'
	$intervalo = 'P' . $numero_dias . 'D';
	$fecha_base->add(new DateInterval($intervalo));

	// Devolver la fecha formateada
	return $fecha_base->format($formato);
}

function convertirNumeroAHora($valor_decimal, $formato = 'H:i:s')
{
	// Obtener el número total de segundos en un día
	$segundos_en_dia = 86400; // 24 * 60 * 60

	// Calcular los segundos totales a partir del valor decimal
	$segundos_a_sumar = round($valor_decimal * $segundos_en_dia);

	// Crear un objeto de fecha con la hora base (medianoche)
	$fecha_base = new DateTime('today');

	// Sumar los segundos calculados
	$fecha_base->add(new DateInterval('PT' . $segundos_a_sumar . 'S'));

	// Devolver la hora formateada
	return $fecha_base->format($formato);
}

// Funciones
function selectalldatos($conexion, $tabla)
{
	$sql = "SELECT * FROM $tabla";

	$usuario = mysqli_query($conexion, $sql);
	if ($usuario && mysqli_num_rows($usuario) >= 1) {
		$resultado = $usuario;
	} else {
		$resultado = '';
	}
	return $resultado;
}

function obtenerdatos($conexion, $tabla, $id)
{
	$sql = "SELECT * FROM $tabla where id = $id";

	$datos = mysqli_query($conexion, $sql);
	if ($datos && mysqli_num_rows($datos) >= 1) {
		$resultado = $datos;
	} else {
		$resultado = '';
	}
	return $resultado;
}

function obtenerdatosActivos($conexion, $tabla, $id)
{
	if (!empty($id)) {
		$sql = "SELECT * FROM $tabla where estado_id = 2 and liga_id = $id";
	} else {
		$sql = "SELECT * FROM $tabla where estado_id = 2";
	}

	$datos = mysqli_query($conexion, $sql);
	if ($datos && mysqli_num_rows($datos) >= 1) {
		$resultado = $datos;
	} else {
		$resultado = '';
	}
	return $resultado;
}


function obtenerdatosString($conexion, $tabla, $id)
{
	$sql = "SELECT * FROM $tabla where id = '$id'";

	$datos = mysqli_query($conexion, $sql);
	if ($datos && mysqli_num_rows($datos) >= 1) {
		$resultado = $datos;
	} else {
		$resultado = '';
	}
	return $resultado;
}

function selectDatosActivos($conexion, $tabla)
{
	$sql = "SELECT tb.*, es.nombre as nombreEstado FROM $tabla tb 
		INNER JOIN estados es on
		tb.estado_id = es.id
		WHERE estado_id > 1 and estado_id < 3";

	$datos = mysqli_query($conexion, $sql);
	if ($datos && mysqli_num_rows($datos) >= 1) {
		$resultado = $datos;
	} else {
		$resultado = '';
	}
	return $resultado;
}

function selectDatosEstado($conexion, $tabla, $estado)
{
	$sql = "SELECT * FROM $tabla where estado_id = $estado";

	$datos = mysqli_query($conexion, $sql);
	if ($datos && mysqli_num_rows($datos) >= 1) {
		$resultado = $datos;
	} else {
		$resultado = '';
	}
	return $resultado;
}

function obtenerTodosDatosActivos($conexion, $tabla)
{
	$sql = "SELECT * FROM $tabla where estado_id = 2";

	$datos = mysqli_query($conexion, $sql);
	if ($datos && mysqli_num_rows($datos) >= 1) {
		$resultado = $datos;
	} else {
		$resultado = '';
	}
	return $resultado;
}

function selectDatosNoEliminados($conexion, $tabla)
{
	$sql = "SELECT * FROM $tabla where estado_id < 3";

	$datos = mysqli_query($conexion, $sql);
	if ($datos && mysqli_num_rows($datos) >= 1) {
		$resultado = $datos;
	} else {
		$resultado = '';
	}
	return $resultado;
}

function todosUsuarios($conexion, $perfil)
{
	$sql = "SELECT * FROM usuarios where id = $perfil";

	$usuario = mysqli_query($conexion, $sql);
	if ($usuario && mysqli_num_rows($usuario) >= 1) {
		$resultado = $usuario;
	} else {
		$resultado = '';
	}
	return $resultado;
}

function listaPartidos($conexion, $estatoId)
{
	$sql = "SELECT en_nombre, en_direccion, imagen1, pd.genero, pd.fecha_partido, pd.hora, pd.costo, pd.estado_id, pd.id, pd.total_jugadores, pd.total_equipos
		FROM partidoslocales pl 
		INNER JOIN detallepartido pd on pl.id = pd.local_id		
		WHERE pl.estado_id = $estatoId";

	$datos = mysqli_query($conexion, $sql);
	if ($datos && mysqli_num_rows($datos) >= 1) {
		$resultado = $datos;
	} else {
		$resultado = '';
	}
	return $resultado;
}

function detallePartido($conexion, $id)
{
	$sql = "SELECT pd.id as IdDetalle, pd.*, pl.en_nombre as nombreLocal, pl.en_direccion, pl.imagen1, pl.imagen2, pl.imagen3, pl.imagen4, pl.imagen5, url_google, url_apple
		FROM detallepartido pd 
		INNER JOIN partidoslocales pl on pd.local_id = pl.id		
		WHERE pd.id = '$id'";
	// $sql = "SELECT pd.id as IdDetalle, fecha_partido, hora, genero, en_nivel, es_nivel, total_jugadores,  total_equipos, costo, en_descripcion, es_descripcion, beneficio1, beneficio2, beneficio3, beneficio4, beneficio5, cantidad_id, local_id, pd.estado_id, pd.fecha, pl.en_nombre as nombreLocal, pl.en_direccion, pl.imagen1, pl.imagen2, pl.imagen3, pl.imagen4, pl.imagen5, url_google, url_apple
	// FROM detallepartido pd 
	// INNER JOIN partidoslocales pl on pd.local_id = pl.id		
	// WHERE pd.id = '$id'";

	$datos = mysqli_query($conexion, $sql);
	if ($datos && mysqli_num_rows($datos) >= 1) {
		$resultado = $datos;
	} else {
		$resultado = '';
	}
	return $resultado;
}

function listaLigas($conexion, $estatoId)
{
	$sql = "SELECT lg.id, lg.en_nombre, lg.es_nombre, fecha_liga, en_descripcion, es_descripcion, imagen, local_id, lg.estado_id, lg.fecha, pl.en_nombre as nombreLocal, pl.en_direccion, pl.imagen1 FROM ligas lg INNER JOIN partidoslocales pl on lg.local_id = pl.id WHERE lg.estado_id = $estatoId";

	$datos = mysqli_query($conexion, $sql);
	if ($datos && mysqli_num_rows($datos) >= 1) {
		$resultado = $datos;
	} else {
		$resultado = '';
	}
	return $resultado;
}

function detalleLigas($conexion, $id)
{
	$sql = "SELECT lg.id, lg.en_nombre, lg.es_nombre, fecha_liga, en_descripcion, es_descripcion, lg.imagen, local_id, lg.estado_id, lg.fecha, pl.en_nombre as nombreLocal, pl.en_direccion, pl.imagen1 as imagenLocal
		FROM ligas lg 
		INNER JOIN partidoslocales pl on lg.local_id = pl.id 
		WHERE lg.id = $id";

	$datos = mysqli_query($conexion, $sql);
	if ($datos && mysqli_num_rows($datos) >= 1) {
		$resultado = $datos;
	} else {
		$resultado = '';
	}
	return $resultado;
}

function obtenerligatablaposiciones($conexion, $id)
{
	$sql = "SELECT lp.*, e.nombre, e.imagen FROM ligas_tb_posiciones lp INNER JOIN equipos e on lp.equipo_id = e.id where lp.estado_id = 2 and liga_id = '$id'";

	$datos = mysqli_query($conexion, $sql);
	if ($datos && mysqli_num_rows($datos) >= 1) {
		$resultado = $datos;
	} else {
		$resultado = '';
	}
	return $resultado;
}

function obtenerligatablafixture($conexion, $id)
{
	$sql = "SELECT lf.*, e.nombre as 'nombreequipoa', e.imagen as 'imagenequipoa', e.nombre
				FROM ligas_tb_fixture lf 
				INNER JOIN equipos e on lf.equipo_id_a = e.id
				where lf.estado_id = 2 and liga_id = '$id'";

	$datos = mysqli_query($conexion, $sql);
	if ($datos && mysqli_num_rows($datos) >= 1) {
		$resultado = $datos;
	} else {
		$resultado = '';
	}
	return $resultado;
}

function obtenerDatosPorCampo($conexion, $tabla, $campo, $valor)
{
	$sql = "SELECT * FROM $tabla WHERE $campo = '$valor'";

	$datos = mysqli_query($conexion, $sql);
	if ($datos && mysqli_num_rows($datos) >= 1) {
		$resultado = $datos;
	} else {
		$resultado = '';
	}
	return $resultado;
}

function obtenerListadoServicios($conexion)
{
	$sql = "SELECT reg.*, s.en_titulo as 'nombreServicio' 
				FROM registro_servicios reg 
				INNER JOIN servicios s on reg.servicio_id = s.id";

	$datos = mysqli_query($conexion, $sql);
	if ($datos && mysqli_num_rows($datos) >= 1) {
		$resultado = $datos;
	} else {
		$resultado = '';
	}
	return $resultado;
}

function obtenerGameRoster($conexion, $detalleid)
{
	$sql = "SELECT p.*, u.nombres, u.apellidos FROM partidos_jugados p  
			INNER join usuarios u on p.usuario_id = u.id
			WHERE u.estado_id = 2 and p.detallepartido_id = '$detalleid'";

	$datos = mysqli_query($conexion, $sql);
	if ($datos && mysqli_num_rows($datos) >= 1) {
		$resultado = $datos;
	} else {
		$resultado = '';
	}
	return $resultado;
}

function obtenerCantidadGameRoster($conexion, $detalleid)
{
	$sql = "SELECT COUNT(detallepartido_id) as Cantidad FROM partidos_jugados  
		WHERE detallepartido_id = '$detalleid'";

	$datos = mysqli_query($conexion, $sql);
	if ($datos && mysqli_num_rows($datos) >= 1) {
		$resultado = $datos;
	} else {
		$resultado = '';
	}
	return $resultado;
}


function obtenerListadoUsuaiosLibres($conexion)
{
	$sql = "SELECT u.* FROM usuarios u LEFT JOIN partidos_jugados pj ON u.id = pj.usuario_id WHERE pj.usuario_id IS NULL";

	$datos = mysqli_query($conexion, $sql);
	if ($datos && mysqli_num_rows($datos) >= 1) {
		$resultado = $datos;
	} else {
		$resultado = '';
	}
	return $resultado;
}

// ----------------

function selectFilterDatos($conexion, $tabla, $campo)
{
	$sql = "SELECT DISTINCT $campo FROM $tabla";

	$datos = mysqli_query($conexion, $sql);
	if ($datos && mysqli_num_rows($datos) >= 1) {
		$resultado = $datos;
	} else {
		$resultado = '';
	}
	return $resultado;
}

function selectalldatosBusqueda($conexion, $tabla, $sede, $campo, $inicio, $elementosPorPagina, $buscar)
{
	if (!empty($buscar)) {
		$sql = "SELECT * FROM $tabla where sede=$sede and nombre LIKE '%$buscar%' ORDER by $campo DESC LIMIT $inicio, $elementosPorPagina";
	} else {
		$sql = "SELECT * FROM $tabla where sede=$sede ORDER by $campo DESC LIMIT $inicio, $elementosPorPagina";
	}

	$datos = mysqli_query($conexion, $sql);
	if ($datos && mysqli_num_rows($datos) >= 1) {
		$resultado = $datos;
	} else {
		$resultado = '';
	}
	return $resultado;
}
