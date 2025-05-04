<?php  
  class Modelo_Excel {
    private $conexion;

    function __construct(){
      require_once 'modelo_conexion.php';
      $this->conexion = new conexion();
      $this->conexion->conectar();
    }

    function Registrar_Excel($EQUIPO,$PJ,$G,$E,$P,$GF,$GC,$DG,$PTS,$IDLIGA,$ESTADO,$FECHA){
			$sql = "call PA_REGISTRAR_POSICIONES('$EQUIPO',$PJ,$G,$E,$P,$GF,$GC,$DG,$PTS,$IDLIGA,$ESTADO,'$FECHA')";
			// $sql = "call PA_REGISTRAR_POSICIONES('$EQUIPO','$PJ','$G','$E','$P','$GF','$GC','$DG','$PTS','$IDLIGA','$ESTADO','$FECHA')";
      
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