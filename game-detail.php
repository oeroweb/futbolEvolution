<?php
include('layout/header.php');
if (!isset($_GET)) {
	header("Location:game.php");
} else {
	$id = $_GET['id'];
}
?>

<body>
	<!-------------- INICIO DE PAGINA -------------->
	<main class="main">
		<?php include('layout/navbar.php'); ?>
		<section class="game-banner">
			<div class="flex align-center center">
				<?php
				$datos = detallePartido($con, $id);
				if (!empty($datos) && mysqli_num_rows($datos) >= 1):
					while ($dato = mysqli_fetch_assoc($datos)):
				?>
						<div class="box-texto-detail">
							<h2 class="title"><?= $dato['nombreLocal'] ?></h2>
						</div>
				<?php
					endwhile;
				endif; ?>
			</div>
		</section>

		<section class="game-container-grid" id="partidos">
			<div class="center">
				<div class="box-retorno">
					<a href="javascript:history.back()" title="Atras" class="flex align-center">
						<img src="assets/img/ico/arrow_back.svg" class="img-ico">Return to List
					</a>
				</div>
				<hr>
				<?php
				$datos = detallePartido($con, $id);
				if (!empty($datos) && mysqli_num_rows($datos) >= 1):
					while ($dato = mysqli_fetch_assoc($datos)):
						$cantidad = $dato['total_jugadores'] / $dato['total_equipos'];
						$newFecha = formatearFecha($dato['fecha_partido']);
				?>
						<div class="container-grid-detail">
							<div class="card-partido">
								<div class="container-wrap space-between mg-bt24">
									<div>
										<h2 class="title"><?= $dato['nombreLocal'] ?></h2>
										<p class="subtitle"><?= $dato['en_direccion'] ?></p>
									</div>
									<div class="box-precio">
										<div class="texto">$<?= $dato['costo'] ?></div>
									</div>
								</div>
								<div class="card-options">
									<p class="texto-icon"><img src="assets/img/ico/user_black.png" class="img-ico"><span><?= $cantidad.'v'.$cantidad ?></span> </p>
									<p class="texto-icon"><img src="assets/img/ico/calendar.png" class="img-ico"><span><?= $newFecha ?></span> </p>
									<p class="texto-icon"><img src="assets/img/ico/estrella.png" class="img-ico"><span><?= $dato['en_nivel'] ?></span> </p>
									<p class="texto-icon"><img src="assets/img/ico/clock.png" class="img-ico"><span><?= $dato['hora'] ?> </span> </p>
									<p class="texto-icon"><img src="assets/img/ico/user_black.png" class="img-ico"><span><?= $dato['genero'] ?></span> </p>
								</div>
								<hr>
								<div class="container-wrap items-center space-between">
									<div class="select-game" id="select-game">
										<div class="flex"><span>Game roster</span>
											<img src="assets/img/ico/arrow_down.svg" class="img-ico">
										</div>
									</div>

									<?php
										$totales = obtenerCantidadGameRoster($con, $id);
										if (!empty($totales) && mysqli_num_rows($totales) >= 1):
											while ($total = mysqli_fetch_assoc($totales)):
									?>
											<p class="texto-count"><?= $total['Cantidad'] ?>/<?= $dato['total_jugadores'] ?> SPOTS FILLED</p>
									<?php
										endwhile;
									endif; ?>
								</div>
								
								<div class="box-game-roster" id="box-game-roster">
									<?php
										$jugadores = obtenerGameRoster($con, $id);
										if (!empty($jugadores) && mysqli_num_rows($jugadores) >= 1):
											while ($jugador = mysqli_fetch_assoc($jugadores)):
									?>
											<div class="item-roster">
												<div class="flex align-center">
													<img src="assets/img/ico/avatar.png" alt="avatar masculino" class="img-avatar">
													<p><?= $jugador['nombres'] . ' ' . $jugador['apellidos'] ?></p>
												</div>
												<div class="texto"><?= $jugador['posicion'] ?></div>
											</div>
									<?php endwhile; else : ?>
											<div class="item-roster">
												Aun no hay jugadores
											</div>
									<?php endif; ?>
								</div>
								
								<div class="mg-bt24">
									<p class="text mg-bt24">At <strong>"<?= $dato['nombreLocal'] ?>" </strong>, you will enjoy a top-quality court.</p>
									<p><strong>Instructions: </strong></p>
									<ul class="lista">
										<li>Open to all skill levels.</li>
										<li>Only players on the roster can participate.</li>
										<li>Arrive 10 minutes before the start time. Otherwise, you risk playing a shorter game.</li>
									</ul>
								</div>
								<div class="box-card-beneficios">
									<?php if ($dato['beneficio1'] == 2): ?>
										<div class="card-beneficio">
											<img src="assets/img/partidos/beneficio1.png" alt="">
										</div>
									<?php endif; ?>
									<?php if ($dato['beneficio2'] == 2): ?>
										<div class="card-beneficio">
											<img src="assets/img/partidos/beneficio2.png" alt="">
										</div>
									<?php endif; ?>
									<?php if ($dato['beneficio3'] == 2): ?>
										<div class="card-beneficio">
											<img src="assets/img/partidos/beneficio3.png" alt="">
										</div>
									<?php endif; ?>
									<?php if ($dato['beneficio4'] == 2): ?>
										<div class="card-beneficio">
											<img src="assets/img/partidos/beneficio4.png" alt="">
										</div>
									<?php endif; ?>
									<?php if ($dato['beneficio5'] == 2): ?>
										<div class="card-beneficio">
											<img src="assets/img/partidos/beneficio5.png" alt="">
										</div>
									<?php endif; ?>
								</div>
								<hr>
								<?php if (isset($_SESSION['completado'])): ?>
									<div class="alerta-exito">
										<?= $_SESSION['completado'] ?>
									</div>
								<?php elseif (isset($_SESSION['fallo'])): ?>
									<div class="alerta-error">
										<?= $_SESSION['fallo'] ?>
									</div>
								<?php endif; ?>
								
								<form class="formulario" action="system/models/add/registrar_jugador.php" method="post" id="form_register_player">
									<div class="flex-col w100">
										<input type="hidden" name="idDetallePartido" value="<?= $id ?>">
										<input type="hidden" name="idUsuario" value="<?= isset($_SESSION['usuario']) ? $_SESSION['usuario']['id'] : '' ?>">
										<div class="box-input">
											<select name="posicion" class="w100" required>
												<option value="">Choose your position</option>
												<option value="GK">GK</option>
												<option value="DEF">DEF</option>
												<option value="MID">MID</option>
												<option value="ATK">ATK</option>
											</select>
										</div>
									</div>
									<hr>
									<div class="flex-col align-center">
										<?php if (isset($_SESSION['usuario'])): ?>
											<button type="submit" class="w100 btn btn-verde web">Pagar</button>
										<?php else: ?>
											<a href="#" class="btn btn-verde btn-login">Login</a>
										<?php endif; ?>
										<a href="documentos/Politica-de-Privacidad.pdf" class="btn-link" target="_blank">Términos y condiciones</a>
									</div>
								</form>								
							</div>

							<div class="box-imagenes">
								<img src="assets/img/partidos/<?= $dato['imagen1'] ?>" alt="img-partido">
								<div class="box-imagenes-list">
									<?php if ($dato['imagen2']): ?>
										<img class="img-list" src="assets/img/partidos/<?= $dato['imagen2'] ?>" alt="img-partido">
									<?php endif; ?>
									<?php if ($dato['imagen3']): ?>
										<img class="img-list" src="assets/img/partidos/<?= $dato['imagen3'] ?>" alt="img-partido">
									<?php endif; ?>
									<?php if ($dato['imagen4']): ?>
										<img class="img-list" src="assets/img/partidos/<?= $dato['imagen4'] ?>" alt="img-partido">
									<?php endif; ?>
								</div>
							</div>
						</div>
						<hr>
						<div class="w100">
							<h2 class="title">Como llegar</h2>
							<p class="subtitle mg-bt24"><?= $dato['en_direccion'] ?></p>

							<?php if ($dato['imagen5']): ?>
								<img class="img-list mg-bt24" src="assets/img/partidos/<?= $dato['imagen5'] ?>" alt="img-mapa">
							<?php endif; ?>

							<div>
								<a href="<?= $dato['url_google'] ?>" target="_blank" class="btn btn-verde">See on Google Maps</a>
								<a href="<?= $dato['url_apple'] ?>" target="_blank" class="btn btn-verde">See on Apple Maps</a>
							</div>
						</div>
				<?php
					endwhile;
				endif; ?>
			</div>
		</section>
	</main>
	<?php include('layout/footer.php'); ?>

</body>

</html>

<script>
	$(document).ready(function() {
		// register_player();
	});

	var register_player = function() {
		$("#form_register_player").on("submit", function() {
			var frm = $(this).serialize();
			console.log('form datos:', frm);
			$.ajax({
				method: "POST",
				url: "system/models/add/registrar_jugador.php",
				dataType: 'json',
				data: frm
			}).done(function(resultado) {
				console.log('respuesta::', resultado);
				// if (!resultado.error) {
				if (resultado === "Registro") {
					$("#info").html("<div class='alerta-exito'> ¡Tu registro se realizo con éxito!</div>");
					$("#info").fadeOut(10000, function() {
						$(this).html("");
						$(this).fadeIn(2000);
					});
				} else if (resultado === "Existe") {
					$("#info").html("<div class='alerta-exito'> ¡Tu registro se realizo con éxito!</div>");
					$("#info").fadeOut(10000, function() {
						$(this).html("");
						$(this).fadeIn(2000);
					});
				} else {
					$("#info").html("<div class='alerta-error'> Hubo un error en el proceso por favor volver a probar!!</div>");
					$("#info").fadeOut(5000, function() {
						$(this).html("");
						$(this).fadeIn(2000);
					});
				}
			});
		});
	}
</script>