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
				<h2 class="title">Editando Partido - Página Partidos</h2>
				<div class="box-retorno">
					<a href="javascript:history.back()" title="Atras" class="flex align-center">
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
							<form action="models/updates/upgamesoccerplayers.php" class="box-formulario" enctype="multipart/form-data" method="post">
								<div class="w100 container-wrap mg-bt10">
									<input type="hidden" name="id" value="<?= $id ?>">
									<label class="w100">Añadir Jugadores al partido: </label>
									<hr>

									<div class="flex-wrap w100">
										<div class="box-input w50">
											<label for='local'>Selecciona Jugadores</label>
											<?php
											$jugadores = selectDatosEstado($con, "usuarios", 2);
											if (!empty($jugadores) && mysqli_num_rows($jugadores) >= 1):
												while ($jugador = mysqli_fetch_assoc($jugadores)):
											?>
												<div class="flex align-center">
													<input type="checkbox" name=""> Nombre de Jugador
												</div>
											<?php endwhile;
											endif; ?>
										</div>

										<div class="box-input w50">
											<label for='local'>Selecciona Jugadores</label>
											<?php
											$jugadores = selectDatosEstado($con, "usuarios", 2);
											if (!empty($jugadores) && mysqli_num_rows($jugadores) >= 1):
												while ($jugador = mysqli_fetch_assoc($jugadores)):
											?>
												<div class="flex align-center">
													<input type="checkbox" name=""> Nombre de Jugador
												</div>
											<?php endwhile;
											endif; ?>
										</div>
									</div>
									<input type="submit" value="Guardar" class="btn2 btn-azul" >
							</form>
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