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
        <h2 class="title">Añadir Equipo</h2>
				<div class="box-retorno">
					<a href="javascript:history.back()" title="Atras" class="flex align-center">
						<img src="../assets/img/ico/arrow_back.svg" class="img-ico">Volver 
					</a>
				</div>
        <?php if(isset($_SESSION['completado'])): ?>
					<div class="alerta-exito">
						<?=$_SESSION['completado']?>  
					</div>
				<?php elseif(isset($_SESSION['fallo'])): ?>
					<div class="alerta-error">
						<?=$_SESSION['fallo']?>
					</div>
				<?php endif; ?> 
        <div class="box-form">
          <form action="models/add/addgameteams.php" class="box-formulario" enctype="multipart/form-data" method="post">
						<div class="w100 container-wrap mg-bt10">
							<div class="box-input">
								<label for="nombre">ID</label>
								<?php
									$datos = selectalldatos($con, "equipos");
									if (!empty($datos) && mysqli_num_rows($datos) >= 1):
										$cantidad = mysqli_num_rows($datos);
										$cantidadNueva = $cantidad + 1;
										$nuevoId = formatearId($cantidadNueva, 'E');
								?>
									<input type="text" name="id" value="<?= $nuevoId ?>" readonly>
								<?php endif; ?>
							</div>
							<div class="box-input">
								<label for="nombre">Nombre del Equipo: </label>	
								<input class="w100 " type="text" name="nombre" >
							</div>
							<div class="box-input">
								<label for="descripcion">Descripción: </label>						
								<input class="w100 " type="text" name="descripcion" >
							</div>

							<div class="box-input">								
								<label for="">Añadir Imagen:</label>								
								<input class="w100" type="file" name="imagen" >
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