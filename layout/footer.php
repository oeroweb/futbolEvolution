<!-- <span class="ir-arriba" title="Subir"><i class="fas fa-arrow-up"></i></span> -->
<div id="info"></div>
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
    <form action="system/controller/login.php" class="flex-col" method="post" id="form_login" autocomplete="FALSE">
      <div class="box-input inputEmail">
        <input type="email" name="email" class="input w100" id="email" placeholder="Enter your Email" onkeydown="validaemail()" required>
        <div class="error" id="validaemail"></div>
      </div>
      <div class="box-input inputBox">
        <input type="password" name="password" id="password" class="input w100" placeholder="Ingresa tu contraseña" onkeydown="showHide()" required>
        <span class="errorpassword" id="errorpassword"></span>
      </div>
      <div class="flex justify-start mg-bt40">
        <input type="checkbox" name="" id="">
        <label for="">Recordar contraseña</label>
      </div>
      <button type="submit" name="login" class="btn btn-verde">Ingresar</button>
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
    <form method="post" id="form_register_user" onsubmit="event.preventDefault();">
      <div class="w100 grid form-grid" id="step-1">
        <div class="box-input">
          <label for="nombre">Name: </label>
          <input class="w100 " type="text" name="nombre" id="nombre" required>
          <input type="hidden" name="rol" id="rol" value="jugador" required>
        </div>
        <div class="box-input">
          <label for="apellidos">Last Name: </label>
          <input class="w100 " type="text" name="apellidos" id="apellidos" required>
        </div>
        <div class="box-input">
          <label for="genero">Gender: </label>
          <select name="genero" id="genero" class="w100" required>
            <option>Select an option</option>
            <option value="female">Female</option>
            <option value="male">Male</option>
          </select>
        </div>
        <div class="box-input">
          <label for="fecha">Date of Birth: </label>
          <input class="w100 " type="date" name="fecha" id="fecha" required>
        </div>
        <div class="box-input">
          <label for="nacionalidad">Country: </label>
          <select name="nacionalidad" id="nacionalidad" class="w100" required>
            <option>Select an option</option>
            <?php
            $datos = selectalldatos($con, 'paises');
            if (!empty($datos) && mysqli_num_rows($datos) >= 1):
              while ($dato = mysqli_fetch_assoc($datos)):
            ?>
                <option value="<?= $dato['id'] ?>">
                  <?= $dato['nombre'] ?>
                </option>
            <?php endwhile;
            endif; ?>
          </select>
        </div>
        <div class="box-input">
          <label for="telefono">Phone: </label>
          <input class="w100 " type="number" name="telefono" required>
        </div>
        <div class="box-input">
          <label for="email">Email: </label>
          <input class="w100" type="email" name="correo" id="email2" autocomplete="false" placeholder="Enter your Email" onkeydown="validaemail()" required>
          <div class="error" id="validaemail2"></div>
        </div>
        <div class="box-input">
          <label>Password: </label>
          <input class="w100" type="password" name="password" id="rpassword" onkeyup="validaPassword();" onkeydown="showHide();" required>
        </div>
        <div class="box-input">
          <label>Repeat Password: </label>
          <input class="w100" type="password" name="" id="rpassword2" onkeyup="validaPassword();" onkeydown="showHide();" required>
          <div class="error" id="error_password"></div>
        </div>
      </div>
      <div class="w100 form-grid hidden" id="step-2">
        <div class="box-input">
          <label for="nivel">Nivel de juego: </label>
          <select name="nivel" class="w100" required>
            <option>Select an option</option>
            <option>Rookie</option>
            <option>Intermediate</option>
            <option>Advanced</option>
          </select>
        </div>
        <div class="box-input">
          <label for="posicion">Posición: </label>
          <select name="posicion" class="w100" required>
            <option>Select an option</option>
            <option>GK</option>
            <option>DEF</option>
            <option>MID</option>
            <option>ATK</option>
          </select>
        </div>
        <div class="box-input">
          <label for="posicion2">Posición secundaria: </label>
          <select name="posicion2" class="w100" required>
            <option>Select an option</option>
            <option>GK</option>
            <option>DEF</option>
            <option>MID</option>
            <option>ATK</option>
          </select>
        </div>
        <div class="box-input">
          <label for="pie">Pie dominante: </label>
          <select name="pie" class="w100" required>
            <option>Select an option</option>
            <option>Left</option>
            <option>Right</option>
          </select>
        </div>
      </div>
      <div class="flex flex-col align-center">
        <button type="button" class="btn btn-verde w100" id="btn-step">Continuar</button>
        <button type="submit" class="hidden btn-verde w100" id="">Crear cuenta</button>
        <p>¿Ya tienes cuenta? <a href="#" class="btn-link btn-outline" id="btn-login2">INGRESA</a> </p>
        <button type="button" class="hidden btn-outline-verde" id="btn-back">Volver</button>
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
      <form action="system/controller/regservicios.php" method="post" id="">
        <div class="box-botones">
          <input class="w100 " type="hidden" name="idusuario" value="<?php echo $_SESSION['usuario']['id'] ?>">
          <button type="submit" class="btn btn-verde">Enviar solicitud</button>
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
            <?php if ($dato['genero'] === "Male"): ?>
              <img src="assets/img/ico/user_hombre.svg" class="img-perfil">
            <?php else: ?>
              <img src="assets/img/ico/user_mujer.svg" class="img-perfil">
            <?php endif; ?>
            <p class="bold mg-bt4"><?= $dato['nombres'] ?><?= $dato['apellidos'] ?></p>
            <p><?= $dato['email'] ?></p>
          </div>
          <div class="flex-col">
            <div class="flex space-between">
              <label class="label">Desempeño</label>
            </div>
            <div class="flex space-between">
              <p>Partidos jugados:</p>
              <p><?= $dato['partidos_jugados'] ?></p>
            </div>
            <div class="flex space-between">
              <p>MVP Totales:</p>
              <p><?= $dato['mvp'] ?></p>
            </div>
          </div>
          <hr>
          <div class="flex-col">
            <div class="flex space-between">
              <label class="label">Información personal</label>
              <a href="#" id="btn-edit-user"><img src="assets/img/ico/edit.png" alt="editar"></a>
            </div>
            <div class="flex space-between">
              <p>Nombres:</p>
              <p><?= $dato['nombres'] ?></p>
            </div>
            <div class="flex space-between">
              <p>Apellidos:</p>
              <p><?= $dato['apellidos'] ?></p>
            </div>
            <div class="flex space-between">
              <p>Género:</p>
              <p><?= $dato['genero'] ?></p>
            </div>
            <div class="flex space-between">
              <p>Edad:</p>
              <p></p>
            </div>
            <div class="flex space-between">
              <p>País</p>
              <?php
              $paises = obtenerdatos($con, "paises", $dato['nacionalidad']);
              if (!empty($paises) && mysqli_num_rows($paises) >= 1):
                while ($pais = mysqli_fetch_assoc($paises)):
              ?>
                  <p><?= $pais['nombre'] ?></p>
              <?php
                endwhile;
              endif; ?>
            </div>
            <div class="flex space-between">
              <p>Teléfono:</p>
              <p><?= $dato['telefono'] ?></p>
            </div>
            <div class="flex space-between">
              <p>Correo:</p>
              <p><?= $dato['email'] ?></p>
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
              <a href="#" id="btn-edit-user-habi"><img src="assets/img/ico/edit.png" alt="editar"></a>
            </div>
            <div class="flex space-between">
              <p>Nivel de juego: </p>
              <p><?= $dato['nivel_juego'] ?></p>
            </div>
            <div class="flex space-between">
              <p>Posición:</p>
              <p><?= $dato['posicion'] ?></p>
            </div>
            <div class="flex space-between">
              <p>Posición secundaria:</p>
              <p><?= $dato['posicion_dos'] ?></p>
            </div>
            <div class="flex space-between">
              <p>Pie dominante:</p>
              <p><?= $dato['pie_dominante'] ?></p>
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
    <div class="header-modal">
      <a href="#" class="btn-cerrar"><img src="assets/img/ico/x.png" alt="icono cerrar"> </a>
      <h3 class="title">Editar información personal</h3>
    </div>
    <form class="form-container-grid" method="post" id="form_update_user" onsubmit="event.preventDefault();">
      <?php
      $datos = obtenerdatos($con, "usuarios", $_SESSION['usuario']['id']);
      if (!empty($datos) && mysqli_num_rows($datos) >= 1):
        while ($dato = mysqli_fetch_assoc($datos)):
      ?>
          <div class="container-body flex-col">
            <div class="w100 grid form-grid">
              <div class="box-image flex justify-center">
                <?php if ($dato['genero'] === "Male"): ?>
                  <img src="assets/img/ico/user_hombre.svg" class="img-perfil">
                <?php else: ?>
                  <img src="assets/img/ico/user_mujer.svg" class="img-perfil">
                <?php endif; ?>
              </div>
              <div class="box-input">
                <input type="hidden" name="id" value="<?= $dato['id'] ?>">
                <input type="hidden" name="rol" value="<?= $dato['rol'] ?>">
                <label for="nombre">Name: </label>
                <input class="w100" type="text" name="nombre" value="<?= $dato['nombres'] ?>" required>
              </div>
              <div class="box-input">
                <label for="apellidos">Last Name: </label>
                <input class="w100" type="text" name="apellidos" id="apellidos" value="<?= $dato['apellidos'] ?>" required>
              </div>
              <div class="box-input">
                <label for="genero">Gender: </label>
                <select name="genero" id="genero" class="w100" required>
                  <option value="Female" <?= ($dato['genero']) == "Female" ? 'selected="selected"' : '' ?>>Female</option>
                  <option value="Male" <?= ($dato['genero']) == "Male" ? 'selected="selected"' : '' ?>>Male</option>
                </select>
              </div>
              <div class="box-input">
                <label for="fecha">Date of Birth: </label>
                <input class="w100 " type="date" name="fecha" id="fecha" value="<?= $dato['fec_nac'] ?>" required>
              </div>
              <div class="box-input">
                <label for="nacionalidad">Country: </label>
                <select name="nacionalidad" id="nacionalidad" class="w100" required>
                  <option>Select an option</option>
                  <?php
                  $datos = selectalldatos($con, 'paises');
                  if (!empty($datos) && mysqli_num_rows($datos) >= 1):
                    while ($pais = mysqli_fetch_assoc($datos)):
                  ?>
                      <option value="<?= $pais['id'] ?>" <?= ($pais['id']) == $dato['nacionalidad'] ? 'selected="selected"' : '' ?>>
                        <?= $pais['nombre'] ?>
                      </option>
                  <?php endwhile;
                  endif; ?>
                </select>
              </div>
              <div class="box-input">
                <label for="telefono">Phone: </label>
                <input class="w100 " type="text" name="telefono" value="<?= $dato['telefono'] ?>" required>
              </div>
              <div class="box-input">
                <label for="email">Email: </label>
                <input class="w100" type="email" name="correo" id="email3" autocomplete="false" value="<?= $dato['email'] ?>" onkeydown="validaemail()" required>
                <div class="error" id="validaemail2"></div>
              </div>
              <div class="box-input">
                <label>Password: </label>
                <input class="w100" type="password" name="password" id="password3" value="<?= $dato['clave'] ?>" onkeydown="showHide();" required>
              </div>
            </div>
          </div>
          <div class="footer-modal">
            <button type="button" class="btn btn-outline-verde btn-cerrar">Cancelar</button>
            <button type="submit" class="btn btn-verde " id="">Guardar</button>
          </div>
      <?php
        endwhile;
      endif; ?>
    </form>
  </div>
