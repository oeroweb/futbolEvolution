<?php include('layout/header.php'); ?>

<body>
	<!-------------- INICIO DE PAGINA -------------->
	<main class="main">
		<?php include('layout/navbar.php'); ?>

		<!------ SLIDER ------>
		<section class="slider example-1">
			<?php
			$Somos = obtenerTodosDatosActivos($con, "homeslider");
			if (!empty($Somos) && mysqli_num_rows($Somos) >= 1):
				while ($somo = mysqli_fetch_assoc($Somos)):
			?>
					<div class="relative center">
						<img class="img-list" src="assets/img/slides/<?= $somo['imagen'] ?>" alt="img-slider">
						<div class="box-texto ">
							<h2 class="title"><?= $somo['en_titulo'] ?></h2>
							<p class="texto"><?= $somo['en_descripcion'] ?></p>
						</div>
						<div class="box-botones flex justify-end">
							<!-- <a href="game.php" class="btn btn-outline">Next matches</a> -->
							<a href="game.php#partidos" class="btn btn-verde">See List of Matches</a>
						</div>
						<!-- <div class="box-image-number">
								<img src="assets/img/slides/1.svg" alt="imagen slider">
							</div>	-->
					</div>
			<?php
				endwhile;
			endif; ?>
		</section>

		<section class="formulario-home">
			<?php if (isset($_SESSION['completado'])): ?>
					<div class="alerta-exito">
						<?= $_SESSION['completado'] ?>
					</div>
				<?php elseif (isset($_SESSION['fallo'])): ?>
					<div class="alerta-error">
						<?= $_SESSION['fallo'] ?>
					</div>
				<?php endif; ?>
			<form class="formulario w100" method="post" action="system/controller/adduser-home.php">
				<div class="w100 grid form-grid">
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
							<option disabled selected>Select an option</option>
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
							<option disabled selected>Select an option</option>
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
						<input class="w100 " type="number" minlength="10" maxlength="11" name="telefono" required>
					</div>
					<div class="box-input">
						<label for="email">Email: </label>
						<input class="w100" type="email" name="correo" id="email2" autocomplete="false" placeholder="Enter your Email" required>
						<div class="errorInput">Correo no válido</div>
					</div>
					<input class="w100" type="hidden" name="password" value="12345678" required>										
				</div>
				<div class="w100 form-grid">
					<div class="box-input">
						<label for="nivel">Nivel de juego: </label>
						<select name="nivel" class="w100" required>
							<option disabled selected>Select an option</option>
							<option value="Rookie">Rookie</option>
							<option value="Intermediate">Intermediate</option>
							<option value="Advanced">Advanced</option>
						</select>
					</div>
					<div class="box-input">
						<label for="posicion">Posición: </label>
						<select name="posicion" class="w100" required>
							<option disabled selected>Select an option</option>
							<option value="GK">GK</option>
							<option value="DEF">DEF</option>
							<option value="MID">MID</option>
							<option value="ATK">ATK</option>
						</select>
					</div>
					<div class="box-input">
						<label for="posicion2">Posición secundaria: </label>
						<select name="posicion2" class="w100">
							<option disabled selected>Select an option</option>
							<option value="GK">GK</option>
							<option value="DEF">DEF</option>
							<option value="MID">MID</option>
							<option value="ATK">ATK</option>
						</select>
					</div>
					<div class="box-input">
						<label for="pie">Pie dominante: </label>
						<select name="pie" class="w100" required>
							<option disabled selected>Select an option</option>
							<option value="Left">Left</option>
							<option value="Right">Right</option>
						</select>
					</div>
				</div>
				<div class="flex flex-col align-center">					
					<button type="submit" class="btn btn-verde w100">Crear cuenta</button>					
				</div>
			</form>
		</section>

	<?php borrarErrores(); ?>
	</main>
	<?php include('layout/footer.php'); ?>

	<script>
		$('.example-1').square1({
			caption: 'none',
			theme: 'light',
			prev_next_nav: 'none',
		});

		$(function() {
			var mySlider = $('.example-1');
			mySlider.filter_gallery({
				// auto_slide: true,
				animation: 'slide',
				transition_time: 3000,
				auto_slide_delay: 6000,
				pause_on_hover: true,
				prev_next_nav: 'outside',
			});
		});
	</script>

</body>

</html>