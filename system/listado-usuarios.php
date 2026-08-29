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


      <div class="box-tabla-datatable">
        <table id="dt_usuarios" class="hover w100">
          <thead>
            <tr>
              <th class="al-ct w10">id</th>
              <th class="w10">Name</th>
              <th class="w10">Last Name</th>
              <th class="w10">Gender</th>
              <th class="w10">Phone</th>
              <th class="w10">Email</th>
              <th class="w10">Position</th>
              <th class="w10">Position Secondary</th>
              <th class="w10">Skill Level</th>
              <th class="w10">Dominant Foot</th>
              <th class="w10">Country</th>
              <th class="w10">Rol</th>
              <th class="w10">Opciones</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>

  <!-- ----- EDITAR  ----- -->
  <div class="modal" id="modal1">
    <div class="body-modal">
      <form action="" method="post" name="from_actualizar" class="form" id="frm_actualizar" onsubmit="event.preventDefault(); ">
        <h2 class="title mg-bt10">Modificar datos Principales</h2>
        <hr>
        <div class="container-modal">
          <input  type="hidden" name="id" id="id" readonly>
          <div class=" box-input">
            <label for="nombre">Name</label>
            <input type="text" name="nombre" id="nombre" required>
          </div>
          <div class="box-input">
            <label for="">Last Name</label>
            <input type="text" name="apellidos" id="apellidos" required>
          </div>
          <div class="box-input">
            <label for="genero">Gender: </label>
            <select name="genero" id="genero" class="w100" required>
              <option value="Female">Female</option>
              <option value="Male">Male</option>
            </select>
          </div>
          <div class="box-input">
            <label for="fecha">Date of Birth: </label>
            <input class="w100 " type="date" name="fecha" id="fecha" required>
          </div>
          <div class="box-input">
            <label for="nacionalidad">Country: </label>
            <select name="nacionalidad" id="nacionalidad" class="w100" required>              
              <?php
              $datos = selectalldatos($con, 'paises');
              if (!empty($datos) && mysqli_num_rows($datos) >= 1):
                while ($dato = mysqli_fetch_assoc($datos)):
              ?>
                  <option value="<?=$dato['id']?>"><?= $dato['nombre'] ?></option>
              <?php endwhile;
              endif; ?>
            </select>
          </div>
          <div class="box-input">
            <label for="telefono">Phone: </label>
            <input class="w100 " type="number" name="telefono" id="celular" required>
          </div>
          <div class="box-input">
            <label for="email">Correo: </label>
            <input type="email" name="email" id="email" readonly>
          </div>
          <div class="box-input">
            <label>Password: </label>            
            <input class="w100" type="text" name="password" id="password" onkeyup="validaPassword();" onkeydown="showHide();" required>
          </div>
          <div class="box-input">
            <label>Cambiar de Rol</label>
            <select name="rol" id="rol" required>  
              <option value="admin">Admin</option>              
              <option value="jugador">Jugador</option>             
            </select>
          </div>         
        </div>
        <hr>
        <div class="box-botones">
          <button type="submit" class="btn2 btn-azul">Actualizar</button>
          <button type="button" class="btn2 btn-azul-outline" onclick="cerrarModal()"> Cancelar</button>
        </div>
      </form>
    </div>
  </div>
  
  <div class="modal" id="modal3">
    <div class="body-modal">
      <form action="" method="post" name="from_actualizar" class="form" id="frm_actualizar_habilidades" onsubmit="event.preventDefault(); ">
        <h2 class="title mg-bt10">Modificar Habilidades del Usuario</h2>
        <hr>
        <div class="container-modal">
          <input type="hidden" name="id" id="id" readonly>
          <input type="hidden" name="nombre" id="nombre" readonly>
          <input type="hidden" name="apellidos" id="apellidos" readonly>
          <input type="hidden" name="email" id="email" readonly>
          <input type="hidden" name="password" id="clave" readonly>
          <div class=" box-input">
            <label for="nivel_fb">Posición Interna (FE)</label>
            <input type="text" name="nivel_fb" id="nivel_fb">
          </div>          
          <div class="box-input">
            <label for="nivel">Nivel de juego: </label>
            <select name="nivel" id="nivel" class="w100" required>
              <option>Select an option</option>
              <option>Rookie</option>
              <option>Intermediate</option>
              <option>Advanced</option>
            </select>
          </div>
          <div class="box-input">
            <label for="posicion">Posición: </label>
            <select name="posicion1" id="posicion1" class="w100" required>
              <option>Select an option</option>
              <option>GK</option>
              <option>DEF</option>
              <option>MID</option>
              <option>ATK</option>
            </select>
          </div>
          <div class="box-input">
            <label for="posicion2">Posición secundaria: </label>
            <select name="posicion2" id="posicion2" class="w100">
              <option>Select an option</option>
              <option>GK</option>
              <option>DEF</option>
              <option>MID</option>
              <option>ATK</option>
            </select>
          </div>
          <div class="box-input">
            <label for="pie">Pie dominante: </label>
            <select name="pie" id="pie" class="w100" required>
              <option>Select an option</option>
              <option>Left</option>
              <option>Right</option>
            </select>
          </div>
          <div class=" box-input">
            <label for="partidos">Partidos Jugados</label>
            <input type="number" name="partidos" id="partidos" value="0">
          </div>
          <div class=" box-input">
            <label for="mvp">MVP Totales</label>
            <input type="number" name="mvp" id="mvp" value="0">
          </div>             
        </div>
        <hr>
        <div class="box-botones">
          <button type="submit" class="btn2 btn-azul">Actualizar</button>
          <button type="button" class="btn2 btn-azul-outline" onclick="cerrarModal()"> Cancelar</button>
        </div>
      </form>
    </div>
  </div>

  <!-- ----- ELIMINAR  ----- -->
  <div class="modal hidden" id="modal2">
    <div class="body-modal">
      <form action="" method="post" name="form_eliminar" class="form" id="form_eliminar" onsubmit="event.preventDefault();">
        <h2 class="title">¿Estas de Seguro de Eliminar?</h2>
        <hr>
        <div class="container-modal-delete">
          <p class="mensaje">¡No podrás revertir esto!</p>
          <input type="hidden" name="id" id="id">
          <div class="box-nombre w100" id="box-nombre"></div>
        </div>
        <div class="box-botones">
          <button type="submit" class="btn2 btn-azul">Borrar</button>
          <button type="button" class="btn2 btn-azul-outline" onclick="cerrarModal()"> Cancelar</button>
        </div>
      </form>
    </div>
  </div>

  <?php include('layout/footer.php'); ?>

  <script>
    $(document).ready(function() {
      listar();
      actualizar();
      actualizar_habilidades();
      eliminar();
    });

    function cerrarModal() {
      $("#modal1").fadeOut();
      $("#modal2").fadeOut();
      $("#modal3").fadeOut();
    };

    var actualizar = function() {
      $("#frm_actualizar").on("submit", function() {
        //e.preventDefault();
        var frm = $(this).serialize();
        $.ajax({
          method: "POST",
          url: "controller/upusuario.php",
          dataType: 'json',
          data: frm
        }).done(function(resultado) {
          if (!resultado.error) {
            $("#info").html("<div class='alerta-exito'><i class='far fa-check-circle'> </i>Se actualizaron los datos con éxito!</div>");
            $("#info").fadeOut(5000, function() {
              $(this).html("");
              $(this).fadeIn(2000);
            });
            cerrarModal();
            listar();
          } else {
            $("#info").html("<div class='alerta-error'><i class='fas fa-times-circle'></i> Hubo un error en el proceso por favor volver a probar!!</div>");
            $("#info").fadeOut(5000, function() {
              $(this).html("");
              $(this).fadeIn(2000);
            });
            cerrarModal();
          }
        });
      });
    }

    var actualizar_habilidades = function() {
      $("#frm_actualizar_habilidades").on("submit", function() {
        var frm = $(this).serialize();
        
        $.ajax({
          method: "POST",
          url: "controller/upusuario_habi.php",
          dataType: 'json',
          data: frm
        }).done(function(resultado) {
          if (!resultado.error) {
            $("#info").html("<div class='alerta-exito'><i class='far fa-check-circle'> </i>Se actualizaron los datos con éxito!</div>");
            $("#info").fadeOut(5000, function() {
              $(this).html("");
              $(this).fadeIn(2000);
            });
            cerrarModal();
            listar();
          } else {
            $("#info").html("<div class='alerta-error'><i class='fas fa-times-circle'></i> Hubo un error en el proceso por favor volver a probar!!</div>");
            $("#info").fadeOut(5000, function() {
              $(this).html("");
              $(this).fadeIn(2000);
            });
            cerrarModal();
          }
        });
      });
    }

    var eliminar = function() {
      $("#form_eliminar").on("submit", function() {
        $.ajax({
          method: "POST",
          url: "models/deletes/usuarios.php",
          dataType: "json",
          data: $(this).serialize()
        }).done(function(resultado) {

          if (!resultado.error) {
            $("#info").html("<div class='alerta-exito'><i class='far fa-check-circle'> </i> Se elimino con éxito!</div>");
            $("#info").fadeOut(5000, function() {
              $(this).html("");
              $(this).fadeIn(3000);
            });
            cerrarModal();
            listar();
          } else {
            $("#info").html("<div class='alerta-error'><i class='fas fa-times-circle'></i> Hubo un error en el proceso por favor volver a intentar!!</div>");
            $("#info").fadeOut(5000, function() {
              $(this).html("");
              $(this).fadeIn(3000);
            });
            cerrarModal();
          }
        });
      });
    }

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
            "data": "genero"
          },
          {
            "data": "telefono"
          },
          {
            "data": "email"
          },
          {
            "data": "posicion"
          },
          {
            "data": "posicion_dos"
          },
          {
            "data": "nivel_juego"
          },
          {
            "data": "pie_dominante"
          },
          {
            "data": "pais"
          },
          {
            "data": "rol"
          },
          {
            "defaultContent": "<div class='flex'><a class='editar btn-ico' title='Editar Perfil'><span class='material-symbols-outlined'>edit</span></a><a class='habilidades btn-ico' title='Editar Habilidades'><span class='material-symbols-outlined'>edit_square</span></a><a class='eliminar btn-ico' title='Borrar'><span class='material-symbols-outlined'>delete</span></a></div>"
          }
        ],
        "language": idioma_espanol,
        "pageLength": 50
      });
      obtener_data_editar("dt_usuarios tbody", table);
      obtener_data_editar_habilidades("dt_usuarios tbody", table);
      obtener_data_eliminar("dt_usuarios tbody", table);
    }

    var obtener_data_editar = function(tbody, table) {
      $(document).on("click", ".editar", function() {
        var data = table.row($(this).parents("tr")).data();       
        $("#modal1").fadeIn();
        $("#frm_actualizar #nombre").focus();
        var id = $("#frm_actualizar #id").val(data.id);
        nombre = $("#frm_actualizar #nombre").val(data.nombres);
        apellidos = $("#frm_actualizar #apellidos").val(data.apellidos);
        genero = $("#frm_actualizar #genero").val(data.genero);
        fecha = $("#frm_actualizar #fecha").val(data.fec_nac);
        celular = $("#frm_actualizar #celular").val(data.telefono);
        correo = $("#frm_actualizar #email").val(data.email);
        password = $("#frm_actualizar #password").val(data.clave);
        pais = $("#frm_actualizar #nacionalidad").val(data.nacionalidad);
        rol = $("#frm_actualizar #rol").val(data.rol);
        claveActual = $("#frm_actualizar #clave-actual").val(data.clave);        
      });
    }
    var obtener_data_editar_habilidades = function(tbody, table) {
      $(document).on("click", ".habilidades", function() {
        var data = table.row($(this).parents("tr")).data();
        console.log(data);
        $("#modal3").fadeIn();
        $("#frm_actualizar_habilidades #nivel_fb").focus();
        var id = $("#frm_actualizar_habilidades #id").val(data.id);
        nombre = $("#frm_actualizar_habilidades #nombre").val(data.nombres);
        apellidos = $("#frm_actualizar_habilidades #apellidos").val(data.apellidos);
        nivel_interno = $("#frm_actualizar_habilidades #nivel_fb").val(data.nivel_interno);
        nivel_juego = $("#frm_actualizar_habilidades #nivel").val(data.nivel_juego);
        posicion = $("#frm_actualizar_habilidades #posicion1").val(data.posicion);
        posicion2 = $("#frm_actualizar_habilidades #posicion2").val(data.posicion_dos);
        email = $("#frm_actualizar_habilidades #email").val(data.email);
        email = $("#frm_actualizar_habilidades #clave").val(data.clave);
        pie = $("#frm_actualizar_habilidades #pie").val(data.pie_dominante);        
        partidos = $("#frm_actualizar_habilidades #partidos").val(data.partidos_jugados);
        mvp = $("#frm_actualizar_habilidades #mvp").val(data.mvp);
      });
    }

    var obtener_data_eliminar = function(tbody, table) {
      $(document).on("click", ".eliminar", function() {
        var data = table.row($(this).parents("tr")).data();
        $("#modal2").fadeIn();
        var id = $("#form_eliminar #id").val(data.id);
        nombre = $("#form_eliminar #box-nombre").html('<p class="texto">Borrar al usuario <strong> ' + data.nombres + ' ' + data.apellidos + '</strong></p>');
      });
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