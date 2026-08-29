<?php require_once "controller/controllerUserData.php"; ?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="Keywords" content="IEI Stella Maris, Inicial Stella Maris, Stella Maris, Institución Stella Maris, sieweb Stella Maris, Sistema de Gestión">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Institución Educativa Inicial Stella Maris, Calle Grito de Huaura 308 La Perla - Peru, Telefono (01) 4206833 / 996 389 391 - Correo ieinavalstellamaris@ieism.edu.pe">
  <meta name="author" content="Oscar Rojas">
  <title>Admin Futbol Evolution</title>
  <link href="../assets/img/logo2.ico" rel="shortcut icon" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <style>
    @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');

    html,
    body {
      background: #6665ee;
      font-family: 'Poppins', sans-serif;
    }

    ::selection {
      color: #fff;
      background: #6665ee;
    }

    .container {
      min-height: 100vh;
      align-items: center;
      justify-content: center;
    }

    .container .form {
      width: 360px;
      margin: 0 auto;
      background: #fff;
      padding: 30px 35px;
      border-radius: 5px;
      box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }

    .container .form form .form-control {
      height: 40px;
      font-size: 15px;
    }

    .container .form form .forget-pass {
      margin: -15px 0 15px 0;
    }

    .container .form form .forget-pass a {
      font-size: 15px;
    }

    .container .form form .button {
      background: #6665ee;
      color: #fff;
      font-size: 17px;
      font-weight: 500;
      transition: all 0.3s ease;
    }

    .container .form form .button:hover {
      background: #5757d1;
    }

    .container .form form .link {
      padding: 5px 0;
    }

    .container .form form .link a {
      color: #6665ee;
    }

    .container .login-form form p {
      font-size: 14px;
    }

    .container .row .alert {
      font-size: 14px;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="row">
      <div class="form login-form">
        <form action="index.php" method="POST" autocomplete="false">
          <h2 class="text-center">ADMINISTRACIÓN <br> Futbol Evolution</h2>
          <p class="text-center">Ingresa tu correo y contraseña</p>
          <?php
          if (isset($_SESSION['info'])) {
          ?>
            <div class="alert alert-success text-center">
              <?php echo $_SESSION['info']; ?>
            </div>
          <?php
          }
          ?>
          <?php
          if (count($errors) > 0) {
          ?>
            <div class="alert alert-danger text-center">
              <?php
              foreach ($errors as $showerror) {
                echo $showerror;
              }
              ?>
            </div>
          <?php
          }
          ?>
          <div class="form-group">
            <input class="form-control" type="email" name="email" placeholder="Ingresa tu correo" required value="<?php echo $email ?>">
          </div>
          <div class="form-group">
            <input class="form-control" type="password" name="password" placeholder="Ingresa tu contraseña" required>
          </div>
          <div class="form-group">
            <input class="form-control button" type="submit" name="login" value="Ingresar">
          </div>
        </form>
      </div>
    </div>
  </div>
  <?php include('layout/footer.php'); ?>	
</body>

</html>