<div class="related">
	<h1><?php __('Oferta Educativa');?></h1>
	
	
	
	<h2><?php echo $instit['Instit']['cue'].'-0'.$instit['Instit']['anexo']." <br>".$instit['Instit']['nombre']; ?></h2>
	<dl>	
		<dt><?php __('Domicilio'); ?></dt>
		<dd>
			<?php echo $instit['Instit']['direccion']; ?>
			&nbsp;
		</dd>
			
		<dt><?php __('Tipo de Institución'); ?></dt>
		<dd>
			<?php echo $instit['Tipoinstit']['name']; ?>
			&nbsp;
		</dd>					
		<dt><?php __('Localidad'); ?></dt>
		<dd>
			<?php echo $instit['Instit']['localidad']; ?>
			&nbsp;
		</dd>		
		<dt><?php __('Jurisdicción'); ?></dt>
		<dd>
			<?php echo $instit['Jurisdiccion']['name']; ?>
			&nbsp;
		</dd>
	</dl>		
		
		
		
		
	<h2>Planes</h2>	
	
	<?php if (!empty($instit['Plan'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Oferta'); ?></th>
		<th><?php __('Nombre'); ?></th>
		<th><?php __('Sector'); ?></th>
		<th><?php __('Matrícula'); ?></th>
		<th class="actions"><?php __('');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($instit['Plan'] as $plan):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr id="fila_plan_<?= $plan['id'];?>" <?php echo $class;?> 
			onclick="window.location='<?= $html->url(array('controller'=> 'Planes', 'action'=>'view/'.$plan['id']))?>'"
			onmouseout="$('fila_plan_<?= $plan['id'];?>').toggleClassName('fila_marcada')" 
			onmouseover="$('fila_plan_<?= $plan['id'];?>').toggleClassName('fila_marcada')">
			<td><?php echo $this->requestAction('/Ofertas/dame_abrev/'.$plan['oferta_id']);?></td>
			<td><?php echo $plan['nombre'];?></td>
			<td><?php echo $plan['sector'];?></td>
			<td><?php echo $plan['matricula'];?></td>
			<td class="actions">
				<?php echo $html->link(__('Ver', true), array('controller'=> 'planes', 'action'=>'view', $plan['id'])); ?>
				<?php echo $html->link(__('Editar', true), array('controller'=> 'planes', 'action'=>'edit', $plan['id'])); ?>
				<?php echo $html->link(__('Eliminar', true), array('controller'=> 'planes', 'action'=>'delete', $plan['id']), null, sprintf(__('Seguro que desea eliminar el Plan "%s"?', true), $plan['nombre'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions" >
		<ul>
			<li><?php echo $html->link(__('Nuevo Plan', true), array('controller'=> 'planes', 'action'=>'add/'. $instit['Instit']['id']));?> </li>
		</ul>
	</div>
</div>