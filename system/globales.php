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
			<h2 class="title">Globales</h2>

			<?php if (isset($_SESSION['completado'])): ?>
				<div class="alerta-exito">
					<?= $_SESSION['completado'] ?>
				</div>
			<?php elseif (isset($_SESSION['fallo'])): ?>
				<div class="alerta-error">
					<?= $_SESSION['fallo'] ?>
				</div>
			<?php endif; ?>

			<div class="box-tabla">
				<h3 class="subtitle">Equipos Regitrados:</h3>
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
										<?=($dato['descripcion'] ? $dato['descripcion'] : '---'); ?>									
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
											<p class="estado "><?=($dato['estado_id'] == 1 ? 'Inactivo' : 'Activo')  ?></p>											
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
			</div>	
			

			<hr class="mg-bt30">
				

		</div>
		<?php borrarErrores(); ?>
	</div>
	<?php include('layout/footer.php'); ?>	
</body>

</html>