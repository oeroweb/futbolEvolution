<?php  
  class Modelo_Excel {
    private $conexion;

    function __construct(){
      require_once 'modelo_conexion.php';
      $this->conexion = new conexion();
      $this->conexion->conectar();
    }

    function Registrar_Excel($COLUMNA_A,$COLUMNA_B,$COLUMNA_C,$COLUMNA_D,$COLUMNA_E,$COLUMNA_F,$IDLIGA, $ESTADO,$FECHA){
			$sql = "call PA_REGISTRAR_LIGAS_BARRA_PARTIDOS('$COLUMNA_A','$COLUMNA_B','$COLUMNA_C','$COLUMNA_D','$COLUMNA_E','$COLUMNA_F', $IDLIGA, $ESTADO,'$FECHA')";
     
			if ($resultado = $this->conexion->conexion->query($sql)){
				$id_retornado = mysqli_insert_id($this->conexion->conexion);
				return 1;
			} else{
				return 0;
			}
			$this->conexion->Cerrar_Conexion();
		}
  }
?>