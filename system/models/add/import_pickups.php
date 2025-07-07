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
        <td>ID</td>
        <td>Local o Sede</td>
        <td>Fecha Partido</td>
        <td>Genero Partido</td>
        <td>Hora</td>
        <td>Costo</td>        
        <td>Total Jugadores</td>        
        <td>Cantidad Equipos</td>        
        <td>Nivel Partido</td>        
        <td>Beneficio Coach</td>        
        <td>Beneficio MVP</td>        
        <td>Beneficio Parking</td>        
        <td>Beneficio Referee</td>        
        <td>Beneficio Vest</td>       
      </tr>
    </thead>
    <tbody id='tbody_tabla_detalle'>";
    for($row = 2; $row<=$filas;$row++){
      $columna_a = $hoja -> getCell('A'. $row)->getValue();
      $columna_b = $hoja -> getCell('B'. $row)->getValue();
      $columna_c = $hoja -> getCell('C'. $row)->getValue();
      $columna_d = $hoja -> getCell('D'. $row)->getValue();
      $columna_e = $hoja -> getCell('E'. $row)->getValue();
      $columna_f = $hoja -> getCell('F'. $row)->getValue();
      $columna_g = $hoja -> getCell('G'. $row)->getValue();
      $columna_h = $hoja -> getCell('H'. $row)->getValue();
      $columna_i = $hoja -> getCell('I'. $row)->getValue();
      $columna_j = $hoja -> getCell('J'. $row)->getValue();
      $columna_k = $hoja -> getCell('K'. $row)->getValue();
      $columna_l = $hoja -> getCell('L'. $row)->getValue();
      $columna_m = $hoja -> getCell('M'. $row)->getValue();
      $columna_n = $hoja -> getCell('N'. $row)->getValue();
      
      if($columna_a <> ""){
        echo "<tr>";
        echo "<td>" . $columna_a . "</td>";
        echo "<td>" . $columna_b . "</td>";
        echo "<td>" . $columna_c . "</td>";        
        echo "<td>" . $columna_d . "</td>";        
        echo "<td>" . $columna_e . "</td>";        
        echo "<td>" . $columna_f . "</td>";        
        echo "<td>" . $columna_g . "</td>";        
        echo "<td>" . $columna_h . "</td>";        
        echo "<td>" . $columna_i . "</td>";        
        echo "<td>" . $columna_j . "</td>";        
        echo "<td>" . $columna_k . "</td>";        
        echo "<td>" . $columna_l . "</td>";        
        echo "<td>" . $columna_m . "</td>";        
        echo "<td>" . $columna_n . "</td>";        
        echo "</tr>";
      }
    }
    echo "</tbody></table>";
    
  }
?>