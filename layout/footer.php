<!-- <span class="ir-arriba" title="Subir"><i class="fas fa-arrow-up"></i></span> -->
<footer class="footer">
  <div class="container-wrap center">
    <div class="container-wrap w100 space-between">
      <div class="box-logo">
        <img src="assets/img/logo.png" alt="logo de futbol evolution">
      </div>
      <div class="box-container-footer flex space-around">
        <div class="item-footer">
          <h2 class="title">Team</h2>
          <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Minus autem nobis facere repellat odit recusandae, aliquid dolor officia voluptatem inventore.</p>
        </div>
        <div class="item-footer">
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

<!-- login principal -->
<div class="modal hidden" id="modal">
  <div class="box-modal modal-little">
    <div class="header-modal">
      <img src="assets/img/logo.png" alt="logo">
      <a href="#" class="btn-cerrar"><img src="assets/img/ico/x.png" alt="cerrar" class="img-ico"></a>
    </div>
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
    <form action="system/controller/login.php" class="flex-col" method="post" id="form-login">
      <div class="box-input inputEmail">
        <input type="text" name="email" class="input w100" placeholder="Email" onkeydown="" required>
        <span class="erroremail" id="erroremail"></span>
      </div>
      <div class="box-input inputBox">
        <input type="password" name="password" id="" class="input w100" placeholder="Password" required>
        <div class="toggle toggle-pass" onclick="showHide()">
          <span id="span3"><i class="far fa-eye-slash"></i></span>
          <span id="span4" class="hidden"><i class="far fa-eye"></i> </span>
        </div>
        <span class="errorpassword" id="errorpassword"></span>
      </div>
      <div class="flex justify-start mg-bt40">
        <input type="checkbox" name="" id="">
        <label for="">Recordar contraseña</label>
      </div>
      <button type="submit" class="btn btn-verde">Ingresar</button>
    </form>
    <div class="footer-modal">
      <hr>
      <label>¿Aun no tienes cuenta?</label>
      <a href="#" class="btn btn-outline" id="btn-registrate">Registrate</a>
    </div>
  </div>
</div>

<!-- Registrar nuevo usuario -->
<div class="modal hidden" id="modal2">
  <div class="box-modal modal-midle">
    <div class="header-modal">
      <img src="assets/img/logo.png" alt="logo">
      <a href="#" class="btn-cerrar"><img src="assets/img/ico/x.png" alt="cerrar" class="img-ico"></a>
    </div>
    <hr>
    <h2 class="title-big">Create Account</h2>
    <p class="texto">Enter the following information and continue.</p>
    <form action="system/controller/adduser.php" method="post">
      <div class="w100 grid form-grid" id="step-1">
        <div class="box-input">
          <label for="nombre">Name: </label>
          <input class="w100 " type="text" name="nombre" required>
        </div>
        <div class="box-input">
          <label for="apellidos">Last Name: </label>
          <input class="w100 " type="text" name="apellidos" required>
        </div>
        <div class="box-input">
          <label for="genero">Gender : </label>
          <select name="genero" id="" class="w100" required>
            <option>Select an option</option>
            <option value="female">Female</option>
            <option value="male">Male</option>
          </select>
        </div>
        <div class="box-input">
          <label for="fecha">Date of Birth: </label>
          <input class="w100 " type="date" name="fecha" required>
        </div>
        <div class="box-input">
          <label for="nacionalidad">Country: </label>
          <select name="nacionalidad" class="w100" required>
            <option>Select an option</option>
            <?php 
                $datos = selectalldatos($con, 'paises');
                if(!empty($datos) && mysqli_num_rows($datos) >= 1):
                  while($dato = mysqli_fetch_assoc($datos)):
              ?>		
              <option value="<?=$dato['iso']?>">
                <?=$dato['nombre']?>								
              </option>
            <?php endwhile; endif; ?>			       
          </select>
        </div>
        <div class="box-input">
          <label for="telefono">Phone : </label>
          <input class="w100 " type="number" name="telefono" required>
        </div>
        <div class="box-input">
          <label for="email">Email : </label>
          <input class="w100 " type="email" name="correo" value="" autocomplete="false" required>
        </div>
        <div class="box-input">
          <label for="email">Password : </label>
          <input class="w100 " type="password" name="password" id="password" required>
        </div>
        <div class="box-input">
          <label for="email">Repeat Password : </label>
          <input class="w100 " type="password" name="" id="password2" required>
        </div>
      </div>
      <div class="w100 form-grid hidden" id="step-2">
        <div class="box-input">
          <label for="nivel">Nivel de juego: </label>
          <select name="nivel" id="" class="w100" required>
            <option>Select an option</option>
            <option>Rookie</option>
            <option>Intermediate</option>
            <option>Advanced</option>
          </select>
        </div>
        <div class="box-input">
          <label for="posicion">Posición: </label>
          <select name="posicion" id="" class="w100" required>
            <option>Select an option</option>
            <option>GK</option>
            <option>DEF</option>
            <option>MID</option>
            <option>ATK</option>
          </select>
        </div>
        <div class="box-input">
          <label for="posicion2">Posición secundaria: </label>
          <select name="posicion2" id="" class="w100" required>
            <option>Select an option</option>
            <option>GK</option>
            <option>DEF</option>
            <option>MID</option>
            <option>ATK</option>
          </select>
        </div>
        <div class="box-input">
          <label for="pie">Pie dominante: </label>
          <select name="pie" id="" class="w100" required>
            <option>Select an option</option>
            <option>Left</option>
            <option>Right</option>
          </select>
        </div>       
      </div>
      <button type="button" class="btn btn-verde w100" id="btn-step">Continuar</button>
      <button type="submit" class="hidden btn-verde w100" id="btn-submit">Crear cuenta</button>
      <div class="flex justify-center"> 
        <p>¿Ya tienes cuenta? <a href="#" class="btn-link btn-outline" id="btn-login2">INGRESA</a>  </p>
      </div>
    </form>
  </div>
