<div class="fondos index">
<h2><?php __('Fondos temporales');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
        <th><?php echo $paginator->sort('totales_checked');?></th>
        <th><?php echo $paginator->sort('cue_checked');?></th>
        <th><?php echo $paginator->sort('instit_id');?></th>
	<th><?php echo $paginator->sort('anio');?></th>
	<th><?php echo $paginator->sort('trimestre');?></th>
	<th><?php echo $paginator->sort('jurisdiccion_id');?></th>
	<th><?php echo $paginator->sort('jurisdiccion_name');?></th>
	<th><?php echo $paginator->sort('memo');?></th>
	<th><?php echo $paginator->sort('cuecompleto');?></th>
	<th><?php echo $paginator->sort('instit');?></th>
	<th><?php echo $paginator->sort('instit_name');?></th>
	<th><?php echo $paginator->sort('departamento');?></th>
        <th><?php echo $paginator->sort('localidad');?></th>
        <th><?php echo $paginator->sort('f01');?></th>
        <th><?php echo $paginator->sort('f02_a');?></th>
        <th><?php echo $paginator->sort('f02_b');?></th>
        <th><?php echo $paginator->sort('f02_c');?></th>
        <th><?php echo $paginator->sort('f03_a');?></th>
        <th><?php echo $paginator->sort('f03_b');?></th>
        <th><?php echo $paginator->sort('f04');?></th>
        <th><?php echo $paginator->sort('f05');?></th>
        <th><?php echo $paginator->sort('f06_a');?></th>
        <th><?php echo $paginator->sort('f06_b');?></th>
        <th><?php echo $paginator->sort('f06_c');?></th>
        <th><?php echo $paginator->sort('f07_a');?></th>
        <th><?php echo $paginator->sort('f07_b');?></th>
        <th><?php echo $paginator->sort('f07_c');?></th>
        <th><?php echo $paginator->sort('f08');?></th>
        <th><?php echo $paginator->sort('f09');?></th>
        <th><?php echo $paginator->sort('equip_inf');?></th>
        <th><?php echo $paginator->sort('refaccion');?></th>
        <th><?php echo $paginator->sort('total');?></th>
        <th><?php echo $paginator->sort('suma_fila');?></th>
        <th><?php echo $paginator->sort('observacion');?></th>
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
			<?php echo $fondo['FondoTemporales']['id']; ?>
		</td>
		<td>
			<?php echo $fondo['FondoTemporales']['totales_checked']; ?>
		</td>
		<td>
			<?php echo $fondo['FondoTemporales']['cue_checked']; ?>
		</td>
		<td>
			<?php echo $fondo['FondoTemporales']['instit_id']; ?>
		</td>
		<td>
			<?php echo $fondo['FondoTemporales']['anio']; ?>
		</td>
		<td>
			<?php echo $fondo['FondoTemporales']['trimestre']; ?>
		</td>
		<td>
			<?php echo $fondo['FondoTemporales']['jurisdiccion_id']; ?>
		</td>
		<td>
			<?php echo $fondo['FondoTemporales']['jurisdiccion_name']; ?>
		</td>
		<td>
			<?php echo $fondo['FondoTemporales']['memo']; ?>
		</td>
		<td>
			<?php echo $fondo['FondoTemporales']['cuecompleto']; ?>
		</td>
                <td>
			<?php echo $fondo['FondoTemporales']['instit']; ?>
		</td>
                <td>
			<?php echo $fondo['FondoTemporales']['instit_name']; ?>
		</td>
                <td>
			<?php echo $fondo['FondoTemporales']['departamento']; ?>
		</td>
                <td>
			<?php echo $fondo['FondoTemporales']['localidad']; ?>
		</td>
                <td>
			<?php echo $fondo['FondoTemporales']['f01']; ?>
		</td>
                <td>
			<?php echo $fondo['FondoTemporales']['f02_a']; ?>
		</td>
                <td>
			<?php echo $fondo['FondoTemporales']['f02_b']; ?>
		</td>
                <td>
			<?php echo $fondo['FondoTemporales']['f02_c']; ?>
		</td>
                <td>
			<?php echo $fondo['FondoTemporales']['f03_a']; ?>
		</td>
                <td>
			<?php echo $fondo['FondoTemporales']['f03_b']; ?>
		</td>
                <td>
			<?php echo $fondo['FondoTemporales']['f04']; ?>
		</td>
                <td>
			<?php echo $fondo['FondoTemporales']['f05']; ?>
		</td>
                <td>
			<?php echo $fondo['FondoTemporales']['f06_a']; ?>
		</td>
                <td>
			<?php echo $fondo['FondoTemporales']['f06_b']; ?>
		</td>
                <td>
			<?php echo $fondo['FondoTemporales']['f06_c']; ?>
		</td>
                <td>
			<?php echo $fondo['FondoTemporales']['f07_a']; ?>
		</td>
                <td>
			<?php echo $fondo['FondoTemporales']['f07_b']; ?>
		</td>
                <td>
			<?php echo $fondo['FondoTemporales']['f07_c']; ?>
		</td>
                <td>
			<?php echo $fondo['FondoTemporales']['f08']; ?>
		</td>
                <td>
			<?php echo $fondo['FondoTemporales']['f09']; ?>
		</td>
                <td>
			<?php echo $fondo['FondoTemporales']['equip_inf']; ?>
		</td>
                <td>
			<?php echo $fondo['FondoTemporales']['refaccion']; ?>
		</td>
                <td>
			<?php echo $fondo['FondoTemporales']['total']; ?>
		</td>
                <td>
			<?php echo $fondo['FondoTemporales']['suma_fila']; ?>
		</td>
                <td>
			<?php echo $fondo['FondoTemporales']['observacion']; ?>
		</td>

		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $fondo['FondoTemporales']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $fondo['FondoTemporales']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $fondo['FondoTemporales']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $fondo['FondoTemporales']['id'])); ?>
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
