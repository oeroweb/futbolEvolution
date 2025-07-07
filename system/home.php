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
			<h2 class="title">PÁGINA INICIO</h2>
			<?php if (isset($_SESSION['completado'])): ?>
				<div class="alerta-exito">
					<?= $_SESSION['completado'] ?>
				</div>
			<?php elseif (isset($_SESSION['fallo'])): ?>
				<div class="alerta-error">
					<?= $_SESSION['fallo'] ?>
				</div>
			<?php endif; ?>

			<div class="box-tabla mg-bt20">
				<h3 class="subtitle">Sección Slider Gancho:</h3>
				<a href="homeslider-add.php" class="btn btn-azul" title="Añadir"><img src="assets/ico/plus.png"> Añadir</a>

				<table>
					<thead>
						<tr>
							<th class="w20">Imagen</th>
							<th class="w20">Titulo</th>
							<th class="w30">Descripción</th>
							<th class="w10">Estado</th>
							<th class="w10">Opciones</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$Somos = selectalldatos($con, "homeslider");
						if (!empty($Somos) && mysqli_num_rows($Somos) >= 1):
							while ($somo = mysqli_fetch_assoc($Somos)):
						?>
								<tr>
									<td><img class="img-list" src="../assets/img/slides/<?= $somo['imagen'] ?>" alt="img-slider"> </td>
									<td><strong>EN: </strong> <?= $somo['en_titulo'] ?> <br> <strong>ES: </strong><?= $somo['es_titulo'] ?></td>
									<td><strong>EN: </strong><?= $somo['en_descripcion'] ?> <br><strong>ES: </strong><?= $somo['es_descripcion'] ?></td>
									<td>
										<div class="flex-col align-center">
											<?php if ($somo['estado_id'] == 1) : ?>
												<p class="estado">No Publicado</p>
											<?php else : ?>
												<p class="estado">Publicado</p>
											<?php endif; ?>
										</div>
									</td>
									<td>
										<div class="flex justify-center">
											<?php if ($somo['estado_id'] == 1) : ?>
												<a href="models/updates/homeslider-public.php?id=<?= $somo['id'] ?>" class="btn btn-ico" title="Publicar"><img src="assets/ico/check.svg"></a>
											<?php else : ?>
												<a href="models/updates/homeslider-private.php?id=<?= $somo['id'] ?>" class="btn btn-ico" title="Quitar Publicación"><img src="assets/ico/x.png"></a>
											<?php endif; ?>
											<a href="homeslider-edit.php?id=<?= $somo['id'] ?>" class="btn btn-ico"><img src="assets/ico/edit.svg"> </a>
											<!-- <a href="deletes/homebanner-delete.php?id=<? //=$somo['id']
																																			?>" class="btn btn-rojo btn-ico"><img src="assets/ico/delete.svg"> </a> -->
										</div>
									</td>
								</tr>
						<?php
							endwhile;
						endif; ?>
					</tbody>
				</table>
			</div>

			<div class="box-tabla mg-bt20">
				<h3 class="subtitle">Sección Partidos Gancho:</h3>
				<a href="homeparties-excel.php" class="btn btn-azul" title="Subir partidos">
					<img src="assets/ico/upload.svg"> Añadir
				</a>
				<table>
					<thead>
						<tr>
							<th class="w20">Titulo</th>
							<th class="w30">Descripción</th>
							<th class="w10">Estado</th>
							<th class="w10">Opciones</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$Somos = selectalldatos($con, "homepartidos");
						if (!empty($Somos) && mysqli_num_rows($Somos) >= 1):
							while ($somo = mysqli_fetch_assoc($Somos)):
						?>
								<tr>
									<td><strong>EN: </strong> <?= $somo['en_titulo'] ?> <br> <strong>ES: </strong><?= $somo['es_titulo'] ?></td>
									<td><strong>EN: </strong><?= $somo['en_descripcion'] ?> <br><strong>ES: </strong><?= $somo['es_descripcion'] ?></td>
									<td>
										<div class="flex-col align-center">
											<?php if ($somo['estado_id'] == 1) : ?>
												<p class="estado">No Publicado</p>
											<?php else : ?>
												<p class="estado">Publicado</p>
											<?php endif; ?>
										</div>
									</td>
									<td>
										<div class="flex justify-center">											
											<a href="homeparties-edit.php?id=<?= $somo['id'] ?>" class="btn btn-ico"><img src="assets/ico/edit.svg"> </a>
										</div>
									</td>
								</tr>
						<?php
							endwhile;
						endif; ?>
					</tbody>
				</table>
			</div>

			<div class="box-tabla mg-bt20">
				<h3 class="subtitle">Sección Gancho Juega con Nosotros:</h3>
				<table>
					<thead>
						<tr>
							<th class="w20">Imagen</th>
							<th class="w20">Titulo</th>
							<th class="w20">SubTitulo</th>
							<th class="w20">Descripción</th>
							<th class="w10">Estado</th>
							<th class="w10">Opciones</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$datos = selectalldatos($con, "homenosotros");
						if (!empty($datos) && mysqli_num_rows($datos) >= 1):
							while ($dato = mysqli_fetch_assoc($datos)):
						?>
								<tr>
									<td><img class="img-list" src="../assets/img/home/<?= $dato['imagen'] ?>" alt="img-tabs"> </td>
									<td><strong>EN: </strong> <?= $dato['en_titulo'] ?> <br> <strong>ES: </strong><?= $dato['es_titulo'] ?></td>
									<td><strong>EN: </strong> <?= $dato['en_subtitulo'] ?> <br> <strong>ES: </strong><?= $dato['es_titulo'] ?></td>
									<td><strong>EN: </strong> <?= $dato['en_descripcion'] ?> <br><strong>ES: </strong><?= $dato['es_descripcion'] ?></td>
									<td>
										<div class="flex-col align-center">
											<?php if ($dato['estado_id'] == 1) : ?>
												<p class="estado ">No Publicado</p>
											<?php else : ?>
												<p class="estado ">Publicado</p>
											<?php endif; ?>
										</div>
									</td>
									<td>
										<div class="flex justify-center">
											<a href="homenosotros-edit.php?id=<?= $dato['id'] ?>" class="btn btn-ico"><img src="assets/ico/edit.svg"> </a>
										</div>
									</td>
								</tr>
						<?php
							endwhile;
						endif; ?>
					</tbody>
				</table>
			</div>

			<div class="box-tabla mg-bt20">
				<h3 class="subtitle">Sección Gancho Ligas:</h3>
				<table>
					<thead>
						<tr>
							<th class="w20">Titulo</th>
							<th class="w30">Descripción</th>
							<th class="w10">Estado</th>
							<th class="w10">Opciones</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$datos = selectalldatos($con, "homebanner");
						if (!empty($datos) && mysqli_num_rows($datos) >= 1):
							while ($dato = mysqli_fetch_assoc($datos)):
						?>
								<tr>
									<td><strong>EN: </strong> <?= $dato['en_titulo'] ?> <br> <strong>ES: </strong><?= $dato['es_titulo'] ?></td>
									<td><strong>EN: </strong> <?= $dato['en_descripcion'] ?> <br><strong>ES: </strong><?= $dato['es_descripcion'] ?></td>
									<td>
										<div class="flex-col align-center">
											<?php if ($dato['estado_id'] == 1) : ?>
												<p class="estado ">No Publicado</p>
											<?php else : ?>
												<p class="estado ">Publicado</p>
											<?php endif; ?>
										</div>
									</td>
									<td>
										<div class="flex justify-center">
											<a href="homebanner-edit.php?id=<?= $dato['id'] ?>" class="btn btn-ico"><img src="assets/ico/edit.svg"> </a>
										</div>
									</td>
								</tr>
						<?php
							endwhile;
						endif; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<?php borrarErrores(); ?>
	<?php include('layout/footer.php'); ?>	
</body>

</html>