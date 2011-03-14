<div class="queries index">
<h1><?php __('Descargas');?></h1>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Página %page% de %pages%, (%count% total)', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('name');?></th>
        <th><?php echo $paginator->sort('Cat', 'categoria');?></th>
        <th><?php echo $paginator->sort('vigencia');?></th>
	<th><?php echo $paginator->sort('created');?></th>
	<th><?php echo $paginator->sort('modified');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($queries as $query):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}

        $style = '';
        // ya venció la vigencia de la descarga
        if ($query['Query']['categoria'] == 't' &&
            @$query['Query']['vigencia'] && $query['Query']['vigencia'] < date('Y-m-d')) {
            $style = ' style="color:red;"';
        }
?>
	<tr<?php echo $class; echo $style;?>>
		<td style="text-align:left;">
			<?php echo 'Nº' .$query['Query']['id'] . ' - '. $query['Query']['name']; ?>
		</td>
                <td>
			<?php echo $query['Query']['categoria']; ?>
		</td>
                <td>
			<?php echo (@$query['Query']['vigencia'] ? $time->format('d/m/Y', $query['Query']['vigencia']) : ''); ?>
		</td>
		<td>
			<?php echo $time->format('d/m/Y', $query['Query']['created']); ?>
		</td>
		<td>
			<?php echo $time->format('d/m/Y', $query['Query']['modified']); ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $query['Query']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $query['Query']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $query['Query']['id'])); ?>
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
		<li><?php echo $html->link(__('New Query', true), array('action'=>'add')); ?></li>
	</ul>
</div>
