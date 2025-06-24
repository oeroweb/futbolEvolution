<?php
include 'layout/header.php';
require_once "controller/helpers.php";

if (!isset($_GET)) {
	header("Location:game.php");
} else {
	$id = $_GET['id'];
}
?>

<body>
	<?php require "layout/navbar.php"; ?>
	<div class="grid-container">
		<?php require "layout/aside.php"; ?>

		<div class="container-main">
			<div class="center">
				<h2 class="title">Editando Partidos</h2>
				<div class="box-retorno">
					<a href="game.php" title="Atras" class="flex align-center">
						<img src="../assets/img/ico/arrow_back.svg" class="img-ico">Volver
					</a>
				</div>

				<?php if (isset($_SESSION['completado'])): ?>
					<div class="alerta-exito">
						<?= $_SESSION['completado'] ?>
					</div>
				<?php elseif (isset($_SESSION['fallo'])): ?>
					<div class="alerta-error">
						<?= $_SESSION['fallo'] ?>
					</div>
				<?php endif; ?>

				<div class="container-wrap w100">
					<?php
					$datos = detallePartido($con, $id);
					if (!empty($datos) && mysqli_num_rows($datos) >= 1):
						while ($dato = mysqli_fetch_assoc($datos)):
					?>
							<div class="w100 container-wrap mg-bt10">
								<h2 class="w100">Jugadores del Partido</h2>
								<hr>
								<div class="flex-wrap w100 box-resultados">
									<div class="w50 pd-20">
										<label class="flex mg-bt10">Jugadores Registrados:</label>
										<ul class="pd-lt30">
											<?php
											$datos = obtenerGameRoster($con, $id);
											if (!empty($datos) && mysqli_num_rows($datos) >= 1):
												while ($jugador = mysqli_fetch_assoc($datos)):
											?>
													<li class="mg-bt10"><?= $jugador['nombres'] . ' ' . $jugador['apellidos'] ?> - <strong><?= $jugador['posicion'] ?></strong></li>
											<?php endwhile;
											endif; ?>
										</ul>
									</div>
								</div>
								<div class="flex-wrap w100">									
										<form action="models/add/registrar_jugador_partido.php" class="box-formulario" enctype="multipart/form-data" method="post">
											<label>Añadir mas Jugadores:</label>
											<input type="hidden" name="idDetallePartido" value="<?= $id ?>">
											<?php
											$jugadores = obtenerListadoUsuaiosLibres($con);
											if (!empty($jugadores) && mysqli_num_rows($jugadores) >= 1):
												while ($jugador = mysqli_fetch_assoc($jugadores)):
											?>
													<div class="flex align-center mg-bt10">
														<input type="checkbox" name="idUsuario" value="<?= $jugador['id'] ?>"> <?= $jugador['nombres'] . ', ' . $jugador['apellidos'] . '(' . $jugador['posicion'] . ') - Nivel Interno: ' . $jugador['nivel_interno'] ?>
														<input type="hidden" name="posicion" value="<?= $jugador['posicion'] ?>">
													</div>
											<?php endwhile;
											endif; ?>
											<input type="submit" value="Guardar" class="btn2 btn-azul">
										</form>
									
								</div>

						<?php
						endwhile;
					endif;
						?>
							</div>
				</div>
				<?php borrarErrores(); ?>
			</div>
			</section>

		</div>
		</main>