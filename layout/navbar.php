<?php 
  if(!isset($_SESSION)){
		session_start();			
	}
	require_once 'system/controller/helpers.php';
	// require_once 'system/controller/redireccion.php';
?>
<header class="header container-nowrap justify-center w100">
  <div class="center container-wrap space-between align-center">
    <div class="btn-menu hidden">
      <i class="fas fa-bars"></i>
    </div>
    <div class="box-logo">
      <a href="index.php">
        <img src="assets/img/logo-white.svg" class="img-logo" alt="Logo Futbol Evolution">
      </a>
    </div>
    <nav class="navbar">
      <div class="list-nav-link">
        <a href="index.php" class="nav-link"><span class="hidden"><img src="assets/img/ico/home.png" /> </span> Inicio</a>
        <a href="game.php" class="nav-link"><span class="hidden"><img src="assets/img/ico/partidos.png" /> </span>Partidos</a>
        <a href="league.php" class="nav-link"><span class="hidden"><img src="assets/img/ico/ligas.png" /> </span>Ligas / Torneos</a>
        <a href="services.php" class="nav-link"><span class="hidden"><img src="assets/img/ico/servicios.png" /> </span>Más servicios</a>
        <a href="sponsor.php" class="nav-link"><span class="hidden"><img src="assets/img/ico/sponsor.png" /> </span>Patrocinado</a>
      </div>
      <div class="list-nav-link">        
        <?php if(isset($_SESSION['usuario'])): ?>
          <a href="#" class="nav-link" id="btn-perfil">              
            <?php if($_SESSION['usuario']['genero'] === "M"): ?>
              <span><img src="assets/img/ico/user_hombre.svg" class="ico-perfil"></span>
            <?php else: ?>
              <span><img src="assets/img/ico/user_mujer.svg" class="ico-perfil"></span>
            <?php endif; ?>  
            <span class="hidden">Profile</span>            
          </a>
        <?php else: ?>
          <a href="#" class="nav-link" id="btn-login">
            <span><img src="assets/img/ico/user.png"></span>
            <span class="hidden">Login</span>
          </a>
        <?php endif; ?>                 
        <a href="system/models/cerrar.php" class="nav-link hidden">
          <span><img src="assets/img/ico/logout.png"></span>
          <span>Log Out</span>
        </a>
        <div class="sub-perfil hidden">
          <a href="#" class="nav-link" id="btn-perfil2">
            <img src="assets/img/ico/user12_black.png" class="ico-subperfil"><span>Profile</span>
          </a>
          <a href="system/models/cerrar.php" class="nav-link">
            <img src="assets/img/ico/logout_black.png" class="ico-subperfil"><span>Log Out</span>
          </a>
        </div>
      </div>
    </nav>

  </div>
</header>