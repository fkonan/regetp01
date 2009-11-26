<h1>Total de Instituciones de Educación Técnica Profesional ingresada a la Base de Datos del Registro Federal de Instituciones de Educación Técnica Profesional (RFIETP) por ámbito de gestión según división político-territorial.</h1>
<div align="center">
<br>
<p style="text-align: center;">
<?php
if (isset($paginator)){
echo $paginator->counter(array(
	'format' => __('Página %page% de %pages% Mostrando %current% registros de %count% encontrados', true)
));
}
?>
</p>

<table width="80" cellpadding = "0" cellspacing = "0" summary="">
<tr class="altrow2">
	<?php foreach ($cols as $col): ?>
	<th><?php echo $col;?></th>
	<?php endforeach; ?>
</tr>
<?php
$i = 0;
foreach ($queries as $query):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
	   <?php foreach($query[0] as $line):?>	
		<td>
			<?php echo $line; ?>
		</td>
		<?php endforeach; ?>
	</tr>
<?php endforeach; ?>
</table>
</div>
<cite><u>Nota</u>: Desde Diciembre de 2007 se adoptó un nuevo criterio de clasificación de las instituciones de ETP ingresadas al Registro Federal de Instituciones de ETP. En los casos que la institución oferta más de un nivel de enseñanza se la categorizó de acuerdo al mayor nivel que brinda, de forma de evitar contabilizar un mismo establecimiento más de una vez. De ahí las diferencias que pueden observarse con los informes trimestrales previamente presentados.<br>Se incluyeron por otra parte de forma diferenciada a las instituciones de ETP dependientes de Universidad Nacionales.</cite>
<div class="paging" align="center">
	<?php 
	if (isset($paginator)){
		echo $paginator->prev('<< '.__('Anterior', true), array(), null, array('class'=>'disabled'));
		echo "&nbsp;";
		echo $paginator->numbers();
		echo "&nbsp;";
		echo $paginator->next(__('Siguiente', true).' >>', array(), null, array('class'=>'disabled'));
	}		
	?>
</div>