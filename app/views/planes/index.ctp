<div class="related">

<h1><?php __('Oferta Educativa');?></h1>

<? 
$paginator->options(array('url' => $url_conditions));
?>

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
	
<?php
	if(isset($sumatoria_matriculas['array_de_ciclos'])>0 && isset($sumatoria_matriculas['array_de_ofertas'])>0):
	$v_matriculas_ciclos = array_reverse($sumatoria_matriculas['array_de_ciclos']);
?>
	
<div align="center">
<table class="mini_tabla" width="80" cellpadding = "0" cellspacing = "0" summary="En esta tabla se muestran los totales de 
														matrículas por cada ciclo lectivo, para 
														cada oferta.">
	<CAPTION>Total de matriculados por oferta según ciclo lectivo</CAPTION>
	<tr>
		<th>Oferta</th>
		<?php 
		foreach($v_matriculas_ciclos as $ciclo):
			echo "<th>$ciclo</th>";
		endforeach;
		?>		
	</tr>	
		
	<?php 
	foreach($sumatoria_matriculas['array_de_ofertas'] as $oferta):
	?>
	<tr><?php 
		$primer_columna = true;			
		foreach($v_matriculas_ciclos as $ciclo):
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
<div>
<br />
<?php endif;?>	
	
<p>
<?php
echo $form->create('Plan',array('action' => 'index'));
echo $form->input('Instit.id', array('value'=>$url_conditions['Instit.id']));
//echo $paginator->counter(array('format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)));
?></p>


<table cellpadding="0" cellspacing="0">
<CAPTION>Listado de Ofertas</CAPTION>
<tr>
	<td><?php echo $form->input('oferta_id',array('options'=> $ofertas,'label'=>'','empty'=> array('0'=>'Todas'),'selected' => isset($url_conditions['Plan.oferta_id']) ? $url_conditions['Plan.oferta_id'] : '0'));?></td>
	<td><?php echo $form->input('nombre', array('label'=>'','value' => isset($url_conditions['Plan.nombre']) ? $url_conditions['Plan.nombre'] : ''));?></td>
	<td><?php echo $form->input('sector', array('label'=>'', 'value' => isset($url_conditions['Plan.sector']) ? $url_conditions['Plan.sector'] : ''));?></td>
	<td><?php echo $form->button('Buscar',array('type'=>'submit'));?></td>
	<td><?php echo '&nbsp';?></td>
	<td><?php echo '&nbsp';?></td>
</tr>
<tr>
	<th><?php echo $paginator->sort('Oferta','Oferta.abrev');?></th>
	<th><?php echo $paginator->sort('Nombre del Título/Certificación','nombre');?></th>
	<th><?php echo $paginator->sort('Sector','sector');?></th>
	<th><?php echo 'Matrícula';?></th>
	<th><?php echo 'Ciclo';?></th>
	<th class="actions"><?php echo '&nbsp';?></th>
</tr>
<?php
$i = 0;
foreach ($planesRelacionados as $plan):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
		<tr id="fila_plan_<?= $plan['Plan']['id'];?>" <?php echo $class;?> 
			onclick="window.location='<?= $html->url(array('controller'=> 'Planes', 'action'=>'view/'.$plan['Plan']['id']))?>'"
			onmouseout="$('fila_plan_<?= $plan['Plan']['id'];?>').removeClassName('fila_marcada')" 
			onmouseover="$('fila_plan_<?= $plan['Plan']['id'];?>').addClassName('fila_marcada')">

		<td>
			<?php echo $plan['Oferta']['abrev']; ?>
		</td>
		<td>
			<?php echo $plan['Plan']['nombre']; ?>
		</td>
		<td>
			<?php echo $plan['Plan']['sector']; ?>
		</td>
		<td>
			<?php echo $plan['Plan']['matriculaCalc']; ?>
		</td>
		<td>
			<?php echo $plan['Plan']['cicloCalc']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('Ver', true), array('action'=>'view', $plan['Plan']['id'])); ?>
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
        <li><?php echo $html->link(__('Nueva Oferta', true), array('controller'=> 'planes', 'action'=>'add/'. $planes['Instit']['id']));?> </li>
	</ul>
</div>
