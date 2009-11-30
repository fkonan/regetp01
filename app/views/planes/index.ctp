<div class="related">

<?php 
	$link = "";
	if($ticket_id != 0)
	{
		$link = " - <a class='aPend' href=\"";
		$link .= $html->url(array('controller'=> 'tickets', 'action'=>$action.'/'.$ticket_id));
		$link .= "\" onClick=\"window.open('".$html->url(array('controller'=> 'tickets', 'action'=>$action.'/'.$ticket_id));
		$link .= "','_blank' , 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=310,height=390');";
		$link .= " return false;\">Pendiente de Actualización</a>"; 
	}
?>

<h1><?php __('Oferta Educativa');?><? echo $link; ?></h1>

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

<?php
	//if(isset($sumatoria_matriculas['array_de_ciclos'])>0 && isset($sumatoria_matriculas['array_de_ofertas'])>0):
	if(isset($planes['Plan'])  && count($planes['Plan'])>0):
		if(isset($sumatoria_matriculas['array_de_ciclos'])>0 && isset($sumatoria_matriculas['array_de_ofertas'])>0):
			$v_matriculas_ciclos = array_reverse($sumatoria_matriculas['array_de_ciclos']);
		?>
		<h2>Oferta</h2>	
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
			</div>
	<?php endif ?>

