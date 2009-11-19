<h1><?php echo $descripcion;?></h1>

<div align="center">
<br>
<p style="text-align: center;">
<?php
if (isset($paginator)){
$paginator->options(array('url' => $url_conditions));
}

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