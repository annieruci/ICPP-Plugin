<div class="wrap">
 <h1>Selecciona Archivo Exel/h1>
 <p></p>
</div>

<?php

if(isset($_POST['submit']))
{
  create_table_component();
  $dir_name = $_FILES['file']['name'];
  $dir_tmp_name = $_FILES['file']['tmp_name'];
  $dir_subida = plugin_dir_path(__FILE__);
  $fichero_subido = $dir_subida . basename($_FILES['file']['name']);
  
  echo '<pre>';
  if (move_uploaded_file($dir_tmp_name, $fichero_subido)) {
      echo "El fichero es válido y se subió con éxito.\n";
      $cant = 0;
      $objPHPExcel = PHPExcel_IOFactory::load($fichero_subido);
      $objPHPExcel->setActiveSheetIndex(0);
      $numRows = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
      for ($i = 2; $i <= $numRows; $i++) {
        $qty = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();
        if ($qty != ""){
	        $referencia = $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue();
          $fabricante = $objPHPExcel->getActiveSheet()->getCell('C'.$i)->getCalculatedValue();
          $fecha = $objPHPExcel->getActiveSheet()->getCell('D'.$i)->getCalculatedValue();
          $descripcion = $objPHPExcel->getActiveSheet()->getCell('E'.$i)->getCalculatedValue();
          $dir = "<a href='https://www.icompplus.com/presupuesto/?ref=$referencia'>$referencia</a>";
          $dir1 = "<a href='https://www.icompplus.com/presupuesto/?ref=$referencia'>$descripcion</a>";
          $existe = count(table_exist($referencia,$descripcion));
          if($existe==0){
              insert_component($referencia,$descripcion);
              create_page($dir,$dir1);
              ++$cant;
          }   
      }
    }
      echo $cant . " Fueron adicionados.";
      unlink($fichero_subido);
  } else {
      echo "¡Posible ataque de subida de ficheros!\n";
  }
  echo '</pre>';
}
?>

<form action="" enctype="multipart/form-data" method="POST">
<input type="file" name="file" accept=".xlsx"/></br>
<input type="submit" name="submit" class='button-secondary' value="Actualizar">

<form>
