<div class="trayectoAnios index">
<h2><?php __('TrayectoAnios');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('trayecto_id');?></th>
	<th><?php echo $paginator->sort('edad_teorica');?></th>
	<th><?php echo $paginator->sort('anio');?></th>
	<th><?php echo $paginator->sort('etapa_id');?></th>
	<th><?php echo $paginator->sort('anio_escolaridad');?></th>
	<th><?php echo $paginator->sort('created');?></th>
	<th><?php echo $paginator->sort('modified');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($trayectoAnios as $trayectoAnio):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $trayectoAnio['TrayectoAnio']['id']; ?>
		</td>
		<td>
			<?php echo $trayectoAnio['TrayectoAnio']['trayecto_id']; ?>
		</td>
		<td>
			<?php echo $trayectoAnio['TrayectoAnio']['edad_teorica']; ?>
		</td>
		<td>
			<?php echo $trayectoAnio['TrayectoAnio']['anio']; ?>
		</td>
		<td>
			<?php echo $trayectoAnio['TrayectoAnio']['etapa_id']; ?>
		</td>
		<td>
			<?php echo $trayectoAnio['TrayectoAnio']['anio_escolaridad']; ?>
		</td>
		<td>
			<?php echo $trayectoAnio['TrayectoAnio']['created']; ?>
		</td>
		<td>
			<?php echo $trayectoAnio['TrayectoAnio']['modified']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $trayectoAnio['TrayectoAnio']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $trayectoAnio['TrayectoAnio']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $trayectoAnio['TrayectoAnio']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $trayectoAnio['TrayectoAnio']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class'=>'disabled'));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('New TrayectoAnio', true), array('action'=>'add')); ?></li>
	</ul>
</div>
