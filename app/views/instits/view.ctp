<div class="instits view">

<?

//si el anexo tiene 1 solo digito le coloco un cero adelante
$anexo = ($instit['Instit']['anexo']<10)?'0'.$instit['Instit']['anexo']:$instit['Instit']['anexo'];
$cue_instit = $instit['Instit']['cue'].$anexo;
?>
<br>
<div id="escuela_estado" class="<? echo $instit['Instit']['activo']? 'instit_activa':'instit_inactiva';?>"><? echo $instit['Instit']['activo']? 'Institución Ingresada al RFIETP':'Institución NO Ingresada al RFIETP';?></div>
<h1><?= $cue_instit ?>
	 - <?= $instit['Instit']['nombre_completo']?>
</h1>

	
	<h2>Datos de Institución</h2>
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
			<?php echo $instit['Instit']['depto']; ?>
			&nbsp;
		</dd>
		
		
		<dt><?php __('Localidad'); ?></dt>
		<dd>
			<?php echo $instit['Instit']['localidad']; ?>
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
		<dt><?php __('Observaciones'); ?></dt>
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
	</ul>
</div>

<h2>Más Información</h2>
<ul id="listado_ofertas">
	<li><?= $html->link('Oferta Educativa',array('controller'=>'Instits','action'=>'planes_relacionados', $instit['Instit']['id'])) ?></li>
</ul>

</div>


