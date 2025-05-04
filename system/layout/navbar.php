<?php
  if(!isset($_SESSION)){
    session_start();
  }
	require_once 'controller/redireccion.php';
	require_once 'controller/helpers.php';
?>
<nav class="navbar">
  <?php
    $perfiles = todosUsuarios($con, $_SESSION['usuario']['id']);
    if (!empty($perfiles) && mysqli_num_rows($perfiles) >= 1):
      while ($perfil = mysqli_fetch_assoc($perfiles)):
  ?>	
  <div class="navbar-menu" id="">
    <a class="navbar-brand" href="home.php">Futbol Evolution</a>
  </div>
  <div class="navbar-section">
    <?php
      if (isset($_SESSION['usuario'])) {
    ?>
      <div class="name-section">
        Hola, <?php echo $_SESSION['usuario']['nombres']?> 
      </div>
    <?php
      }
    ?>
    <a class="btn" href="controller/cerrar.php">Salir <img src="assets/ico/logout_black.png" class="icon-navbar" alt="icono"></a>
  </div>
  <?php
      endwhile;
    endif;
  ?>
</nav>
<!-- https://www.w3schools.com/howto/tryit.asp?filename=tryhow_js_accordion -->