<?php
	include 'layout/header.php';
	require_once "controller/helpers.php";
	
	if (!isset($_GET)) {
		header("Location:game.php");
	} else {
		$id = $_GET['id'];
	}
	$buscar = isset($_GET['buscar']) ? $_GET['buscar'] : '';
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
									<div class="w100 pd-20">
										<label class="flex mg-bt10">Jugadores Registrados:</label>																					
										<?php
										$datos = obtenerGameRoster($con, $id);
										if (!empty($datos) && mysqli_num_rows($datos) >= 1):
											while ($jugador = mysqli_fetch_assoc($datos)):
												?>															
												<div class="flex align-center justify-between">
													<div class="w50 flex align-center">
														<p > ● <?= $jugador['nombres'] . ' ' . $jugador['apellidos'] ?> - 
															<strong><?= $jugador['posicion'] ?></strong>
														</p>
													</div>
													<form action="models/deletes/deleteUserGame.php" class="box-formulario2" method="post">
														<input type="hidden" name="id" value="<?= $id ?>">
														<div class="flex align-center" id="box-motivo">
															<input type="hidden" name="idDetallePartido" value="<?= $jugador['id'] ?>">
															<div class="box-input mg-btnone mg-r10">
																<input type="text" name="motivo" placeholder="Motivo de baja">
															</div>
															<button type="submit" class="btn btn-azul "><img src="assets/ico/delete.svg"> </button>
														</div>
													</form>
												</div>
										<?php endwhile;
										endif; ?>
											
									</div>
								</div>
								<div class="flex-wrap w100">
									<form class="box-searchs pd-10" method="GET">
										<div class="box-search">
											<label class="bold">Añadir mas Jugadores:</label>
											<input type="search" name="buscar" placeholder="Buscar jugador..." class="input-search mg-lt30" value="<?php echo isset($buscar) ? $buscar : ''; ?>">
											<input type="hidden" name="id" value="<?= $id ?>">
											<button type="submit" class="btn-search">Buscar</button>
										</div>
									</form>
									
									<form action="models/add/registrar_jugador_partido.php" class="box-formulario" method="post">
										<input type="hidden" name="idDetallePartido" value="<?= $id ?>">
										
										<?php
										$jugadores = obtenerListadoUsuaiosLibres($con, $id, $buscar);
										if (!empty($jugadores) && mysqli_num_rows($jugadores) >= 1):
											while ($jugador = mysqli_fetch_assoc($jugadores)):
										?>
												<div class="flex align-center mg-bt10">
													<input type="checkbox" class="mg-r10" name="idUsuario[]" value="<?= $jugador['idUsuario'] ?>"> <?= $jugador['nombres'] . ', ' . $jugador['apellidos'] . ' (' . $jugador['posicion'] . ')' ?><?= $jugador['nivel_interno'] ? ' - Nivel Interno: ' . $jugador['nivel_interno'] : ' - Nivel del Jugador: ' . $jugador['nivel_juego'] ?>
													<input type="hidden" name="posicion" value="<?= $jugador['posicion'] ?>">
												</div>
										<?php endwhile;
										endif; ?>
										<input type="submit" value="Añadir" class="btn2 btn-azul">
									</form>

								</div>
							</div>
						<?php
						endwhile;
					else:
						?>
						<p>No hay jugadores registrados.</p>
						<?php						
					endif;
						?>							
				</div>
				<?php borrarErrores(); ?>
			</div>
		</div>
	