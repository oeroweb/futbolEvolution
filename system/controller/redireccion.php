<?php 
  // iniciar la sesion
  if(!isset($_SESSION)){
    session_start();
  }
  if(!isset($_SESSION['usuario'])){
    header('Location:index.php');
  }
  
  // if(isset($_POST)){	
  //   $email = $_SESSION['email'];
  //   $password = $_SESSION['password'];
  //   if($email != false && $password != false){
  //     $sql = "SELECT * FROM usuarios WHERE email = '$email'";
  //     $run_Sql = mysqli_query($con, $sql);
  //     if($run_Sql){
  //         $fetch_info = mysqli_fetch_assoc($run_Sql);       
  //     }
  //   }else{
  //     header('Location: index.php');
  //   } 

  // }
?>