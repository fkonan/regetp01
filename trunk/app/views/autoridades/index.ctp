<div class="autoridades index">
<h2><?php __('Autoridades');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('jurisdiccion_id');?></th>
	<th><?php echo $paginator->sort('nombre');?></th>
	<th><?php echo $paginator->sort('apellido');?></th>
	<th><?php echo $paginator->sort('fecha_asuncion');?></th>
	<th><?php echo $paginator->sort('titulo');?></th>
	<th><?php echo $paginator->sort('telefono_personal');?></th>
	<th><?php echo $paginator->sort('telefono_institucional');?></th>
	<th><?php echo $paginator->sort('email_personal');?></th>
	<th><?php echo $paginator->sort('email_institucional');?></th>
	<th><?php echo $paginator->sort('direccion');?></th>
	<th><?php echo $paginator->sort('localidad_id');?></th>
	<th><?php echo $paginator->sort('departamento_id');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($autoridades as $autoridad):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $autoridad['Autoridad']['id']; ?>
		</td>
		<td>
			<?php echo $autoridad['Autoridad']['jurisdiccion_id']; ?>
		</td>
		<td>
			<?php echo $autoridad['Autoridad']['nombre']; ?>
		</td>
		<td>
			<?php echo $autoridad['Autoridad']['apellido']; ?>
		</td>
		<td>
			<?php echo $autoridad['Autoridad']['fecha_asuncion']; ?>
		</td>
		<td>
			<?php echo $autoridad['Autoridad']['titulo']; ?>
		</td>
		<td>
			<?php echo $autoridad['Autoridad']['telefono_personal']; ?>
		</td>
		<td>
			<?php echo $autoridad['Autoridad']['telefono_institucional']; ?>
		</td>
		<td>
			<?php echo $autoridad['Autoridad']['email_personal']; ?>
		</td>
		<td>
			<?php echo $autoridad['Autoridad']['email_institucional']; ?>
		</td>
		<td>
			<?php echo $autoridad['Autoridad']['direccion']; ?>
		</td>
		<td>
			<?php echo $autoridad['Autoridad']['localidad_id']; ?>
		</td>
		<td>
			<?php echo $autoridad['Autoridad']['departamento_id']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action' => 'view', $autoridad['Autoridad']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action' => 'edit', $autoridad['Autoridad']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action' => 'delete', $autoridad['Autoridad']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $autoridad['Autoridad']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class' => 'disabled'));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('New Autoridad', true), array('action' => 'add')); ?></li>
	</ul>
</div>