<!-- TABS DE CICLOS ULT. ACTUALIZACIONES  -->
<div class="tabs">
	<h2>Listado de Ofertas</h2>
	<div class="tabs-list">
		<?php 
			$current_ciclo = $url_conditions['Anio.ciclo_id'];
			foreach ($ciclos as $c):?>
				<?php 
				$instit_id = $planes['Instit']['id'];
				
				if($current_ciclo == $c) {
					$clase = 'tab-activa';
				}else {
					$clase = 'tab-inactiva';
				}
				?>
			<span class="<?= $clase;?>"><?php echo $html->link($c,"/planes/index/$instit_id/Anio.ciclo_id:$c");?></span>
		<?php endforeach;?>
		
			<?php 
			if($current_ciclo == 0) {
				$clase = 'tab-activa';
			}else{
				$clase = 'tab-inactiva';
			}
			?>
			<span class="<?= $clase;?>"><?php echo $html->link('Ver Todos',"/planes/index/$instit_id/Anio.ciclo_id:0");?></span>
	</div>
		
	<div class="tabs-content">	
		<table cellpadding="0" cellspacing="0" class="tabla-con-bordes-celeste">
		<tr>
            <th style="display:none"><?php echo $form->create('Plan',array('action' =>'index'));
                  echo $form->hidden('Instit.id',array('value' => $url_conditions['Instit.id']));
                  echo $form->hidden('Anio.ciclo_id',array('value' => $url_conditions['Anio.ciclo_id']));?>
            </th>      
			<th><?php echo $form->input('oferta_id',array('options'=> $ofertas,'label'=>'','empty'=> array('0'=>'Todas'),'selected' => isset($url_conditions['Plan.oferta_id']) ? $url_conditions['Plan.oferta_id'] : '0'));?></th>
			<th><?php echo $form->input('nombre', array('label'=>'','value' => isset($url_conditions['Plan.nombre']) ? $url_conditions['Plan.nombre'] : ''));?></th>
			<th><?php echo $form->input('sector_id',array('options'=> $sectores,'label'=>'','empty'=> array('0'=>'Todas'),'selected' => isset($url_conditions['Plan.sector_id']) ? $url_conditions['Plan.sector_id'] : '0'));?></th>
			<th colspan=2><?php echo $form->end('Buscar');?></th>
		</tr>
		<tr>
			<th><?php echo $paginator->sort('Oferta','Oferta.abrev');?></th>
			<th><?php echo $paginator->sort('Nombre del Título/Certificación','nombre');?></th>
			<th><?php echo $paginator->sort('Sector','Sector.name');?></th>
			<th><?php echo 'Mat.';?></th>
			<th class="actions"><?php echo '&nbsp';?></th>
		</tr>
		<?php
		$i = 0;
		if ((isset($planesRelacionados)) && (count($planesRelacionados) > 0)){
			foreach ($planesRelacionados as $plan):
				$class = null;
				if ($i++ % 2 == 0) {
					$class = ' class="altrow"';
				}
			?>
				<tr id="fila_plan_<?= $plan['Plan']['id'];?>" <?php echo $class;?> 
						onclick="window.location='<?= $html->url(array('controller'=> 'Planes', 'action'=>'view/'.$plan['Plan']['id']))?>'"
						onmouseout="$('fila_plan_<?= $plan['Plan']['id'];?>').removeClassName('fila_marcada')" 
						onmouseover="$('fila_plan_<?= $plan['Plan']['id'];?>').addClassName('fila_marcada')"
				>
			
					<td>
						<?php echo $plan['Oferta']['abrev']; ?>
					</td>
					<td>
						<?php echo $plan['Plan']['nombre']; ?>
					</td>
					<td>
						<?php echo $plan['Sector']['name']; ?>
					</td>
					<td>
						<?php 
						$ciclo_actualizacion = '';
						if($url_conditions['Anio.ciclo_id'] ==0){
							$ciclo_actualizacion = " (".$plan['Anio']['ciclo_id'].")";
						}
						if ($plan['calculado']['sum_matricula'] > 0){ 					
							echo $plan['calculado']['sum_matricula'].$ciclo_actualizacion; 
						} else {
							echo "0";
						}
						?>
					</td>
					<td class="actions">
						<?php echo $html->link(__('Ver', true), array('action'=>'view', $plan['Plan']['id'])); ?>
					</td>
				</tr>
		<?php endforeach;
		} else {
		?>
			<tr>
				<td colspan=4>
					&nbsp;
				</td>
			</tr>
			<tr>
				<td colspan=4>
					<?php $año_actual = date('Y',strtotime('now'));?>
					<?php if($datoUltimoCiclo['max_ciclo'] != $año_actual && $current_ciclo == $año_actual):?>
						<p class='msg-atencion'>La Instituci&oacute;n no presenta actualizaciones para este año</p>
					<?php else:?>
						<p class='msg-atencion'>No se obtuvieron resultados</p>
					<?php endif;?>
				</td>
			</tr>
		<?php	
		} ?>
		</table>
		<div id="paginator_prev_next_links">
		<?php	
			echo $paginator->prev('« Anterior ',null, null, array('class' => 'disabled'));
			echo " | ".$paginator->numbers(array('modulus'=>'9'))." | ";
			echo $paginator->next(' Siguiente »', null, null, array('class' => 'disabled'));
		?> 
		</div>
	</div>	
</div>		
</div>
	


<?php endif;?>

<div class="actions">
	<ul>
        <li><?php echo $html->link(__('Nueva Oferta', true), array('controller'=> 'planes', 'action'=>'add/'. $planes['Instit']['id']));?> </li>
        <?php 
        // Si puede editar y tiene ticket edita, sino crea
        if($action!='view')
        {
        	if($ticket_id != 0)
			{
			?><li><a href="<?= $html->url(array('controller'=> 'tickets', 'action'=>'edit/'.$ticket_id))?>" onClick="window.open('<?= $html->url(array('controller'=> 'tickets', 'action'=>'edit/'.$ticket_id))?>','_blank' , 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=310,height=390'); return false;">Editar Pendiente</a></li><?
			}
			else
			{
			?><li><a href="<?= $html->url(array('controller'=> 'tickets', 'action'=>'add/'.$planes['Instit']['id']))?>" onClick="window.open('<?= $html->url(array('controller'=> 'tickets', 'action'=>'add/'.$planes['Instit']['id']))?>','_blank' , 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=310,height=260'); return false;">Nuevo Pendiente</a></li><?	
			}
		}
		?>	
	</ul>
</div>

