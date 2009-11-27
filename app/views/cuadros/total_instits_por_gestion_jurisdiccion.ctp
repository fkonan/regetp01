<h2>Total de Instituciones de Educación Técnica Profesional ingresadas a la Base de Datos del Registro Federal de Instituciones de Educación Técnica Profesional (RFIETP) por ámbito de gestión según división político-territorial.</h2>
<div align="center">
<br>

<table width="80" cellpadding = "0" cellspacing = "0" summary="" style="border-style: solid; border-width: 1px; border-color: gray; ">
<tr class="altrow2">
	<?php foreach ($precols as $key=>$precol): 
		$colspan = ($key==1)? "colspan=2":"";	
		?>		
		<th <?php echo $colspan;?>><?php echo $precol;?></th>
	<?php endforeach; ?>
</tr>
<tr class="altrow2">
	<?php foreach ($cols as $col): ?>
	<th><?php echo $col;?></th>
	<?php endforeach; ?>
</tr>
<?php
$i = 0;
foreach ($queries as $query):
	$class = '';
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<?php 
	$style = ($query[0]['División político-territorial']== 'Total')?' style="background-color: #fff; color: #233e87; font-weight: bolder; border-top: 1px solid silver;':'style="';
	?>
	<tr<?php echo $class;?>>
	   <?php foreach($query[0] as $head=>$line): 
	   	if($head == 'División político-territorial') {
	   		$style1 = $style.'text-align:left;"';
	   	}
	   	else {
	   		$style1 = $style.'text-align:right;"';
	   	}
	   ?>
		<td <?php echo $style1?>>
			<?php echo $line; ?>
		</td>
		<?php endforeach; ?>
	</tr>
<?php endforeach; ?>
</table>
</div>

<br>
<cite style="font-size: 10px;"><u>Fuente</u>: INET-Ministerio de Educación. Unidad de información - Área Registro Federal de Instituciones de Educación Profecional. información al <?php echo date("d-m-Y");?></cite>
<br><br>
<cite style="font-size: 10px;"><u>Nota</u>: Desde Diciembre de 2007 se adoptó un nuevo criterio de clasificación de las instituciones de ETP ingresadas al Registro Federal de Instituciones de ETP. En los casos que la institución oferta más de un nivel de enseñanza se la categorizó de acuerdo al mayor nivel que brinda, de forma de evitar contabilizar un mismo establecimiento más de una vez. De ahí las diferencias que pueden observarse con los informes trimestrales previamente presentados.<br>Se incluyeron por otra parte de forma diferenciada a las instituciones de ETP dependientes de Universidad Nacionales.</cite>
