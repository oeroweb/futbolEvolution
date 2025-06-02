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
			<h2 class="title">PÁGINA SERVICIOS</h2>
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
				<h3 class="subtitle">Sección Banner:</h3>
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
						$Somos = selectalldatos($con, "serviciosbanner");
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
											<a href="servicesbanner-edit.php?id=<?= $somo['id'] ?>" class="btn btn-ico"><img src="assets/ico/edit.svg"> </a>
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
				<h3 class="subtitle">Sección Nuestros Servicios:</h3>
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
						$Somos = selectalldatos($con, "servicios");
						if (!empty($Somos) && mysqli_num_rows($Somos) >= 1):
							while ($somo = mysqli_fetch_assoc($Somos)):
						?>
								<tr>
									<td><img src="../assets/img/services/<?= $somo['imagen'] ?>" </td>
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
												<a href="models/updates/servicebanner-public.php?id=<?= $somo['id'] ?>" class="btn btn-ico" title="Publicar"><img src="assets/ico/check.svg"></a>
											<?php else : ?>
												<a href="models/updates/servicebanner-private.php?id=<?= $somo['id'] ?>" class="btn btn-ico" title="Quitar Publicación"><img src="assets/ico/x.png"></a>
											<?php endif; ?>
											<a href="services-edit.php?id=<?= $somo['id'] ?>" class="btn btn-ico"><img src="assets/ico/edit.svg"> </a>
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
				<h3 class="subtitle">Solicitud de Servicios :</h3>
				<table>
					<thead>
						<tr>
							<th class="w20">Nombre</th>							
							<th class="w20">Correo</th>
							<th class="w20">Teléfono</th>
							<th class="w20">Fecha</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$Somos = selectalldatos($con, "registro_servicios");
						if (!empty($Somos) && mysqli_num_rows($Somos) >= 1):
							while ($somo = mysqli_fetch_assoc($Somos)):
						?>
								<tr>
									<td> <?= $somo['nombre'] ?> </td>									
									<td><?= $somo['correo'] ?></td>
									<td><?= $somo['telefono'] ?></td>
									<td><?= formatearFecha($somo['fecha'])?></td>
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