</div>

<div class="modalfull hidden" id="modal13">
  <div class="box-fullModal modal-little">
    <div class="header-modal">
      <a href="#" class="btn-cerrar"><img src="assets/img/ico/x.png" alt="icono cerrar"> </a>
      <h3 class="title">Editar información personal</h3>
    </div>
    <form class="form-container-grid" method="post" id="form_update_user_habilidades" onsubmit="event.preventDefault();">
      <?php
      $datos = obtenerdatos($con, "usuarios", $_SESSION['usuario']['id']);
      if (!empty($datos) && mysqli_num_rows($datos) >= 1):
        while ($dato = mysqli_fetch_assoc($datos)):
      ?>
          <div class="container-body flex-col">
            <div class="w100 grid form-grid">
              <div class="box-image flex justify-center">
                <?php if ($dato['genero'] === "Male"): ?>
                  <img src="assets/img/ico/user_hombre.svg" class="img-perfil">
                <?php else: ?>
                  <img src="assets/img/ico/user_mujer.svg" class="img-perfil">
                <?php endif; ?>
              </div>
              <input type="hidden" name="id" value="<?= $dato['id'] ?>" readonly>
              <input type="hidden" name="nombre" value="<?= $dato['nombres'] ?>" readonly>
              <input type="hidden" name="apellidos" value="<?= $dato['apellidos'] ?>" readonly>
              <input type="hidden" name="rol" value="<?= $dato['rol'] ?>" readonly>              
              <input type="hidden" name="mvp" value="<?= $dato['mvp'] ?>" readonly>              
              <input type="hidden" name="pie" value="<?= $dato['pie_dominante'] ?>" readonly>              
              <input type="hidden" name="partidos" value="<?= $dato['partidos_jugados'] ?>" readonly>              
              <input type="hidden" name="nivel_fb" value="<?= $dato['nivel_interno'] ?>" readonly>              
              <div class="box-input">
                <label for="nivel">Nivel de juego: </label>                
                <select name="nivel" class="w100" required>
                  <option <?= ($dato['nivel_juego']) == "Rookie" ? 'selected="selected"' : '' ?>>Rookie</option>
                  <option <?= ($dato['nivel_juego']) == "Intermediate" ? 'selected="selected"' : '' ?>>Intermediate</option>
                  <option <?= ($dato['nivel_juego']) == "Advanced" ? 'selected="selected"' : '' ?>>Advanced</option>
                </select>
              </div>
              <div class="box-input">
                <label for="posicion">Posición: </label>
                <select name="posicion1" class="w100" required>
                  <option <?= ($dato['posicion']) == "GK" ? 'selected="selected"' : '' ?>>GK</option>
                  <option <?= ($dato['posicion']) == "DEF" ? 'selected="selected"' : '' ?>>DEF</option>
                  <option <?= ($dato['posicion']) == "MID" ? 'selected="selected"' : '' ?>>MID</option>
                  <option <?= ($dato['posicion']) == "ATK" ? 'selected="selected"' : '' ?>>ATK</option>
                </select>
              </div>
              <div class="box-input">
                <label for="posicion2">Posición secundaria: </label>
                <select name="posicion2" class="w100" required>
                  <option <?= ($dato['posicion_dos']) == "GK" ? 'selected="selected"' : '' ?>>GK</option>
                  <option <?= ($dato['posicion_dos']) == "DEF" ? 'selected="selected"' : '' ?>>DEF</option>
                  <option <?= ($dato['posicion_dos']) == "MID" ? 'selected="selected"' : '' ?>>MID</option>
                  <option <?= ($dato['posicion_dos']) == "ATK" ? 'selected="selected"' : '' ?>>ATK</option>
                </select>
              </div>
              <div class="box-input">
                <label for="pie">Pie dominante: </label>
                <select name="pie" class="w100" required>                  
                  <option <?= ($dato['pie_dominante']) == "Left" ? 'selected="selected"' : '' ?>>Left</option>
                  <option <?= ($dato['pie_dominante']) == "Right" ? 'selected="selected"' : '' ?>>Right</option>
                </select>
              </div>

            </div>
          </div>
          <div class="footer-modal">
            <button type="button" class="btn btn-outline-verde btn-cerrar">Cancelar</button>
            <button type="submit" class="btn btn-verde " id="">Guardar</button>
          </div>
      <?php
        endwhile;
      endif; ?>
    </form>
  </div>
