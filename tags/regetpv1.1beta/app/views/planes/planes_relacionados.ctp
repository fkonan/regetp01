<div class="related">
	<h1><?php __('Oferta Educativa');?></h1>

	
	<h2><?php echo $instit['Instit']['cue'].'-0'.$instit['Instit']['anexo']." <br>".$instit['Instit']['nombre']; ?></h2>
	<dl>	
	
		<dt><?php __('Tipo de Institución'); ?></dt>
		<dd>
			<?php 
			echo $this->requestAction('/tipoinstits/get_name/'.$instit['Instit']['tipoinstit_id']);  ?>
			&nbsp;
		</dd>	
	
		<dt><?php __('Domicilio'); ?></dt>
		<dd>
			<?php echo $instit['Instit']['direccion']; ?>
			&nbsp;
		</dd>			
						
		<dt><?php __('Localidad'); ?></dt>
		<dd>
			<?php echo $instit['Instit']['localidad']; ?>
			&nbsp;
		</dd>		
		<dt><?php __('Jurisdicción'); ?></dt>
		<dd>
			<?php echo $this->requestAction('/jurisdicciones/get_name/'.$instit['Instit']['jurisdiccion_id']);  ?>
			&nbsp;
		</dd>
	</dl>		
		
		
		
		
	<h2>Oferta</h2>	
	<?php if ($planes):?>
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

		foreach ($planes as $plan):
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
			<td><?php echo $v_plan_matricula[$i-1][$plan['id']];?></td>
			<td class="actions">
				<a href="#Ver">Ver</a>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions" >
		<ul>
			<li><?php echo $html->link(__('Nueva Oferta', true), array('controller'=> 'planes', 'action'=>'add/'. $instit['Instit']['id']));?> </li>
		</ul>
	</div>
</div>