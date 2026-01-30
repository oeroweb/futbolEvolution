<?php
require "layout/header.php";
require_once "controller/controllerUserData.php";
require_once "controller/helpers.php";
// require_once "controller/redireccion.php";
?>

<body>
	<?php require "layout/navbar.php"; ?>
	<div class="grid-container">
		<?php require "layout/aside.php"; ?>
		<div class="container-main">
			<h2 class="title">PÁGINA PARTIDOS</h2>

			<?php if (isset($_SESSION['completado'])): ?>
				<div class="alerta-exito">
					<?= $_SESSION['completado'] ?>
				</div>
			<?php elseif (isset($_SESSION['fallo'])): ?>
				<div class="alerta-error">
					<?= $_SESSION['fallo'] ?>
				</div>
			<?php endif; ?>

			<div class="box-tabla ">
				<h3 class="subtitle">Sección Banner:</h3>
				<table>
					<thead>
						<tr>
							<th class="w30">Imagen</th>
							<th class="w20">Titulo</th>
							<th class="w30">Descripción</th>
							<th class="w20">Opciones</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$datos = selectalldatos($con, "partidosbanner");
						if (!empty($datos) && mysqli_num_rows($datos) >= 1):
							while ($dato = mysqli_fetch_assoc($datos)):
						?>
								<tr>
									<td>
										<img class="img-list" src="../assets/img/partidos/<?= $dato['imagen'] ?>" alt="img-partido-banner">
									</td>
									<td><strong>EN: </strong> <?= $dato['en_titulo'] ?> <br> <strong>ES: </strong><?= $dato['es_titulo'] ?></td>
									<td><strong>EN: </strong><?= $dato['en_descripcion'] ?> <br><strong>ES: </strong><?= $dato['es_descripcion'] ?></td>
									<td>
										<div class="flex justify-center">
											<a href="gamebanner-edit.php?id=<?= $dato['id'] ?>" class="btn btn-ico">
												<img src="assets/ico/edit.svg">
											</a>
										</div>
									</td>
								</tr>
						<?php
							endwhile;
						endif; ?>
					</tbody>
				</table>
			</div>

			<hr class="mg-bt30">

			<div class="box-tabla ">
				<h3 class="subtitle">Sección Partidos Actuales:</h3>
				<a href="gamesoccer-add.php" class="btn btn-azul" title="Añadir"><img src="assets/ico/plus.png"> Añadir</a>
				<a href="pickups-excel.php" class="btn btn-azul" title="Subir partidos">
					<img src="assets/ico/upload_white.svg" class="img-ico"> Subir Partidos - Pickups
				</a>
				<table>
					<thead>
						<tr>
							<th class="w10">ID</th>
							<th class="w10">Imagen</th>
							<th class="w10">Campo/Sede</th>
							<th class="w10">Fecha</th>
							<th class="w10">Hora</th>
							<th class="w10">Genero</th>
							<th class="w10">Cant. Jugadores y Equipos</th>
							<th class="w10">Versus</th>
							<th class="w10">Costo</th>
							<th class="w10">Opciones</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$datos = listaPartidos($con, 2);
						if (!empty($datos) && mysqli_num_rows($datos) >= 1):
							while ($dato = mysqli_fetch_assoc($datos)):
								$cantidad = $dato['total_jugadores'] / $dato['total_equipos'];
								$newFecha = formatearFecha($dato['fecha_partido']);
						?>
								<tr>
									<td class="bold"><?= $dato['id'] ?> </td>
									<td>
										<img class="img-list" src="../assets/img/partidos/<?= $dato['imagen1'] ?>" alt="img-partido">
									</td>
									<td><?= $dato['en_nombre'] ?> </td>
									<td><?= $newFecha ?> </td>
									<td><?= $dato['hora'] ?></td>
									<td><?= $dato['genero'] ?></td>
									<td><?= $dato['total_jugadores'] . ' / ' . $dato['total_equipos'] ?> </td>
									<td><?= $cantidad . 'v' . $cantidad ?></td>
									<td>$<?= $dato['costo'] ?></td>
									<td>
										<div class="flex justify-center">
											<a href="gamesoccer-edit.php?id=<?= $dato['id'] ?>" class="btn btn-ico" title="Editar"><img src="assets/ico/edit.svg"> </a>
											<?php
											$partidos = obtenerDatosPorCampo($con, "detallepartido_equipos", "detallepartido_id", $dato['id']);
											if (!empty($partidos) && mysqli_num_rows($partidos) >= 1):
											?>
												<a href="gamesoccerteams.php?id=<?= $dato['id'] ?>" class="btn btn-ico" title="Editar Equipos"><img src="assets/ico/edit_2.svg"></a>
											<?php else: ?>
												<a href="gamesoccerteams_add.php?id=<?= $dato['id'] ?>" class="btn btn-ico" title="Añadir Equipos"><img src="assets/ico/plus.svg"> </a>
											<?php endif; ?>
											<a href="gamesoccerplayers.php?id=<?= $dato['id'] ?>" class="btn btn-ico" title="Añadir Jugadores"><img src="assets/ico/plus-add.svg"> </a>
										</div>
									</td>
								</tr>
						<?php
							endwhile;
						endif; ?>
					</tbody>
				</table>
			</div>

			<!-- <div class="box-tabla">
				<h3 class="subtitle">Sección Equipos:</h3>
				<a href="gameteams-add.php" class="btn btn-azul" title="Añadir"><img src="assets/ico/plus.png"> Añadir</a>

				<table>
					<thead>
						<tr>
							<th class="w10">ID</th>
							<th class="w20">Nombre</th>
							<th class="w20">Descripción</th>
							<th class="w10">Imagen</th>
							<th class="w20">Estado</th>
							<th class="w20">Opciones</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$datos = selectDatosNoEliminados($con, "equipos");
						if (!empty($datos) && mysqli_num_rows($datos) >= 1):
							while ($dato = mysqli_fetch_assoc($datos)):
						?>
								<tr>
									<td class="bold"><?= $dato['id'] ?> </td>
									<td><?= $dato['nombre'] ?> </td>
									<td>
										<?= ($dato['descripcion'] ? $dato['descripcion'] : '---'); ?>									
								 </td>										
									<td>
										<?php if ($dato['imagen']): ?>
											<img class="img-beneficio" src="../assets/img/equipos/<?= $dato['imagen'] ?>" alt="logo del equipo">
										<?php else: ?>
											<div class="sinimagen"><?= $dato['nombre'] ?> </div>										
										<?php endif; ?>
									</td>
									<td>
										<div class="flex-col align-center">
											<p class="estado "><?= ($dato['estado_id'] == 1 ? 'Inactivo' : 'Activo')  ?></p>											
										</div>
									</td>
									<td>
										<div class="flex justify-center">
											<?php if ($dato['estado_id'] == 1) : ?>
												<a href="models/updates/gameteams-public.php?id=<?= $dato['id'] ?>" class="btn btn-ico" title="Publicar"><img src="assets/ico/check.svg"></a>
											<?php else : ?>
												<a href="models/updates/gameteams-private.php?id=<?= $dato['id'] ?>" class="btn btn-ico" title="Quitar Publicación"><img src="assets/ico/x.png"></a>
											<?php endif; ?>
											<a href="gameteams-edit.php?id=<?= $dato['id'] ?>" class="btn btn-ico"><img src="assets/ico/edit.svg"> </a>
											<a href="models/deletes/gameteams.php?id=<?= $dato['id'] ?>" class="btn btn-rojo btn-ico"><img src="assets/ico/delete.svg"> </a>
										</div>
									</td>
								</tr>
						<?php
							endwhile;
						endif; ?>
					</tbody>
				</table>
			</div>			 -->

		</div>
		<?php borrarErrores(); ?>
	</div>
</body>

</html>