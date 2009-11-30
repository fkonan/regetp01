<? 
$paginator->options(array('url' => $url_conditions));
?>
<div class="tickets index">
<h2><?php __('Pendientes de Actualización. Jurisdicción: ' . $jurisdiccion_name);?></h2>
<p  class="paginate_msg">
	<?php
	echo $paginator->counter(array(
	'format' => __('Página %page% de %pages%<br />Mostrando %current% registros de %count% encontrados, visualizando registros desde el nº %start%, hasta el %end%', true)
	));
	?>
</p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('Fecha Creación','Ticket.created');?></th>
	<th><?php echo $paginator->sort('Usuario','user.nombre');?></th>
	<th><?php echo $paginator->sort('Cue','Instit.cue');?></th>
	<th><?php echo $paginator->sort('Anexo','Instit.anexo');?></th>
	<th><?php echo  __('Nombre');?></th>
	<th class="actions">Ticket</th>
</tr>
<?php
$i = 0;
//debug($tickets);
foreach ($tickets as $ticket):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo date('d/m/y H:i',strtotime($ticket['Ticket']['created']));?>
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
		<?php 
			echo $html->link($ticket['Instit']['nombre_completo'],
							 '/instits/view/'.$ticket['Instit']['id']
			);
		?> 
		
		</td>
		<td class="actions">
			<a href="<?= $html->url(array('controller'=> 'tickets', 'action'=>'edit/'.$ticket['Ticket']['id']))?>" onClick="window.open('<?= $html->url(array('controller'=> 'tickets', 'action'=>'edit/'.$ticket['Ticket']['id']))?>','_blank' , 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=310,height=390'); return false;">Editar</a>			
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>

<div id="paginator_prev_next_links">
	<?php	
		echo $paginator->prev('« Anterior ',null, null, array('class' => 'disabled'));
		echo " | ".$paginator->numbers(array('modulus'=>'9'))." | ";
		echo $paginator->next(' Siguiente »', null, null, array('class' => 'disabled'));
	?> 
	</div>
