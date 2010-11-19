<div class="sugerencias index">
<h2><?php __('Sugerencias');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('P�gina %page% de %pages% (%count% sugerencias en total)', true)
));
?></p>
<table cellpadding="0" cellspacing="0" style="font-size:9pt;">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('asunto');?></th>
	<th><?php echo $paginator->sort('mensaje');?></th>
	<th><?php echo $paginator->sort('Usuario', 'user_id');?></th>
	<th><?php echo $paginator->sort('IP');?></th>
	<th><?php echo $paginator->sort('Recibida', 'created');?></th>
	<th><?php echo $paginator->sort('Le�da', 'leido');?></th>
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
			<?php echo $text->truncate(
                                    $sugerencia['Sugerencia']['mensaje'],
                                    50,
                                    '...',
                                    false
                                ); ?>
		</td>
		<td>
			<?php echo $sugerencia['User']['username']; ?>
		</td>
		<td>
			<?php echo $sugerencia['Sugerencia']['IP']; ?>
		</td>
		<td>
			<?php if ($time->isToday($sugerencia['Sugerencia']['created'])) {
                                echo "<b>Hoy</b> ".$time->format('G:i', $sugerencia['Sugerencia']['created'])." hs.";
                            } else {
                                $sugerencia['Sugerencia']['created'];
                            } ?>
		</td>
		<td>
			<?php echo $sugerencia['Sugerencia']['leido']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action' => 'view', $sugerencia['Sugerencia']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action' => 'delete', $sugerencia['Sugerencia']['id']), null, sprintf(__('Seguro deseas eliminar la sugerencia # %s?', true), $sugerencia['Sugerencia']['id'])); ?>
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
