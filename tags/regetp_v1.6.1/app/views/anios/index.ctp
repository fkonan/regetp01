<div class="anios index">
<h2><?php __('Anios');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('plan_id');?></th>
	<th><?php echo $paginator->sort('ciclo_id');?></th>
	<th><?php echo $paginator->sort('old_item');?></th>
	<th><?php echo $paginator->sort('anio');?></th>
	<th><?php echo $paginator->sort('etapa_id');?></th>
	<th><?php echo $paginator->sort('matricula');?></th>
	<th><?php echo $paginator->sort('secciones');?></th>
	<th><?php echo $paginator->sort('hs_taller');?></th>
	<th><?php echo $paginator->sort('created');?></th>
	<th><?php echo $paginator->sort('modified');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($anios as $anio):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $anio['Anio']['id']; ?>
		</td>
		<td>
			<?php echo $html->link($anio['Plan']['id'], array('controller'=> 'planes', 'action'=>'view', $anio['Plan']['id'])); ?>
		</td>
		<td>
			<?php echo $html->link($anio['Ciclo']['name'], array('controller'=> 'ciclos', 'action'=>'view', $anio['Ciclo']['id'])); ?>
		</td>
		<td>
			<?php echo $anio['Anio']['old_item']; ?>
		</td>
		<td>
			<?php echo $anio['Anio']['anio']; ?>
		</td>
		<td>
			<?php echo $html->link($anio['Etapa']['name'], array('controller'=> 'etapas', 'action'=>'view', $anio['Etapa']['id'])); ?>
		</td>
		<td>
			<?php echo $anio['Anio']['matricula']; ?>
		</td>
		<td>
			<?php echo $anio['Anio']['secciones']; ?>
		</td>
		<td>
			<?php echo $anio['Anio']['hs_taller']; ?>
		</td>
		<td>
			<?php echo $anio['Anio']['created']; ?>
		</td>
		<td>
			<?php echo $anio['Anio']['modified']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $anio['Anio']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $anio['Anio']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $anio['Anio']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $anio['Anio']['id'])); ?>
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
		<li><?php echo $html->link(__('New Anio', true), array('action'=>'add')); ?></li>
		<li><?php echo $html->link(__('List Planes', true), array('controller'=> 'planes', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Plan', true), array('controller'=> 'planes', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Ciclos', true), array('controller'=> 'ciclos', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Ciclo', true), array('controller'=> 'ciclos', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Etapas', true), array('controller'=> 'etapas', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Etapa', true), array('controller'=> 'etapas', 'action'=>'add')); ?> </li>
	</ul>
</div>
