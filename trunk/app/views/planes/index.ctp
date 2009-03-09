<div class="planes index">
<h2><?php __('Planes');?></h2>
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
	<th><?php echo $paginator->sort('oferta_id');?></th>
	<th><?php echo $paginator->sort('old_item');?></th>
	<th><?php echo $paginator->sort('norma');?></th>
	<th><?php echo $paginator->sort('nombre');?></th>
	<th><?php echo $paginator->sort('perfil');?></th>
	<th><?php echo $paginator->sort('sector');?></th>
	<th><?php echo $paginator->sort('duracion_hs');?></th>
	<th><?php echo $paginator->sort('duracion_semanas');?></th>
	<th><?php echo $paginator->sort('duracion_anios');?></th>
	<th><?php echo $paginator->sort('matricula');?></th>
	<th><?php echo $paginator->sort('observacion');?></th>
	<th><?php echo $paginator->sort('ciclo_alta');?></th>
	<th><?php echo $paginator->sort('ciclo_mod');?></th>
	<th><?php echo $paginator->sort('created');?></th>
	<th><?php echo $paginator->sort('modified');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($planes as $plan):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $plan['Plan']['id']; ?>
		</td>
		<td>
			<?php echo $html->link($plan['Instit']['id'], array('controller'=> 'instits', 'action'=>'view', $plan['Instit']['id'])); ?>
		</td>
		<td>
			<?php echo $html->link($plan['Oferta']['name'], array('controller'=> 'ofertas', 'action'=>'view', $plan['Oferta']['id'])); ?>
		</td>
		<td>
			<?php echo $plan['Plan']['old_item']; ?>
		</td>
		<td>
			<?php echo $plan['Plan']['norma']; ?>
		</td>
		<td>
			<?php echo $plan['Plan']['nombre']; ?>
		</td>
		<td>
			<?php echo $plan['Plan']['perfil']; ?>
		</td>
		<td>
			<?php echo $plan['Plan']['sector']; ?>
		</td>
		<td>
			<?php echo $plan['Plan']['duracion_hs']; ?>
		</td>
		<td>
			<?php echo $plan['Plan']['duracion_semanas']; ?>
		</td>
		<td>
			<?php echo $plan['Plan']['duracion_anios']; ?>
		</td>
		<td>
			<?php echo $plan['Plan']['matricula']; ?>
		</td>
		<td>
			<?php echo $plan['Plan']['observacion']; ?>
		</td>
		<td>
			<?php echo $plan['Plan']['ciclo_alta']; ?>
		</td>
		<td>
			<?php echo $plan['Plan']['ciclo_mod']; ?>
		</td>
		<td>
			<?php echo $plan['Plan']['created']; ?>
		</td>
		<td>
			<?php echo $plan['Plan']['modified']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $plan['Plan']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $plan['Plan']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $plan['Plan']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $plan['Plan']['id'])); ?>
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
		<li><?php echo $html->link(__('New Plan', true), array('action'=>'add')); ?></li>
		<li><?php echo $html->link(__('List Instits', true), array('controller'=> 'instits', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Instit', true), array('controller'=> 'instits', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Ofertas', true), array('controller'=> 'ofertas', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Oferta', true), array('controller'=> 'ofertas', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Anios', true), array('controller'=> 'anios', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Anio', true), array('controller'=> 'anios', 'action'=>'add')); ?> </li>
	</ul>
</div>
