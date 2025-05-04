
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="Keywords" content="IEI Stella Maris, Inicial Stella Maris, Stella Maris, Institución Stella Maris, sieweb Stella Maris, Sistema de Gestión">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Institución Educativa Inicial Stella Maris, Calle Grito de Huaura 308 La Perla - Peru, Telefono (01) 4206833 / 996 389 391 - Correo ieinavalstellamaris@ieism.edu.pe">
    <meta name="author" content="Oscar Rojas">
    <title>Portal - IEI Stella Maris</title>
    <link href="../images/ico_escudo.png" rel="shortcut icon"/>   
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="assets/css/datatables.min.css"/>
</head>
<style>
.material-symbols-outlined {
  font-variation-settings:
  'FILL' 0,
  'wght' 400,
  'GRAD' 0,
  'opsz' 48
}
</style><body>
  <nav class="navbar">
    <div class="navbar-menu" id="">
      <a class="navbar-brand" href="home.php">Portal IEISM</a>      
    </div>
    <div class="navbar-secion">
      <div class="name-secion">Hola, <strong> Super Admin </strong> <img src="assets/iconos/user.svg" class="icon-navbar" alt="icono"></div>
      <a class="btn" href="logout-user.php"> Salir <img src="assets/iconos/power.svg" class="icon-navbar" alt="icono"> </a>
    </div> 
</nav>
<!-- https://www.w3schools.com/howto/tryit.asp?filename=tryhow_js_accordion -->
  <div class="grid-container storeproduct">
    <div class="aside">
  <ul class="list">
    <li class="item-list">      
      <a>
        <img src="assets/iconos/home.svg" class="icon-img" alt="icono">
        <span>Inicio</span>
      </a>
      <ul class="sublist">
        <li class="item-sublist">
          <a href="home.php">
            <img src="assets/iconos/inventory.svg" class="icon-img" alt="icono">                  
            <span>Panel</span>
          </a>  
        </li>
      </ul>
    </li>
    <li class="item-list">
      <a>
        <img src="assets/iconos/inventory_2.svg" class="icon-img" alt="icono">      
        <span>Productos</span>  
      </a>
      <ul class="sublist">
        <li class="item-sublist">
          <a href="store-product.php">
            <img src="assets/iconos/inventory.svg" class="icon-img" alt="icono">                  
            <span>Lista de Productos</span>
          </a>  
        </li>
        <li class="item-sublist">
          <a href="create-product.php">
            <img src="assets/iconos/add_shopping.svg" class="icon-img" alt="icono">          
            <span>
              Crear Producto
            </span>
          </a>  
        </li>
        <li class="item-sublist">
          <a href="manager-product.php">
            <img src="assets/iconos/shopping_cart.svg" class="icon-img" alt="icono">          
            <span>
            Resgitrar Movimiento

          </span>
        </a>  
        </li>
      </ul>
    </li>
    <li class="item-list">
      <a>
        <img src="assets/iconos/manage_accounts.svg" class="icon-img" alt="icono">            
        <span> Usuarios </span>
      </a>
      <ul class="sublist">
        <li class="item-sublist">
          <a href="list-user.php">
            <img src="assets/iconos/inventory.svg" class="icon-img" alt="icono">                  
            <span>Lista de Ususarios</span>
          </a>  
        </li>
      </ul>
    </li>
  </ul>  
</div>    <div class="container-product">
      <div class="box-breadcrumbs">
        <a class="btn-link" href="javascript:history.back()" title="Atras">
          <span class="material-symbols-outlined">
            arrow_back
          </span>
          Atras
        </a>
        | Productos /
        <a href="#" class="btn-link"> Lista de Usuarios  
          <span class="material-symbols-outlined">
            subdirectory_arrow_left
          </span>
        </a>        
      </div>
      <div class="box-title">
        <h2>Listado de Usuarios</h2>
      </div>
      <div id="info"></div>

       

      <div class="box-tabla">
        <table id="dt_usuarios" class="hover w100">
          <thead>
            <tr>						
              <th class="al-ct w10">id</th>
              <th class="w30">Usuario</th>							
              <th class="w30">Correo</th>
              <th class="w20">Perfil</th>
                              <th class="al-ct w10">Opciones</th>
                          </tr>	
          </thead>
        </table>
      </div>

    </div>
  </div>
    <script src="assets/js/jquery.min.js"></script>
<script src="assets/js/datatables.min.js"></script>

<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>

  <script>
    $(document).ready(function(){
      listar();     
    });

    var listar = function(){
      var table = $("#dt_usuarios").DataTable({
        "dom": 'Bfrtip',
        "buttons": [
          'excel', 'pdf'
        ],
        "scrollX": true,
        "destroy":true,
        "ajax":{
          'method':'POST',
          'url':'models/search/users.php'
        },
        "columns":[
          {"data":"id"},
          {"data":"name"},					
          {"data":"email"},
          {"data":"perfil",
            render: function(data){
              if( data == 1)
              {data = "<span>Super Admin</span>"}
              else if (data == 2)
              {data = "<span>Usuario </span>"}
              return data;
            }
          }
                    ,
          {"defaultContent": "<a class='editar btn-clear' title='Editar'><span class='material-symbols-outlined'>edit</span></a><a class='eliminar btn-clear' title='Borrar'><span class='material-symbols-outlined'>delete</span></a>"}	
				  	
        ],
        "language": idioma_espanol,
        "pageLength":10
      });
      // obtener_data_envio("dt_listaUsuarios tbody", table);		
    }
  
    var idioma_espanol = {
      "sProcessing":     "Procesando...",
      "sLengthMenu":     "Mostrar _MENU_ registros",
      "sZeroRecords":    "No se encontraron resultados",
      "sEmptyTable":     "Ningún dato disponible en esta tabla",
      "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
      "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
      "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
      "sInfoPostFix":    "",
      "sSearch":         "Buscar:",
      "sUrl":            "",
      "sInfoThousands":  ",",
      "sLoadingRecords": "Cargando...",
      "oPaginate": {
          "sFirst":    "Primero",
          "sLast":     "Último",
          "sNext":     "Siguiente",
          "sPrevious": "Anterior"
      },
      "oAria": {
          "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
          "sSortDescending": ": Activar para ordenar la columna de manera descendente"
      }	
    }
  </script>
</body>
</html>
