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
				<h2 class="title">Añadir Equipos</h2>
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
						<form action="models/add/addGameSoccerTeams.php" class="box-formulario" enctype="multipart/form-data" method="post">
							<?php	for ($i = 0; $i < $dato['total_equipos']; $i++): ?>
								<input type="hidden" name="idDetalle" value="<?= $id ?>">
								<div class="w100 flex-wrap mg-bt10">
									<div class="box-input w50 mg-r10">
										<label for='local'>Selecciona equipo:</label>
										<select name="idequipo[]" class="w100" required>
											<option>Select an option</option>
											<?php
											$partidos = selectDatosEstado($con, "equipos", 2);
											if (!empty($partidos) && mysqli_num_rows($partidos) >= 1):
												while ($partido = mysqli_fetch_assoc($partidos)):
											?>
													<option value="<?= $partido['id'] ?>"><?= $partido['nombre'] ?></option>
											<?php endwhile;
											endif; ?>
										</select>
									</div>
									<div class="box-input w40">
										<label for="" class="w100">Resultados (Goles):</label>
										<input class="w50" type="number" min="0" name="resultado[]" value="0">
									</div>
								</div>
							<?php endfor;	?>
								<input type="submit" value="Guardar Datos" class="btn2 btn-azul">
						</form>
					<?php endwhile;
					endif;
					?>
				</div>

			</div>
			<?php borrarErrores(); ?>
		</div>
		</section>

	</div>
	</main>