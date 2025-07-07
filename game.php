<?php include('layout/header.php'); ?>  
<body>
  <!-------------- INICIO DE PAGINA -------------->
  <main class="main">    
    <?php include('layout/navbar.php'); ?>		
		<section class="game-banner">
			<div class="boxoverlay">
				<div class="flex align-center center">
					<?php 
						$datos = selectalldatos($con, "partidosbanner");
						if(!empty($datos) && mysqli_num_rows($datos) >= 1):
							while($dato = mysqli_fetch_assoc($datos)):		
					?>		
					<div class="box-texto">
						<h2 class="title"><?=$dato['en_titulo']?></h2>
						<p class="texto"> <?=$dato['en_descripcion']?></p>
					</div>
					<?php 
						endwhile;
					endif; ?>			
				</div>
			</div>
		</section>
		
		<section class="game-container-grid" id="partidos">
			<div class="center">
				<div class="box-filtros container-nowrap space-between">
					<p class="texto">Búsqueda por Filtros</p>
					<div class="container-iconos">
						<img src="assets/img/ico/calendar.png" class="icon-filter" alt="icono calendario">
						<img src="assets/img/ico/location.png" class="icon-filter" alt="icono ubicación">
						<!-- <img src="assets/img/ico/user_black.png" class="icon-filter" alt="icono usuario"> -->
					</div>
				</div>
				<hr>
				<div class="container-grid">
					<?php 
						$datos = listaPartidos($con, 2);
						
						if(!empty($datos) && mysqli_num_rows($datos) >= 1):
							while($dato = mysqli_fetch_assoc($datos)):	
							$newFecha = formatearFecha($dato['fecha_partido']);
							$cantidad = $dato['total_jugadores'] / $dato['total_equipos'];
					?>	
					<div class="card-partido">
						<a href="game-detail.php?id=<?=$dato['id']?>">
							<img src="assets/img/partidos/<?=$dato['imagen1']?>" class="image-card" alt="">
							<div class="flex space-between">
								<div class="box-texto">
									<h2 class="title"><?=$dato['en_nombre']?></h2>
									<p class="texto"><?=$dato['en_direccion']?></p>
									<?php
										$totales = obtenerCantidadGameRoster($con, $dato['id']);
										if (!empty($totales) && mysqli_num_rows($totales) >= 1):
											while ($total = mysqli_fetch_assoc($totales)):
									?>
											<p class="texto-count"><?= $total['Cantidad'] ?>/<?= $dato['total_jugadores'] ?> SPOTS FILLED</p>
									<?php
										endwhile;
									endif; ?>
									<p class="texto-icon"><img src="assets/img/ico/user_black.png"><span><?=$dato['genero']?></span> </p>
									<p class="texto-icon"> <img src="assets/img/ico/calendar.png"><span><?=$newFecha?></span> </p>
									<p class="texto-icon"><img src="assets/img/ico/clock.png"><span><?=$dato['hora']?> |  <?=$cantidad.'v'.$cantidad ?></span> </p>
								</div>						
								<div class="box-precio">
									<div class="texto">$<?=$dato['costo']?></div>
								</div>
							</div>
						</a>
					</div>					
					<?php 
						endwhile;
					endif; ?>		
				</div>

			</div>
		</section>
  </main>
	<?php include('layout/footer.php'); ?>	
    
</body>
</html>

