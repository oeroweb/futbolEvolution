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
							<form action="models/updates/upgamesoccerteams.php" class="box-formulario" enctype="multipart/form-data" method="post">
								<div class="w100 container-wrap mg-bt10">
									<input type="hidden" name="id" value="<?=$id?>">
									<div class="box-input">
										<label for='local'>Selecciona primer equipo</label>															
										<select name="idequipo1" class="w100">
											<?php 
												$partidos = selectDatosEstado($con, "equipos", 2);
												if(!empty($partidos) && mysqli_num_rows($partidos) >= 1):
													while($partido = mysqli_fetch_assoc($partidos)):		
											?>
												<option value="<?=$partido['id']?>" <?=($partido['id']) == $dato['equipo1_id'] ? 'selected="selected"' : '' ?>><?=$partido['nombre']?></option>
											<?php endwhile; 
											endif; ?>
										</select>								
									</div>								
									<div class="box-input">
										<label for='local'>Selecciona segundo equipo</label>															
										<select name="idequipo2" class="w100">
											<?php 
												$partidos = selectDatosEstado($con, "equipos", 2);
												if(!empty($partidos) && mysqli_num_rows($partidos) >= 1):
													while($partido = mysqli_fetch_assoc($partidos)):		
											?>
												<option value="<?=$partido['id']?>" <?=($partido['id']) == $dato['equipo2_id'] ? 'selected="selected"' : '' ?>><?=$partido['nombre']?></option>
											<?php endwhile; 
											endif; ?>
										</select>								
									</div>
									<div class="flex-wrap">
										<label class="w100">Resultados: </label>
										<div class="box-input w50">
											<label for="" class="w100">Equipo 1: </label>
											<input class="w50" type="number" name="resultado_equipo1" value="0">
										</div>								
										<div class="box-input w50">
											<label for="" class="w100">Equipo 2: </label>
											<input class="w50" type="number" name="resultado_equipo2" value="0">
										</div>								

									</div>
								</div>
								<input type="submit" value="Actualizar Datos" class="btn2 btn-azul" name="editar">

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