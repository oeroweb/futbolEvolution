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
				<h2 class="title">Editando Local/Sede - Página Partidos</h2>
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
					$datos = obtenerdatos($con, "partidoslocales", $id);
					if (!empty($datos) && mysqli_num_rows($datos) >= 1):
						while ($dato = mysqli_fetch_assoc($datos)):
					?>
							<form action="models/updates/upgamelocals.php" class="box-formulario" enctype="multipart/form-data" method="post">
								<div class="w100 container-wrap mg-bt10">
									<div class="box-input">
										<label for="en_nombre">Nombre del Local/sede deportiva: </label>
										<input type="hidden" name="id" value="<?php echo $dato['id']; ?>">
										<input class="" type="text" name="en_nombre" value="<?= $dato['en_nombre'] ?>">
									</div>
									<div class="box-input">
										<label for="en_direccion">Dirección: </label>
										<input class="" type="text" name="en_direccion" value="<?= $dato['en_direccion'] ?>">
									</div>
									<div class="box-galeria-partidos">
										<div class="box-input">
											<label for="">Cambiar Imagen Principal:</label>
											<hr class="w100 mg-bt10">
											<input type="hidden" name="imagen_existente1" value="<?php echo $dato['imagen1']; ?>">
											<img src="../assets/img/partidos/<?php echo $dato['imagen1'] ?>" alt="">
											<input class="" type="file" name="imagen1" accept="image/*">
										</div>
										<?php if ($dato['imagen2']): ?>
											<div class="box-input">
												<label for="">Cambiar Imagen 2:</label>
												<hr class="w100 mg-bt10">
												<input type="hidden" name="imagen_existente2" value="<?php echo $dato['imagen2']; ?>">
												<img src="../assets/img/partidos/<?php echo $dato['imagen2'] ?>" alt="">
												<input class="" type="file" name="imagen2" accept="image/*">
											</div>
										<?php else: ?>
											<div class="box-input">
												<label for="">Añadir Imagen 2:</label>
												<hr class="w100 mg-bt10">
												<input class="" type="file" name="imagen2" accept="image/*">
											</div>
										<?php endif; ?>
										<?php if ($dato['imagen3']): ?>
											<div class="box-input">
												<label for="">Cambiar Imagen 3:</label>
												<hr class="w100 mg-bt10">
												<input type="hidden" name="imagen_existente3" value="<?php echo $dato['imagen3']; ?>">
												<img src="../assets/img/partidos/<?php echo $dato['imagen3'] ?>" alt="">
												<input class="" type="file" name="imagen3" accept="image/*">
											</div>
										<?php else: ?>
											<div class="box-input">
												<label for="">Añadir Imagen 3:</label>
												<hr class="w100 mg-bt10">
												<input class="" type="file" name="imagen3" accept="image/*">
											</div>
										<?php endif; ?>
										<?php if ($dato['imagen4']): ?>
											<div class="box-input">
												<label for="">Cambiar Imagen 4:</label>
												<hr class="w100 mg-bt10">
												<input type="hidden" name="imagen_existente4" value="<?php echo $dato['imagen4']; ?>">
												<img src="../assets/img/partidos/<?php echo $dato['imagen4'] ?>" alt="">
												<input class="" type="file" name="imagen4" accept="image/*">
											</div>
										<?php else: ?>
											<div class="box-input">
												<label for="">Añadir Imagen 4:</label>
												<hr class="w100 mg-bt10">
												<input class="" type="file" name="imagen4" accept="image/*">
											</div>
										<?php endif; ?>
									</div>
									<hr class="w100 mg-bt10">
									<div class="box-input">
										<label for="">Url Google Maps: </label>
										<input class=" " type="text" name="url_google" value="<?= $dato['url_google'] ?>">
									</div>
									<div class="box-input">
										<label for="">Url Apple Maps: </label>
										<input class="w100 " type="text" name="url_apple" value="<?= $dato['url_apple'] ?>">
									</div>
									<?php if ($dato['imagen5']): ?>
										<div class="box-input">
											<label for="">Cambiar Imagen de Mapa:</label>
											<hr class="w100 mg-bt10">
											<input type="hidden" name="imagen_existente5" value="<?php echo $dato['imagen5']; ?>">
											<img src="../assets/img/partidos/<?php echo $dato['imagen5'] ?>" alt="">
											<input class="w100" type="file" name="imagen5" accept="image/*">
										</div>
									<?php else: ?>
										<div class="box-input">
											<label for="">Añadir Imagen de Mapa:</label>
											<hr class="w100 mg-bt10">
											<input class="w100" type="file" name="imagen5" accept="image/*">
										</div>
									<?php endif; ?>
								</div>
								<input type="submit" value="Actualizar Datos" class="btn2 btn-azul" name="editarfase">

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
		<?php include 'layout/footer.php'; ?>
	</div>
	</main>