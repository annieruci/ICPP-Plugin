<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Recuperar datos de celdas en una fila</title>
<style type="text/css">
/*<![CDATA[*/
tr{
background: white;
}
/*]]>*/
</style>
<script type="text/javascript">
//<![CDATA[
var textarray = new Array();
function recuperarFila(idfila) {
	var elTableRow = document.getElementById(idfila);
	var elTextarea = document.getElementById('textarea-92');
 	var eliminar = '';
	var cadena = '';
	var pos = 0;
	elTableRow.style.backgroundColor =(elTableRow.style.backgroundColor=="cyan")?'white':'cyan';

	if(elTableRow.style.backgroundColor == 'cyan'){
		textarray.push(elTableRow);
	}
	else{
		var elTableCells = elTableRow.getElementsByTagName("td");
		for (var i=0; i<elTableCells.length; i++) {
			eliminar = eliminar + ' ' + elTableCells[i].innerHTML + ' ';
		}
		textarray.some(function(elTableRow) {
			var elTableCells = elTableRow.getElementsByTagName("td");
			var elim = ''; 
		   	for (var i=0; i<elTableCells.length; i++) {
				elim = elim + ' ' + elTableCells[i].innerHTML + ' ';
			 }
		 	if(elim == eliminar){
				 textarray.splice(pos, 1);
			 }
			 pos++;
		 });
	}

	textarray.forEach(function(elTableRow) {
		var elTableCells = elTableRow.getElementsByTagName("td");
		for (var i=0; i<elTableCells.length; i++) {
			cadena = cadena + ' ' + elTableCells[i].innerHTML + ' '; 
		}
			cadena = cadena + '\n';
	});
	elTextarea.value = cadena;
}
//]]>

</script>
</head>

<body>

<div class="wpb_raw_code wpb_content_element wpb_raw_html" >
		<div class="wpb_wrapper">
		<label class='gfield_label' for='input_1_19' style="color:#0084ff;font-weight: 700;
font-size: inherit;text-align: left;font-family: Open Sans,sans-serif;" >Busqueda de productos</label>
		    
            
<div class="gpnf-nested-entries-container ginput_container">
	<br />
<form method='get' action= 
	    <?php 
	    $dom = $_SERVER['HTTP_HOST']; 
        $rest = $_SERVER['REQUEST_URI'];
        $url_completa = "https://" . $dom . $rest; 
 
echo "'".$url_completa."'" ; ?>
>
		<input type='input' placeholder='Escriba una referencia...' name='ref'>
		<input type='submit' value='Buscar' class="gpnf-add-entry">
		<br /><br />
		<table class="gpnf-nested-entries" width="650" style="text-align: center;">
			<thead>
				<tr width="25" height="25">
					<th>Referencia</th>
					<th>Modelo</th>
					<th>Fabricante</th>
					<th>Existencia</th>
					<th>Stock</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<?php
					
					if (isset($_GET['ref'])) {
						$ref= $_GET['ref'];
						//echo $ref;
					}
					else {
						$ref= "''";
					}
					
					$ref= trim($ref);
					$query="select Part_Number_Ref as referencia, description as modelo, Mfg_Marca as fabricante, Qty_cantidad as existencia, Plazo_entrega as stock from elementos_eletronicos where Part_Number_Ref like '%".$ref."%' order by Part_Number_Ref;";;
					$conexion= new mysqli("localhost","icomp2_s","LZ9=OI]iu!C(","icomp2_s") or die("Error de conexion con la DDBB");
					
					$registros= $conexion->query($query);

					$contador= $registros->num_rows;
					if ($contador>0) {
						while ($reg= $registros->fetch_array())	{
  							$referencia=$reg['referencia'];
  							$modelo= $reg['modelo'];
  							$fabricante= $reg['fabricante'];
  							$existencia= $reg['existencia'];
  							$stock= $reg['stock'];
  							echo "<tr id=".$contador." onclick='recuperarFila(this.id)' width='25' height='25' style='border-bottom:1px solid #e5e5e5';>";
  							echo "<td>".$referencia."</td>" ;
  							echo "<td>".$modelo."</td>" ;
  							echo "<td>".$fabricante."</td>" ;
  							echo "<td>".$existencia."</td>" ;
                            echo "<td>".$stock."</td>" ;
  							echo "</tr>";
                            --$contador;
                        }
                        
					}
					elseif($ref !== "''"){
                        echo "<tr>";
                        echo "<td colspan='4'>No hay artículos con la referencia ".$ref."</td>";
						echo "</tr>";
                    }
                    else{
                        echo "<tr>";
                        echo "<td colspan='4'>Escriba referencia para buscar </td>";
						echo "</tr>";
					}
					$conexion->close();
					
		?>
		</tbody> </table> </form>
</div>
</div>
</div>
</body>
</html>