</div>

<!-- Modal de servicios -->
<div class="modal hidden" id="modal3">
  <div class="box-modal modal-little">
    <div class="header-modal">
      <img src="assets/img/logo.png" alt="logo">
      <a href="#" class="btn-cerrar"><img src="assets/img/ico/x.png" alt="cerrar" class="img-ico"></a>
    </div>
    <hr>
    <?php if (isset($_SESSION['usuario'])): ?>
      <h2 class="title">¿Hola <?= $_SESSION['usuario']['nombres'] ?>, que es lo que deseas saber?</h2>
      <form action="system/controller/login.php" method="post" id="">
        <div class="box-botones">
          <button type="submit" class="btn btn-verde">Enviar solicitud</button>
          <!-- <button type="submit" class="btn btn-outline-verde">soporte</button> -->
        </div>
      </form>
    <?php else: ?>
      <div class="sinlogin">
        <h2 class="title">Por favor ingresa los siguientes datos y nos pondremos en contacto</h2>
        <form action="system/controller/regservicios.php" class="box-formulario" method="post">
          <div class="box-input">
            <input type="text" name="name" class="input w100" placeholder="Enter Name" required>
          </div>
          <div class="box-input">
            <input type="text" name="email" class="input w100" placeholder="Enter Email" required>            
          </div>
          <div class="box-input">
            <input type="number" name="phone" class="input w100" minlength="9" placeholder="Enter phone" required>            
          </div>
          <button type="submit" class="btn btn-verde">Enviar</button>
        </form>
      </div>
    <?php endif; ?>
  </div>
</div>

