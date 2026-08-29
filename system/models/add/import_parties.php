<?php  
  use PhpOffice\PhpSpreadsheet\IOFactory;

  if(is_array($_FILES['archivoexcel']) && count($_FILES['archivoexcel']) >0){
    session_start();
		require_once '../../controller/connection.php';
    // require '../../excel/Classes/PHPExcel.php';
    require '../../excel/vendor/autoload.php';

    $tmpfname = $_FILES['archivoexcel']['tmp_name'];

    // $leerexcel = PHPExcel_IOFactory::createReaderForFile($tmpfname);
    $leerexcel = IOFactory::createReaderForFile($tmpfname);
    $excelobj = $leerexcel->load($tmpfname);

    $hoja = $excelobj -> getSheet(0);
    $filas = $hoja->getHighestRow();

    echo "<table id='dt_listaEventos' class='tabla-resultados'>
    <thead>
      <tr class='header-tabla'>
        <td>Equipo A</td>
        <td>Titulo</td>
        <td>Fecha</td>
        <td>Resultados</td>
        <td>Resultados - subtitulo</td>
        <td>Equipo B</td>        
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
      
      if($columna_a <> ""){
        echo "<tr>";
        echo "<td>" . $columna_a . "</td>";
        echo "<td>" . $columna_b . "</td>";
        echo "<td>" . $columna_c . "</td>";        
        echo "<td>" . $columna_d . "</td>";        
        echo "<td>" . $columna_e . "</td>";        
        echo "<td>" . $columna_f . "</td>";        
        echo "</tr>";
      }
    }
    echo "</tbody></table>";
    
  }
?>