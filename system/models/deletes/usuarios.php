<?php 
  if(isset($_POST)){
    require_once '../../controller/connection.php';
    $id = $_POST['id'];
    
    $sql = "DELETE FROM usuarios WHERE id = $id";
    $resultado = mysqli_query($con, $sql);
    
    if($resultado){
      echo json_encode(array('error' => false));
    }else{
      echo json_encode(array('error' => true));
    }

  }
?>