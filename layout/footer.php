<!-- <span class="ir-arriba" title="Subir"><i class="fas fa-arrow-up"></i></span> -->
<footer class="footer">
  <div class="container-wrap center">
    <div class="container-wrap w100 space-between">
      <div class="box-logo">
        <img src="assets/img/logo.png" alt="logo de futbol evolution">
      </div>
      <div class="box-container-footer flex space-around">
        <div class="item-footer" >
          <h2 class="title">Team</h2>
          <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Minus autem nobis facere repellat odit recusandae, aliquid dolor officia voluptatem inventore.</p>
        </div>
        <div class="item-footer" >
          <h2 class="title">Contact</h2>
          <div class="list">
            <a href="tel:+999999999"><img src="assets/img/ico/phone.png" class="icon-redes" alt="icono telefono"> +51 999 999 999</a>
            <a href="mailto:contact@futbolevolution.com"><img src="assets/img/ico/mail.png" class="icon-redes" alt="icono correo">contact@futbolevolution.com</a>
            <a href="http:/futbolevolution.com"><img src="assets/img/ico/planet.png" class="icon-redes" alt="icono mundo">http://futbolevolution.com</a>
          </div>
        </div>
        <div class="item-footer">
          <h2 class="title">Follow us</h2>
          <span class="flex space-between"> 
            <a href="#"><img src="assets/img/ico/facebook.png" class="icon-redes" alt="icono facebook"></a>
            <a href="#"><img src="assets/img/ico/instagram.png" class="icon-redes" alt="icono instagram"></a>
            <a href="#"><img src="assets/img/ico/youtube.png" class="icon-redes" alt="icono YouTube"></a>
            <a href="#"><img src="assets/img/ico/whatsapp.png" class="icon-redes" alt="icono WhatsApp"></a>           
          </span>
        </div>
      </div>
    </div>
    <hr>
    <div class="footer-bar flex space-between">
      <p>&copy <?php echo date("Y"); ?> Company Futbol Evolution. All rights reserved </p>
      <div>
        <a href="documentos/Politica-de-Privacidad.pdf" target="_blank">Privacy & Policy</a>
        <a href="documentos/Politica-de-Privacidad.pdf" target="_blank">Terms & Condition</a>
      </div>
    </div>
  </div>
</footer>

<div class="modal hidden" id="modal">
  <div class="box-modal">
    <img src="assets/img/logo.png" alt="logo">
    <hr>
    <h2 class="title">¡Es hora de jugar! Ingresa y encuentra tu próximo partido!</h2>
    <?php if (isset($_SESSION['completado'])): ?>
				<div class="alerta-exito">
					<?= $_SESSION['completado'] ?>
				</div>
			<?php elseif (isset($_SESSION['error_login'])): ?>
				<div class="alerta-error">
					<?= $_SESSION['error_login'] ?>
				</div>
			<?php endif; ?>
    <form action="system/controller/login.php" class="flex-col form-login" method="post" id="form-login">
      <div class="box-input inputEmail">
        <input type="text" name="email" class="input w100" id="email" placeholder="Email" onkeydown="" required>
        <span class="erroremail" id="erroremail"></span>
      </div>	
      <div class="box-input inputBox">
        <input type="password" name="password" id="password" class="input w100" placeholder="Password" required>
        <div class="toggle toggle-pass" onclick="showHide()">
          <span id="span3"><i class="far fa-eye-slash"></i></span>
          <span id="span4" class="hidden"><i class="far fa-eye"></i> </span>
        </div>
        <span class="errorpassword" id="errorpassword"></span>
      </div>
      <div class="flex justify-start mg-bt40">
        <input type="checkbox" name="" id="" >
        <label for="">Recordar contraseña</label>
      </div>
      <button type="submit" class="btn btn-verde">Ingresar</button>
    </form>
    <div class="footer-modal"> 
      <hr>
      <label>¿Aun no tienes cuenta?</label>     
      <a href="" class="btn btn-outline">Registrate</a>
    </div>
  </div>
</div>

<div class="modalfull hidden" id="modal2">
  <div class="box-fullModal">
    <div class="box-title">
      <a href="#" id="closed-modal"><img src="assets/img/ico/x.png" alt="icono cerrar"> </a>
      <h3 class="title">Perfil</h3>      
    </div>    
    <hr>
    
    
    <hr>
    <div class="footer-modal">       
      <a href="" class="btn btn-verde">Log Out</a>
    </div>
  </div>
</div>

<div class="modalfull hidden" id="modal3">
  <div class="box-fullModal">    
    <h2 class="title">¡Es hora de jugar! Ingresa y encuentra tu próximo partido!</h2>
    <form action="system/controller/login.php" class="flex-col form-login" method="post" id="form-login">
      <div class="box-input inputEmail">
        <input type="text" name="email" class="input w100" id="email" placeholder="Email" onkeydown="" required>
        <span class="erroremail" id="erroremail"></span>
      </div>	
      <div class="box-input inputBox">
        <input type="password" name="password" id="password" class="input w100" placeholder="Password" required>
        <div class="toggle toggle-pass" onclick="showHide()">
          <span id="span3"><i class="far fa-eye-slash"></i></span>
          <span id="span4" class="hidden"><i class="far fa-eye"></i> </span>
        </div>
        <span class="errorpassword" id="errorpassword"></span>
      </div>
      <div class="flex justify-start mg-bt40">
        <input type="checkbox" name="" id="" >
        <label for="">Recordar contraseña</label>
      </div>
      <button type="submit" class="btn btn-verde">Ingresar</button>
    </form>    
  </div>
</div>
<?php borrarErrores(); ?>
<script type="text/javascript">
  const currentLocation = location.href;
  const menuItem = document.querySelectorAll(".nav-link");
  const menuLenght = menuItem.length;

  for (let i = 0; i < menuLenght; i++) {
    if (menuItem[i].href === currentLocation) {
      menuItem[i].classList.add("active");
    }
  }		

  const password = document.getElementById('password'),				
		span3 = document.querySelector('#span3'),
		span4 = document.querySelector('#span4');

	function showHide(){
		if(password.type == 'password'){
			password.setAttribute('type','text');			
			span3.style.display = "none";
			span4.style.display = "block";
		}else{
			password.setAttribute('type','password');
			span3.style.display = "block";
			span4.style.display = "none";
		}
	}

  const modal = document.getElementById('modal');
  const body = document.getEle

  window.addEventListener('click', function (event) {
    // Si haces clic fuera del contenido del modal
    if (event.target === modal) {      
      modal.classList.remove("mostrar");
      modal.classList.add("hidden");
      document.body.classList.remove("overflow");
    }
  });
</script>

<script src="assets/js/futbolquery.js"></script>
<script src="assets/js/square.min.js"></script>
<script src="assets/js/jquery.aniview.js"></script>
<script src="assets/js/owl.carousel.min.js"></script>