<!-- Perfil de usuario -->
<div class="modalfull hidden" id="modal11">
  <div class="box-fullModal">
    <div class="header-modal">
      <a href="#" class="btn-cerrar"><img src="assets/img/ico/x.png" alt="icono cerrar"> </a>
      <h3 class="title">Perfil</h3>
    </div>
    <?php
      $datos = obtenerdatos($con, "usuarios", $_SESSION['usuario']['id']);
      if (!empty($datos) && mysqli_num_rows($datos) >= 1):
        while ($dato = mysqli_fetch_assoc($datos)):
    ?>

    <div class="container-body flex-col">
      <div class="flex-col align-center">
        <?php if($dato['genero'] === "male"): ?>
          <img src="assets/img/ico/user_hombre.svg" class="img-perfil">
        <?php else: ?>
          <img src="assets/img/ico/user_mujer.svg" class="img-perfil">
        <?php endif; ?> 
        <p class="bold mg-bt4"><?=$dato['nombres'] ?><?=$dato['apellidos'] ?></p> 
        <p ><?=$dato['email'] ?></p>
      </div>
      <div class="flex-col">
        <div class="flex space-between">
          <label class="label">Desempeño</label>
        </div>
        <div class="flex space-between">
          <p>Partidos jugados:</p>
          <p><?=$dato['partidos_jugados'] ?></p>
        </div>
        <div class="flex space-between">
          <p>MVP Totales:</p>
          <p><?=$dato['mvp'] ?></p>
        </div>
      </div>
      <hr>     
      <div class="flex-col">
        <div class="flex space-between">
          <label class="label">Información personal</label>
          <a href="#" class=""><img src="assets/img/ico/edit.png" alt="editar"></a>
        </div>
        <div class="flex space-between">
          <p>Nombres:</p>
          <p><?=$dato['nombres'] ?></p>
        </div>
        <div class="flex space-between">
          <p>Apellidos:</p>
          <p><?=$dato['apellidos'] ?></p>
        </div>
        <div class="flex space-between">
          <p>Género:</p>
          <p><?=$dato['genero'] ?></p>
        </div>
        <div class="flex space-between">
          <p>Edad:</p>
          <p></p>
        </div>        
        <div class="flex space-between">
          <p>País</p>
          <p><?=$dato['nacionalidad'] ?></p>
        </div>
        <div class="flex space-between">
          <p>Teléfono:</p>
          <p><?=$dato['telefono'] ?></p>
        </div>
        <div class="flex space-between">
          <p>Correo:</p>
          <p><?=$dato['email'] ?></p>
        </div>
        <div class="flex space-between">
          <p>Contraseña:</p>
          <p>**********</p>
        </div>
      </div>
      <hr>
      <div class="flex-col">
        <div class="flex space-between">
          <label class="label">Información de jugador</label>
          <a href="#" class=""><img src="assets/img/ico/edit.png" alt="editar"></a>
        </div>
        <div class="flex space-between">
          <p>Nivel de juego: </p>
          <p><?=$dato['nivel_juego'] ?></p>
        </div>
        <div class="flex space-between">
          <p>Posición:</p>
          <p><?=$dato['posicion'] ?></p>
        </div>
        <div class="flex space-between">
          <p>Posición secundaria:</p>
          <p><?=$dato['posicion_dos'] ?></p>
        </div>
        <div class="flex space-between">
          <p>Pie dominante:</p>
          <p><?=$dato['pie_dominante'] ?></p>
        </div>        
      </div>     
    </div>
    <?php
      endwhile;
    endif; ?>
    <div class="footer-modal">
      <a href="system/models/cerrar.php" class="btn btn-verde">Log Out</a>
    </div>
  </div>
</div>

<div class="modalfull hidden" id="modal12">
  <div class="box-fullModal modal-little">
    <h2 class="title">¡Es hora de jugar! Ingresa y encuentra tu próximo partido!</h2>
    <form action="system/controller/login.php" class="flex-col" method="post" id="form-login">
      <div class="box-input inputEmail">
        <input type="text" name="email" class="input w100" id="email" placeholder="Email" onkeydown="" required>
        <span class="erroremail" id="erroremail"></span>
      </div>
      <div class="box-input inputBox">
        <input type="password" name="password" id="" class="input w100" placeholder="Password" required>
        <div class="toggle toggle-pass" onclick="showHide()">
          <span id="span3"><i class="far fa-eye-slash"></i></span>
          <span id="span4" class="hidden"><i class="far fa-eye"></i> </span>
        </div>
        <span class="errorpassword" id="errorpassword"></span>
      </div>
      <div class="flex justify-start mg-bt40">
        <input type="checkbox" name="" id="">
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

  function showHide() {
    if (password.type == 'password') {
      password.setAttribute('type', 'text');
      span3.style.display = "none";
      span4.style.display = "block";
    } else {
      password.setAttribute('type', 'password');
      span3.style.display = "block";
      span4.style.display = "none";
    }
  }

  const modal = document.getElementById('modal');
  const body = document.getEle

  window.addEventListener('click', function(event) {
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