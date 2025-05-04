<?php  
  class Modelo_Fixture {
    private $conexion;

    function __construct(){
      require_once 'modelo_conexion.php';
      $this->conexion = new conexion();
      $this->conexion->conectar();
    }

    function Registrar_Excel($EQUIPO_A,$RESULTADOS,$EQUIPO_B,$IDLIGA,$ESTADO,$FECHA){
			$sql = "call PA_REGISTRAR_FIXTURES('$EQUIPO_A','$RESULTADOS','$EQUIPO_B',$IDLIGA,$ESTADO,'$FECHA')";
      
			if ($resultado = $this->conexion->conexion->query($sql)){
				$id_retornado = mysqli_insert_id($this->conexion->conexion);
				return 1;
			}
			else{
				return 0;
			}
			$this->conexion->Cerrar_Conexion();
		}
  }
?>