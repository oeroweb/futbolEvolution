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
			<h2 class="title">PÁGINA SPONSOR</h2>
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
				<h3 class="subtitle">Registros :</h3>
				<table>
					<thead>
						<tr>
							<th class="w20">Nombre</th>
							<th class="w20">Capitan</th>
							<th class="w20">Liga</th>
							<th class="w20">Correo</th>
							<th class="w20">Telefono</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$Somos = selectalldatos($con, "sponsor");
						if (!empty($Somos) && mysqli_num_rows($Somos) >= 1):
							while ($somo = mysqli_fetch_assoc($Somos)):
						?>
								<tr>
									<td> <?= $somo['nombre'] ?> </td>
									<td><?= $somo['capitan'] ?> </td>
									<td><?= $somo['liga'] ?></td>
									<td><?= $somo['correo'] ?></td>
									<td><?= $somo['telefono'] ?></td>
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