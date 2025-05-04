<?php
session_start();
require "connection.php";
$email = "";
$name = "";
$errors = array();

//if user signup button
if (isset($_POST['signup'])) {
  $_SESSION['info'] = "";
  $name = mysqli_real_escape_string($con, $_POST['name']);
  $email = mysqli_real_escape_string($con, $_POST['email']);
  $password = mysqli_real_escape_string($con, $_POST['password']);
  $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
  if ($password !== $cpassword) {
    $errors['password'] = "Las contraseñas no coinciden!";
  }
  $email_check = "SELECT * FROM usertable WHERE email = '$email'";
  $res = mysqli_query($con, $email_check);
  if (mysqli_num_rows($res) > 0) {
    $errors['email'] = "El correo electrónico que ha ingresado ya existe!";
  }
  if (count($errors) === 0) {
    $code = rand(999999, 111111);
    $status = "notverified";
    $insert_data = "INSERT INTO usertable (name, email, password, code, status)
                        values('$name', '$email', '$password', '$code', '$status')";
    $data_check = mysqli_query($con, $insert_data);

    if ($data_check) {
      header('location: home.php');
      $info = "Su cuenta fue registrada con exito.";
      $_SESSION['info'] = $info;
    } else {
      $errors['db-error'] = "Error al insertar datos!";
    }
  }
}
//if user click verification code submit button
if (isset($_POST['check'])) {
  $_SESSION['info'] = "";
  $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
  $check_code = "SELECT * FROM usertable WHERE code = $otp_code";
  $code_res = mysqli_query($con, $check_code);
  if (mysqli_num_rows($code_res) > 0) {
    $fetch_data = mysqli_fetch_assoc($code_res);
    $fetch_code = $fetch_data['code'];
    $email = $fetch_data['email'];
    $code = 0;
    $status = 'verified';
    $update_otp = "UPDATE usertable SET code = $code, status = '$status' WHERE code = $fetch_code";
    $update_res = mysqli_query($con, $update_otp);
    if ($update_res) {
      $_SESSION['name'] = $name;
      $_SESSION['email'] = $email;
      $_SESSION['info'] = "Su codigo se valido correctamente, inicia sesion nuevamente.";
      header('location: home.php');
      exit();
    } else {
      $errors['otp-error'] = "Error al actualizar el código!";
    }
  } else {
    $errors['otp-error'] = "Ha introducido un código incorrecto!";
  }
}

//if user click login button
// $password_segura = password_hash($password, PASSWORD_BCRYPT,['cost' =>4]);
if (isset($_POST['login'])) {
  $email = mysqli_real_escape_string($con, $_POST['email']);
  $password = mysqli_real_escape_string($con, $_POST['password']);  
  
  $check_email = "SELECT * FROM usuarios WHERE email = '$email'";
  $res = mysqli_query($con, $check_email);
  
  if (mysqli_num_rows($res) > 0) {
    $usuario = mysqli_fetch_assoc($res);
    if($usuario['rol'] == "admin"){
      $verify = password_verify($password, $usuario['clave']);
      
      // if ($verify) {
      if($password == $usuario['clave']){
        $_SESSION['email'] = $email;
        $_SESSION['usuario'] = $usuario;
        header('location: home.php');
      } else {
        $errors['email'] = "Contraseña incorrecta!";
      }
    } else {
      $errors['rol'] = "No tienes los permisos necesarios!";
    } 
  } else {
    $errors['email'] = "Al parecer aún no estas registrado! Haga clic en el enlace inferior para registrarse!";
  }
}

//if user click continue button in forgot password form
if (isset($_POST['check-email'])) {
  $email = mysqli_real_escape_string($con, $_POST['email']);
  $check_email = "SELECT * FROM usertable WHERE email='$email'";
  $run_sql = mysqli_query($con, $check_email);
  if (mysqli_num_rows($run_sql) > 0) {
    $code = rand(999999, 111111);
    $insert_code = "UPDATE usertable SET code = $code WHERE email = '$email'";
    $run_query =  mysqli_query($con, $insert_code);
    if ($run_query) {
      header('location: reset-code.php');
      exit();
    } else {
      $errors['db-error'] = "Algo salió mal!";
    }
  } else {
    $errors['email'] = "Esta dirección de correo electrónico no existe!";
  }
}

//if user click check reset otp button
if (isset($_POST['check-reset-otp'])) {
  $_SESSION['info'] = "";
  $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
  $check_code = "SELECT * FROM usertable WHERE code = $otp_code";
  $code_res = mysqli_query($con, $check_code);
  if (mysqli_num_rows($code_res) > 0) {
    $fetch_data = mysqli_fetch_assoc($code_res);
    $email = $fetch_data['email'];
    $_SESSION['email'] = $email;
    $info = "Cree una nueva contraseña que no use en ningún otro sitio.";
    $_SESSION['info'] = $info;
    header('location: new-password.php');
    exit();
  } else {
    $errors['otp-error'] = "Ha introducido un código incorrecto!";
  }
}

//if user click change password button
if (isset($_POST['change-password'])) {
  $_SESSION['info'] = "";
  $password = mysqli_real_escape_string($con, $_POST['password']);
  $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
  if ($password !== $cpassword) {
    $errors['password'] = "Las contraseñas no coinciden!";
  } else {
    $code = 0;
    $email = $_SESSION['email']; //getting this email using session
    $encpass = password_hash($password, PASSWORD_BCRYPT);
    $update_pass = "UPDATE usertable SET code = $code, password = '$encpass' WHERE email = '$email'";
    $run_query = mysqli_query($con, $update_pass);
    if ($run_query) {
      $info = "Su contraseña cambió. Ahora puedes iniciar sesión con tu nueva contraseña.";
      $_SESSION['info'] = $info;
      header('Location: password-changed.php');
    } else {
      $errors['db-error'] = "Error al cambiar su contraseña!";
    }
  }
}

//if login now button click
if (isset($_POST['login-now'])) {
  header('Location: index.php');
}
