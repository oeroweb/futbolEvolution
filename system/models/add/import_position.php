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
        <td>Club</td>
        <td>PJ</td>
        <td>G</td>
        <td>E</td>
        <td>P</td>
        <td>GF</td>
        <td>GC</td>
        <td>DG</td>
        <td>PTS</td>
      </tr>
    </thead>
    <tbody id='tbody_tabla_detalle'>";
    for($row = 2; $row<=$filas;$row++){
      $equipo = $hoja -> getCell('A'. $row)->getValue();
      $pj = $hoja -> getCell('B'. $row)->getValue();
      $g = $hoja -> getCell('C'. $row)->getValue();
      $e = $hoja -> getCell('D'. $row)->getValue();
      $p = $hoja -> getCell('E'. $row)->getValue();
      $gf = $hoja -> getCell('F'. $row)->getValue();
      $gc = $hoja -> getCell('G'. $row)->getValue();
      $dg = $hoja -> getCell('H'. $row)->getValue();
      $pts = $hoja -> getCell('I'. $row)->getValue();
      if($equipo <> ""){
        echo "<tr>";
        echo "<td>" . $equipo . "</td>";
        echo "<td>" . $pj . "</td>";
        echo "<td>" . $g . "</td>";
        echo "<td>" . $e . "</td>";
        echo "<td>" . $p . "</td>";
        echo "<td>" . $gf . "</td>";
        echo "<td>" . $gc . "</td>";
        echo "<td>" . $dg . "</td>";
        echo "<td>" . $pts . "</td>";
        echo "</tr>";
      }
    }
    echo "</tbody></table>";
    
  }
?>