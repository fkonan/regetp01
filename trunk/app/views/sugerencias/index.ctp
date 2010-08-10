<div class="sugerencias index">
<h2><?php __('Sugerencias');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('asunto');?></th>
	<th><?php echo $paginator->sort('mensaje');?></th>
	<th><?php echo $paginator->sort('remitente');?></th>
	<th><?php echo $paginator->sort('email');?></th>
	<th><?php echo $paginator->sort('IP');?></th>
	<th><?php echo $paginator->sort('created');?></th>
	<th><?php echo $paginator->sort('leido');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($sugerencias as $sugerencia):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $sugerencia['Sugerencia']['id']; ?>
		</td>
		<td>
			<?php echo $sugerencia['Sugerencia']['asunto']; ?>
		</td>
		<td>
			<?php echo $sugerencia['Sugerencia']['mensaje']; ?>
		</td>
		<td>
			<?php echo $sugerencia['Sugerencia']['remitente']; ?>
		</td>
		<td>
			<?php echo $sugerencia['Sugerencia']['email']; ?>
		</td>
		<td>
			<?php echo $sugerencia['Sugerencia']['IP']; ?>
		</td>
		<td>
			<?php echo $sugerencia['Sugerencia']['created']; ?>
		</td>
		<td>
			<?php echo $sugerencia['Sugerencia']['leido']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action' => 'view', $sugerencia['Sugerencia']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action' => 'edit', $sugerencia['Sugerencia']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action' => 'delete', $sugerencia['Sugerencia']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $sugerencia['Sugerencia']['id'])); ?>
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
		<li><?php echo $html->link(__('New Sugerencia', true), array('action' => 'add')); ?></li>
	</ul>
</div>
