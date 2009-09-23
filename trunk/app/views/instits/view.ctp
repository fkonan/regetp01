<div class="instits view">

<?
$cue_instit = ($instit['Instit']['cue']*100)+$instit['Instit']['anexo'];
?>
<br>
<div id="escuela_estado" class="<? echo $instit['Instit']['activo']? 'instit_activa':'instit_inactiva';?>"><? echo $instit['Instit']['activo']? 'Institución Ingresada al RFIETP':'Institución NO Ingresada al RFIETP';?></div>
<h1><?= $cue_instit ?>
	 - <?= $instit['Instit']['nombre_completo']?>
</h1>
	<?php
	// por ahora no quiero que se muestre porque viene sucio este campo
	//echo $this->element('div_observaciones', array("observacion" => $instit['Instit']['observacion']));

	?>
	
	<?php if(count($instit['HistorialCue'])>0):?>
	<p class="cues-anteriores">		
		<?php echo $html->image('cambio_cue.gif')?>
		<span class="cues-anteriores-title">
		<?php if(count($instit['HistorialCue']) == 1):?>
						  CUE anterior:	
		<?php else: echo "CUEs anteriores:";?>
		<?php endif;?>
		</span>
		<span class="cues-anteriores-text">
		<?php $primero = true;?>
		<?php foreach($instit['HistorialCue'] as $cueant):?>
		<?php 	echo ($primero)?"<br>":","; $primero = false;?>
		<?php 	$fechamod = date("d/m/y",strtotime($cueant['created']));?>
		<?php 	echo "<b>".($cueant['cue']*100+$cueant['anexo'])."</b><cite>(modificado: $fechamod)</cite>";?>
		<?php endforeach;?>
		</span>
	</p>
	<?php endif;?>	
	
	<h2>Datos de Institución</h2>
		<?php if($instit_etp){
			echo "<p class='instit-etp'>Institución con programa de ETP</p>";
		}?>
	<dl>
		
		<dt ><?php __('Ámbito de Gestión'); ?></dt>
		<dd>
			<?php echo $instit['Gestion']['name']; ?>
			&nbsp;
		</dd>
		
		<dt><?php __('Tipo de Dependencia'); ?></dt>
		<dd>
			<?php echo $instit['Dependencia']['name']; ?>
			&nbsp;
		</dd>
		
		<? if($instit['Instit']['nombre_dep']): ?>
		<dt><?php __('Nombre de la Dependencia'); ?></dt>
		<dd>
			<?php echo $instit['Instit']['nombre_dep']; ?>
			&nbsp;
		</dd>
		<? endif; ?>
		
		<dt><?php __('Jurisdicción'); ?></dt>
		<dd>
			<?php echo $instit['Jurisdiccion']['name']; ?>
			&nbsp;
		</dd>
		
		
		<dt><?php __('Departamento'); ?></dt>
		<dd>
			<?php echo $instit['Departamento']['name']; ?>
			&nbsp;
		</dd>
		
		
		<dt><?php __('Localidad'); ?></dt>
		<dd>
			<?php echo $instit['Localidad']['name']; ?>
			&nbsp;
		</dd>
		
		<dt><?php __('Barrio/Pueblo/Comuna'); ?></dt>
		<dd>
			<?php echo $instit['Instit']['lugar']; ?>
			&nbsp;
		</dd>
		
		<dt><?php __('Domicilio'); ?></dt>
		<dd>
			<?php echo $instit['Instit']['direccion']; ?>
			&nbsp;
		</dd>
		
		
		<dt><?php __('Código Postal'); ?></dt>
		<dd>
			<?php echo $instit['Instit']['cp']; ?>
			&nbsp;
		</dd>
		<dt><?php __('Teléfono'); ?></dt>
		<dd>
			<?php echo $instit['Instit']['telefono']; ?>
			&nbsp;
		</dd>
		<dt><?php __('E-Mail'); ?></dt>
		<dd>
			<?php echo $instit['Instit']['mail']; ?>
			&nbsp;
		</dd>
		<dt><?php __('Web'); ?></dt>
		<dd>
			<?php echo $instit['Instit']['web']; ?>
			&nbsp;
		</dd>
		

		<dt><?php __('Año de Creación'); ?></dt>
		<dd>
			<?php echo ($instit['Instit']['anio_creacion']==0)?'':$instit['Instit']['anio_creacion']; ?>
			&nbsp;
		</dd>
	</dl>
		
		
	<H2>Datos Director</H2>
	<dl>		
		<dt><?php __('Nombre y Apellido'); ?></dt>
		<dd>
			<?php echo $instit['Instit']['dir_nombre']; ?>
			&nbsp;
		</dd>
		<dt><?php __('Tipo y Nº de Documento'); ?></dt>
		<dd>
			<?php 
			if($instit['Instit']['dir_nrodoc']>0){
				echo $this->requestAction('/tipodocs/tipodoc_nombre/'.$instit['Instit']['dir_tipodoc_id']); 
				echo ' '.$instit['Instit']['dir_nrodoc'];
			}
			?>
			&nbsp;
		</dd>
		<dt><?php __('Teléfono'); ?></dt>
		<dd>
			<?php echo $instit['Instit']['dir_telefono']; ?>
			&nbsp;
		</dd>
		<dt><?php __('E-Mail'); ?></dt>
		<dd>
			<?php echo $instit['Instit']['dir_mail']; ?>
			&nbsp;
		</dd>
	</dl>
	
	<H2>Datos Vice Director</H2>
	<dl>
		<dt><?php __('Nombre y Apellido'); ?></dt>
		<dd>
			<?php echo $instit['Instit']['vice_nombre']; ?>
			&nbsp;
		</dd>
		<dt><?php __('Tipo y Nº de Documento'); ?></dt>
		<dd>
		<?
			if($instit['Instit']['vice_nrodoc']>0){
				echo $this->requestAction('/tipodocs/tipodoc_nombre/'.$instit['Instit']['vice_tipodoc_id']); 
				echo ' '.$instit['Instit']['vice_nrodoc'];
			}
		?>
			&nbsp;
		</dd>
	</dl>
	
	<H2>Datos Adicionales</H2>
	<dl>
		<dt><?php __('Fecha Mod (<2009)'); ?></dt>
		<dd>
			<?php echo ($instit['Instit']['fecha_mod']>0)?date("d/m/Y",strtotime($instit['Instit']['fecha_mod'])):''; ?>
			&nbsp;
		</dd>
	
		<dt><?php __('Actualización o Ingreso'); ?></dt>
		<dd>
			<?php echo $instit['Instit']['actualizacion']; ?>
			&nbsp;
		</dd>

		
		<dt><?php __('Observación'); ?></dt>
		<dd>
			<?php echo $instit['Instit']['observacion']; ?>
			&nbsp;
		</dd>
		
		<dt><?php __('Alta'); ?></dt>
		<dd>
			<?php echo ($instit['Instit']['ciclo_alta']>0)?$instit['Instit']['ciclo_alta']:''; ?>
			&nbsp;
		</dd>
		<dt><?php __('Modificación'); ?></dt>
		<dd>
			<?php //echo ($instit['Instit']['modified']>0)?$instit['Instit']['modified']:''; ?>
			 
			<?php echo ($instit['Instit']['modified']>0)?date("d/m/Y",strtotime($instit['Instit']['modified'])):''; ?>
			&nbsp;
		</dd>
	</dl>
<br />

<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Editar Institución', true), array('action'=>'edit', $instit['Instit']['id'])); ?> </li>
		<li><?php echo $html->link(__('Eliminar Institución', true), array('action'=>'delete', $instit['Instit']['id']), null, sprintf(__('¿Seguro que desea eliminar la institución? CUE: "%s"', true), $instit['Instit']['cue']. "0".$instit['Instit']['anexo'])); ?></li>
		
	</ul>
</div>

	<h2>Más Información</h2>
	<ul id="instits-mas-info">
		<li><?= $html->link('Oferta Educativa ('.sizeof($instit['Plan']).')',array('controller'=>'Planes','action'=>'index', $instit['Instit']['id'])) ?></li>
	</ul>

</div>


