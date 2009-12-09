<div class="fondos index">
<h2><?php __('Fondos');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('instit_id');?></th>
	<th><?php echo $paginator->sort('jurisdiccion_id');?></th>
	<th><?php echo $paginator->sort('lineas_de_accion_id');?></th>
	<th><?php echo $paginator->sort('valor_asignado');?></th>
	<th><?php echo $paginator->sort('fecha_aprobacion');?></th>
	<th><?php echo $paginator->sort('memo');?></th>
	<th><?php echo $paginator->sort('resolucion');?></th>
	<th><?php echo $paginator->sort('created');?></th>
	<th><?php echo $paginator->sort('modified');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($fondos as $fondo):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $fondo['Fondo']['id']; ?>
		</td>
		<td>
			<?php echo $fondo['Fondo']['instit_id']; ?>
		</td>
		<td>
			<?php echo $fondo['Fondo']['jurisdiccion_id']; ?>
		</td>
		<td>
			<?php echo $fondo['Fondo']['lineas_de_accion_id']; ?>
		</td>
		<td>
			<?php echo $fondo['Fondo']['valor_asignado']; ?>
		</td>
		<td>
			<?php echo $fondo['Fondo']['fecha_aprobacion']; ?>
		</td>
		<td>
			<?php echo $fondo['Fondo']['memo']; ?>
		</td>
		<td>
			<?php echo $fondo['Fondo']['resolucion']; ?>
		</td>
		<td>
			<?php echo $fondo['Fondo']['created']; ?>
		</td>
		<td>
			<?php echo $fondo['Fondo']['modified']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $fondo['Fondo']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $fondo['Fondo']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $fondo['Fondo']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $fondo['Fondo']['id'])); ?>
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
		<li><?php echo $html->link(__('New Fondo', true), array('action'=>'add')); ?></li>
	</ul>
</div>
