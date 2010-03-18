<div class="titulos index"> 
<h2><?php __('Titulos');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('name');?></th>
	<th><?php echo $paginator->sort("Marco de referencia",'marco_ref');?></th>
	<th><?php echo $paginator->sort("Oferta",'Oferta.name');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($titulos as $titulo):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $titulo['Titulo']['id']; ?>
		</td>
		<td>
			<?php echo $titulo['Titulo']['name']; ?>
		</td>
		<td>
			<?php 
				if ($titulo['Titulo']['marco_ref']==1) {
					echo $html->image('check_blue.jpg'); 
				}
			?>
		</td>
		<td>
			<?php 
			$show = (empty($titulo['Oferta']['name']))? "" : $titulo['Oferta']['name'];
			echo $show; 
			?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $titulo['Titulo']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $titulo['Titulo']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $titulo['Titulo']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $titulo['Titulo']['id'])); ?>
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
		<li><?php echo $html->link(__('New Titulo', true), array('action'=>'add')); ?></li>
	</ul>
</div>