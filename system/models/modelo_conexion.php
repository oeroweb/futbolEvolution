<?php
	class conexion{
		private $servidor;
		private $usuario;
		private $contrasena;
		private $basedatos;
		public $conexion;
		// public function __construct(){
		//   $this->servidor = "127.0.0.1";
		// 	$this->usuario = "u781511255_evoluser";
		// 	$this->contrasena = "yTu?SkI3jG>";
		// 	$this->basedatos = "u781511255_evoluciones";
		// }
		public function __construct(){
		  $this->servidor = "localhost";
			$this->usuario = "root";
			$this->contrasena = "";
			$this->basedatos = "dbfutbolevolution";
		}
		function conectar(){
			$this->conexion = new mysqli($this->servidor,$this->usuario,$this->contrasena,$this->basedatos);
			$this->conexion->set_charset("utf8");
		}
		function cerrar(){
			$this->conexion->close();	
		}
	}
?> 
