<?php
include 'layout/header.php';
require_once "controller/helpers.php";
?>

<body>
	<?php require "layout/navbar.php"; ?>
	<div class="grid-container">
		<?php require "layout/aside.php"; ?>
		<div class="container-main">
			<div class="center">
				<h2 class="title">Añadir Liga - Página Ligas</h2>
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
				<div class="box-form">
					<form action="models/add/addleague.php" class="box-formulario" enctype="multipart/form-data" method="post">
						<div class="w100 container-wrap mg-bt10">
							<div class="box-input">
								<label for="nombre">Nombre de la liga: </label>
								<input class="w100 " type="text" name="en_nombre" placeholder="Enter name">
								<input class="w100 " type="text" name="es_nombre" placeholder="Ingresa nombre">
							</div>
							<div class="box-input">
								<label for="nombre">Fecha de la liga: </label>
								<input type="date" name="fecha">
							</div>
							<div class="box-input">
								<label for='local'>Local o Sede</label>
								<select name="idlocal" class="w100">
									<?php
									$partidos = selectDatosEstado($con, "partidoslocales", 2);
									if (!empty($partidos) && mysqli_num_rows($partidos) >= 1):
										while ($partido = mysqli_fetch_assoc($partidos)):
									?>
											<option value="<?= $partido['id'] ?>"><?= $partido['en_nombre'] ?></option>
									<?php endwhile;
									endif; ?>
								</select>
							</div>
							<div class="box-input">
								<label for="descripcion">Descripción: </label>
								<textarea class="w100" name="en_descripcion" rows="3" placeholder="Enter description"></textarea>
								<textarea class="w100" name="es_descripcion" rows="3" placeholder="Ingresa descripción"></textarea>
							</div>
							<div class="box-input">
								<label for="">Añadir Imagen:</label>
								<hr class="w100 mg-bt10">
								<input class="" type="file" name="imagen" accept="image/*" required>
							</div>
						</div>
						<input type="submit" value="Guardar" class="btn2 btn-azul">

					</form>
				</div>
			</div>
		</div>

	</div>

	</div>

</body>

</html>