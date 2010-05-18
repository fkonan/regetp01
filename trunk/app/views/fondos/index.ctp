<div class="fondos index">
<h2><?php __('Fondos');?></h2>

<?php echo $form->create('Fondos',array('url'=>array('action'=>'index'))) ?>
    <?php echo $form->input('anio',array('options'=>$anios, 'style'=>'float:left')) ?>
    <?php echo $form->input('trimestre', array('options'=>array(1,2,3,4), 'style'=>'float:left;width:100px')) ?>
    <?php echo $form->input('jurisdiccion_id') ?>
<?php echo $form->end('Search'); ?>

<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('instit_id');?></th>
	<th><?php echo $paginator->sort('jurisdiccion_id');?></th>
	<th><?php echo $paginator->sort('anio');?></th>
	<th><?php echo $paginator->sort('trimestre');?></th>
	<th><?php echo $paginator->sort('memo');?></th>
	<th><?php echo $paginator->sort('total');?></th>
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
			<?php echo $fondo['Instit']['nombre']; ?>
		</td>
		<td>
			<?php echo $fondo['Jurisdiccion']['name']; ?>
		</td>

		<td>
			<?php echo $fondo['Fondo']['anio']; ?>
		</td>
		<td>
			<?php echo $fondo['Fondo']['trimestre']; ?>
		</td>
		<td>
			<?php echo $fondo['Fondo']['memo']; ?>
		</td>
		<td>
			<?php echo $fondo['Fondo']['total']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action' => 'view', $fondo['Fondo']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers(array('url'=>array($url)));?>
	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class' => 'disabled'));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('New Fondo', true), array('action' => 'add')); ?></li>
	</ul>
</div>
