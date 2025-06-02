<?php
require "layout/header.php";
require_once "controller/controllerUserData.php";
require_once "controller/helpers.php";
// require_once "controller/redireccion.php";
?>
<body>
  <?php require "layout/navbar.php"; ?>
  <div class="grid-container ">
    <?php require "layout/aside.php"; ?>
    <div class="container-main">
      
      <h2 class="title">Usuarios</h2>
      <div id="info"></div>

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
        <table id="dt_usuarios" class="hover w100">
          <thead>
            <tr>
              <th class="al-ct w10">id</th>
              <th class="w10">Nombres</th>
              <th class="w10">Apellidos</th>
              <th class="w10">Posición</th>
              <th class="w10">Nivel de Juego</th>
              <th class="w10">Nivel de FE</th>
              <th class="w10">Nacionalidad</th>
              <th class="w10">Rol</th>
              <th class="al-ct w10">Opciones</th>
            </tr>
          </thead>
        </table>
      </div>

    </div>
  </div>
  <?php include('layout/footer.php'); ?>  

  <script>
    $(document).ready(function() {
      listar();
    });

    var listar = function() {
      var table = $("#dt_usuarios").DataTable({
        "dom": 'Bfrtip',
        "buttons": [
          'excel', 'pdf'
        ],
        "scrollX": true,
        "destroy": true,
        "ajax": {
          'method': 'POST',
          'url': 'models/listusers.php'
        },
        "columns": [{
            "data": "id"
          },
          {
            "data": "nombres"
          },
          {
            "data": "apellidos"
          },
          {
            "data": "posicion"
          },
          {
            "data": "nivel_juego"
          },
          {
            "data": "nivel_interno"
          },
          {
            "data": "nacionalidad",            
          },
          {
            "data": "rol",            
          },
          {
            "defaultContent": "<a class='editar btn-clear' title='Editar'><span class='material-symbols-outlined'>edit</span></a><a class='eliminar btn-clear' title='Borrar'><span class='material-symbols-outlined'>delete</span></a>"
          }

        ],
        "language": idioma_espanol,
        "pageLength": 10
      });
      obtener_data_editar("dt_usuarios tbody", table);		
    }

    var idioma_espanol = {
      "sProcessing": "Procesando...",
      "sLengthMenu": "Mostrar _MENU_ registros",
      "sZeroRecords": "No se encontraron resultados",
      "sEmptyTable": "Ningún dato disponible en esta tabla",
      "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
      "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
      "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
      "sInfoPostFix": "",
      "sSearch": "Buscar:",
      "sUrl": "",
      "sInfoThousands": ",",
      "sLoadingRecords": "Cargando...",
      "oPaginate": {
        "sFirst": "Primero",
        "sLast": "Último",
        "sNext": "Siguiente",
        "sPrevious": "Anterior"
      },
      "oAria": {
        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
      }
    }
  </script>
</body>

</html>