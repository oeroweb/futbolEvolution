<?php 

	if(isset($_POST)){
		require_once 'connection.php';
		if(!isset($_SESSION)){
			session_start();			
		}
		if(isset($_SESSION['error_login'])){
			session_unset($_SESSION['error_login']);
		}
		
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
		
		$sql ="SELECT * FROM usuarios WHERE email = '$email'";
		$login = mysqli_query($con, $sql);

		if($login && mysqli_num_rows($login) == 1){
			$usuario = mysqli_fetch_assoc($login);
			$verify = password_verify($password, $usuario['clave']);      
			// $verify = password_verify($password, $usuario['clave']);      
      
			if($password == $usuario['clave']){       
				$_SESSION['usuario'] = $usuario;				
				header('Location:../../index.php');
			}else{				
				$_SESSION['error_login'] = "Contraseña incorrecta!!";
				header('Location:../../index.php');    
			}
		}else{
			$_SESSION['error_login'] = "El correo ingresado no existe!";
			header('Location:../../index.php');
		}	
	}
?>