</div>

<?php borrarErrores(); ?>

<script src="assets/js/futbolquery.js"></script>
<script src="assets/js/square.min.js"></script>
<script src="assets/js/jquery.aniview.js"></script>
<script src="assets/js/owl.carousel.min.js"></script>

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
    rpassword = document.getElementById('rpassword'),
    rpassword2 = document.getElementById('rpassword2'),
    span3 = document.querySelector('#span3'),
    span4 = document.querySelector('#span4');

  function showHide() {
    if (password.type == 'password') {
      password.setAttribute('type', 'text');
    }
    setTimeout(() => {
      password.setAttribute('type', 'password');
    }, 1000);

    if (rpassword.type == 'password') {
      rpassword.setAttribute('type', 'text');
    }
    setTimeout(() => {
      rpassword.setAttribute('type', 'password');
    }, 1000);

    if (rpassword2.type == 'password') {
      rpassword2.setAttribute('type', 'text');
    }
    setTimeout(() => {
      rpassword2.setAttribute('type', 'password');
    }, 1000);

  }

  function validaemail() {
    var email = document.getElementById("email").value;
    var email2 = document.getElementById("email2").value;
    var validaemail = document.getElementById("validaemail");
    var validaemail2 = document.getElementById("validaemail2");
    var pattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;

    if (!email.match(pattern)) {
      validaemail.innerHTML = "Correo invalido!";
      validaemail.style.color = "#ff0000";
    } else {
      validaemail.innerHTML = "";
      validaemail.style.color = "#ffffff";
    }

    if (!email2.match(pattern)) {
      validaemail2.innerHTML = "Correo invalido!";
      validaemail2.style.color = "#ff0000";
    } else {
      validaemail2.innerHTML = "";
      validaemail2.style.color = "#ffffff";
    }
  }

  function validaPassword() {
    let password = document.getElementById('rpassword').value,
      password2 = document.getElementById('rpassword2').value,
      messageError = document.getElementById('error_password'),
      btnStep = document.getElementById('btn-step');

    if (password !== password2) {
      messageError.innerHTML = "<p class='texto-alerta text-red'><img src='assets/img/ico/alert-triangle.png' class='img-ico-small'> Las contraseñas no conciden</p>";
      password.classList.add('inputError');
      password2.classList.add('inputError');
      document.getElementById('btn-step').setAttribute("disabled", "");
    } else {
      messageError.innerHTML = "";
      password.classList.remove('inputError');
      password2.classList.remove('inputError');
      document.getElementById('btn-step').removeAttribute("disabled");
    }
  }

  const modal = document.getElementById('modal');
  const idUsuario = document.getElementById("idUsuario").value;


  // window.addEventListener('click', function(event) {
  //   // Si haces clic fuera del contenido del modal
  //   if (event.target === modal) {
  //     modal.classList.remove("mostrar");
  //     modal.classList.add("hidden");
  //     document.body.classList.remove("overflow");
  //   }
  // });
