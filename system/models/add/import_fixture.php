<?php  
  if(is_array($_FILES['archivoexcel']) && count($_FILES['archivoexcel']) >0){
    session_start();
		require_once '../../controller/connection.php';
    require '../../excel/Classes/PHPExcel.php';

    $tmpfname = $_FILES['archivoexcel']['tmp_name'];

    $leerexcel = PHPExcel_IOFactory::createReaderForFile($tmpfname);

    $excelobj = $leerexcel->load($tmpfname);

    $hoja = $excelobj -> getSheet(0);
    $filas = $hoja->getHighestRow();

    echo "<table id='dt_listaEventos' class='tabla-resultados'>
    <thead>
      <tr class='header-tabla'>
        <td>Equipo A</td>
        <td>ResultadosPJ</td>
        <td>Equipo B</td>        
      </tr>
    </thead>
    <tbody id='tbody_tabla_detalle'>";
    for($row = 2; $row<=$filas;$row++){
      $equipo_a = $hoja -> getCell('A'. $row)->getValue();
      $resultados = $hoja -> getCell('B'. $row)->getValue();
      $equipo_b = $hoja -> getCell('C'. $row)->getValue();
      
      if($equipo_a <> ""){
        echo "<tr>";
        echo "<td>" . $equipo_a . "</td>";
        echo "<td>" . $resultados . "</td>";
        echo "<td>" . $equipo_b . "</td>";        
        echo "</tr>";
      }
    }
    echo "</tbody></table>";
    
  }
?>