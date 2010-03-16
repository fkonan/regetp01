<<<<<<< .mine
<div class="titulos index">
<h2><?php __('Titulos');?></h2>
=======
<div class="sectores index">
<h2><?php __('Orientaciones');?></h2>
>>>>>>> .r290
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
<<<<<<< .mine
	<th><?php echo $paginator->sort("Marco de referencia",'marcoref');?></th>
	<th><?php echo $paginator->sort("Oferta",'Oferta.name');?></th>
=======
	<th><?php echo $paginator->sort("Orientaciones",'Orientaciones.name');?></th>
>>>>>>> .r290
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
<<<<<<< .mine
foreach ($titulos as $titulo):
=======
foreach ($orientaciones as $orientacion):
>>>>>>> .r290
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
<<<<<<< .mine
			<?php echo $titulo['Titulo']['id']; ?>
		</td>
		<td>
			<?php echo $titulo['Titulo']['name']; ?>
=======
			<?php echo $orientacion['Orientacion']['id']; ?>
>>>>>>> .r290
		</td>
		<td>
<<<<<<< .mine
			<?php echo ($titulo['Titulo']['marcoref']==1)? "X":""; ?>
=======
			<?php echo $orientacion['Orientacion']['name']; ?>
>>>>>>> .r290
		</td>
		<td>
			<?php 
<<<<<<< .mine
			$show = (empty($titulo['Oferta']['name']))? "" : $titulo['Oferta']['name'];
=======
			$show = (empty($orientacion['Orientacion']['name']))? "" : $orientacion['Orientacion']['name'];
>>>>>>> .r290
			echo $show; 
			?>
		</td>
		<td class="actions">
<<<<<<< .mine
			<?php echo $html->link(__('View', true), array('action'=>'view', $titulo['Titulo']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $titulo['Titulo']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $titulo['Titulo']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $titulo['Titulo']['id'])); ?>
=======
			<?php echo $html->link(__('View', true), array('action'=>'view', $orientacion['Orientacion']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $orientacion['Orientacion']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $orientacion['Orientacion']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $orientacion['Orientacion']['id'])); ?>
>>>>>>> .r290
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
<<<<<<< .mine
		<li><?php echo $html->link(__('New Titulo', true), array('action'=>'add')); ?></li>
=======
		<li><?php echo $html->link(__('New Orientacion', true), array('action'=>'add')); ?></li>
>>>>>>> .r290
	</ul>
</div>