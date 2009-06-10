

<div class="related">
	<h1><?php __('Oferta Educativa');?></h1>

	
	<?
	//si el anexo tiene 1 solo digito le coloco un cero adelante
	$anexo = ($planes['Instit']['anexo']<10)?'0'.$planes['Instit']['anexo']:$planes['Instit']['anexo'];
	$cue_instit = $planes['Instit']['cue'].$anexo;
	?>
	<h2><?= $cue_instit?> - <?= $planes['Instit']['nombre_completo'] ?></h2>
	
	<dl>	
	
		<dt><?php __('Jurisdicción'); ?></dt>
		<dd>
			<?php echo $planes['Jurisdiccion']['name'];  ?>
			&nbsp;
		</dd>	
					
						
		<dt><?php __('Departamento'); ?></dt>
		<dd>
			<?php echo $planes['Instit']['depto']; ?>
			&nbsp;
		</dd>	
			
		<dt><?php __('Localidad'); ?></dt>
		<dd>
			<?php echo $planes['Instit']['localidad']; ?>
			&nbsp;
		</dd>		
			
	
		<dt><?php __('Domicilio'); ?></dt>
		<dd>
			<?php echo $planes['Instit']['direccion']; ?>
			&nbsp;
		</dd>			
		
	</dl>		
	
		
	<h2>Oferta</h2>	
	
	
	<table cellpadding = "0" cellspacing = "0">
	
	<tr>
		<th>Oferta</th>
		<?php 
		foreach($sumatoria_matriculas['array_de_ciclos'] as $ciclo):
			echo "<th>Matrícula $ciclo</th>";
		endforeach;
		?>		
	</tr>	
	
	
		<?php 
		foreach($sumatoria_matriculas['array_de_ofertas'] as $oferta):
		
			?><tr><?php 
			
			$primer_columna = true;			
			foreach($sumatoria_matriculas['array_de_ciclos'] as $ciclo):
				if($primer_columna):
					echo "<td>".$oferta['abrev']."</td>";
					$primer_columna = false;
				endif;
				echo "<td>".$sumatoria_matriculas['totales'][$ciclo][$oferta['abrev']]['total_matricula']."</td>";
			endforeach;
			
			?></tr><?php 
		endforeach;
		?>	
	
	</table>
	
	<?php if ($planes):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Oferta'); ?></th>
		<th><?php __('Nombre del Título/Certificación'); ?></th>
		<th><?php __('Sector'); ?></th>
		<th><?php __('Matrícula'); ?></th>
		<th><?php __('Ciclo (1)'); ?></th>
		<th class="actions"><?php __('');?></th>
	</tr>
	<?php
		$i = 0;

		foreach ($planes['Plan'] as $plan):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr id="fila_plan_<?= $plan['id'];?>" <?php echo $class;?> 
			onclick="window.location='<?= $html->url(array('controller'=> 'Planes', 'action'=>'view/'.$plan['id']))?>'"
			onmouseout="$('fila_plan_<?= $plan['id'];?>').removeClassName('fila_marcada')" 
			onmouseover="$('fila_plan_<?= $plan['id'];?>').addClassName('fila_marcada')">
			<td><?php echo $this->requestAction('/Ofertas/dame_abrev/'.$plan['oferta_id']);?></td>
			<td><?php echo $plan['nombre'];?></td>
			<td><?php echo $plan['sector'];?></td>
			<td><?php echo $v_plan_matricula[$i-1][$plan['id']];?></td>
			<td><?php echo $v_plan_matricula[$i-1]['ciclo']; ?></td>
			<td class="actions">
				<a href="#Ver">Ver</a>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
	<cite>Nota: (1) Indica el ciclo lectivo al que corresponde la matrícula.</cite>
<?php endif; ?>

	<div class="actions" >
		<ul>
			<li><?php echo $html->link(__('Nueva Oferta', true), array('controller'=> 'planes', 'action'=>'add/'. $planes['Instit']['id']));?> </li>
		</ul>
	</div>
</div>