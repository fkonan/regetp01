<div class="jurisdicciones index">
<h1><?php __('Jurisdicciones');?></h1>

<table width="80%" cellpadding = "0" cellspacing = "0" summary=""
	style="border-style: solid; border-width: 1px; border-color: gray; font-size: 9pt;">
<tr>
	<th><?php echo $paginator->sort('name');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($jurisdicciones as $jurisdiccion):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $jurisdiccion['Jurisdiccion']['name']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('Ver', true), array('action'=>'view', $jurisdiccion['Jurisdiccion']['id'])); ?>
			<?php echo $html->link(__('Editar', true), array('action'=>'edit', $jurisdiccion['Jurisdiccion']['id'])); ?>
			
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>