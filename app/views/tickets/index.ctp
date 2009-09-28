<? 
$paginator->options(array('url' => $url_conditions));
?>
<div class="tickets index">
<h2><?php __('Pendientes de Actualización. Jurisdicción: ' . $jurisdiccion_name);?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('Fecha Creación','Ticket.created');?></th>
	<th><?php echo $paginator->sort('Usuario','user.nombre');?></th>
	<th><?php echo $paginator->sort('Cue','Instit.cue');?></th>
	<th><?php echo $paginator->sort('Anexo','Instit.anexo');?></th>
	<th><?php echo  __('Nombre');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($tickets as $ticket):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $ticket['Ticket']['created'];?>
		</td>
		<td>
			<?php echo $ticket['User']['nombre'] . " " . $ticket['User']['apellido']; ?>
		</td>
		<td>
			<?php echo $ticket['Instit']['cue']; ?>
		</td>
		<td>
			<?php echo $ticket['Instit']['anexo']; ?>
		</td>
		<td>
			<?php echo $ticket['Instit']['nombre_completo']; ?>
		</td>
		<td class="actions">
			<a href="<?= $html->url(array('controller'=> 'tickets', 'action'=>'edit/'.$ticket['Ticket']['id']))?>" onClick="window.open('<?= $html->url(array('controller'=> 'tickets', 'action'=>'edit/'.$ticket['Ticket']['id']))?>','_blank' , 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=310,height=390'); return false;">Editar</a>
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