</script>

<script>
  $(document).ready(function() {
    register_user();
    actualizar();
    actualizar_habilidades();
  });

  function cerrarModal() {
    $("#modal2").addClass("hidden");
    $("#modal2").removeClass("mostrar");
    $("#modal12").addClass("hidden");
    $("#modal12").removeClass("mostrar");
    $("#modal13").addClass("hidden");
    $("#modal13").removeClass("mostrar");
    $("body").removeClass("overflow");
  };

  var register_user = function() {
    $("#form_register_user").on("submit", function() {
      var frm = $(this).serialize();
      $.ajax({
        method: "POST",
        url: "system/controller/adduser.php",
        dataType: 'json',
        data: frm
      }).done(function(resultado) {
        if (!resultado.error) {
          $("#info").html("<div class='alerta-exito'><i class='far fa-check-circle'> </i> ¡Tu cuenta se creo con éxito!</div>");
          $("#info").fadeOut(10000, function() {
            $(this).html("");
            $(this).fadeIn(2000);
          });
          cerrarModal();
        } else {
          $("#info").html("<div class='alerta-error'><i class='fas fa-times-circle'></i> Hubo un error en el proceso por favor volver a probar!!</div>");
          $("#info").fadeOut(5000, function() {
            $(this).html("");
            $(this).fadeIn(2000);
          });
          cerrarModal();
        }
      });
    });
  }

  var actualizar = function() {
    $("#form_update_user").on("submit", function() {
      var frm = $(this).serialize();
      $.ajax({
        method: "POST",
        url: "system/controller/upusuario.php",
        dataType: 'json',
        data: frm
      }).done(function(resultado) {
        if (!resultado.error) {
          $("#info").html("<div class='alerta-exito'><i class='far fa-check-circle'> </i>Se actualizaron los datos con éxito!</div>");
          $("#info").fadeOut(10000, function() {
            $(this).html("");
            $(this).fadeIn(2000);
          });
          cerrarModal();
        } else {
          $("#info").html("<div class='alerta-error'><i class='fas fa-times-circle'></i> Hubo un error en el proceso por favor volver a probar!!</div>");
          $("#info").fadeOut(5000, function() {
            $(this).html("");
            $(this).fadeIn(2000);
          });
          cerrarModal();
        }
      });
    });
  }

  var actualizar_habilidades = function() {
    $("#form_update_user_habilidades").on("submit", function() {
      var frm = $(this).serialize();
      $.ajax({
        method: "POST",
        url: "system/controller/upusuario_habi.php",
        dataType: 'json',
        data: frm
      }).done(function(resultado) {
        console.log(resultado);
        if (!resultado.error) {
          $("#info").html("<div class='alerta-exito'><i class='far fa-check-circle'> </i>Se actualizaron los datos con éxito!</div>");
          $("#info").fadeOut(10000, function() {
            $(this).html("");
            $(this).fadeIn(2000);
          });
          cerrarModal();
        } else {
          $("#info").html("<div class='alerta-error'><i class='fas fa-times-circle'></i> Hubo un error en el proceso por favor volver a probar!!</div>");
          $("#info").fadeOut(5000, function() {
            $(this).html("");
            $(this).fadeIn(2000);
          });
          cerrarModal();
        }
      });
    });
  }
</script>