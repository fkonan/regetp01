<div class="instits view">
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Editar Institución', true), array('action'=>'edit', $instit['Instit']['id'])); ?> </li>
	</ul>
</div>
<div id="escuela_estado" class="<? echo $instit['Instit']['activo']? 'instit_activa':'instit_inactiva';?>"><? echo $instit['Instit']['activo']? 'Activa':'Inactiva';?></div>
<h2><?php echo $instit['Instit']['cue'].'-0'.$instit['Instit']['anexo']." <br>".$instit['Instit']['nombre']; ?></h2>

	<dl>
		
		<dt><?php __('Tipo de Institución'); ?></dt>
		<dd>
			<?php echo $instit['Tipoinstit']['name']; ?>
			&nbsp;
		</dd>
		
		<dt ><?php __('Gestión'); ?></dt>
		<dd>
			<?php echo $instit['Gestion']['name']; ?>
			&nbsp;
		</dd>
		
		<dt><?php __('Dependencia'); ?></dt>
		<dd>
			<?php echo $instit['Dependencia']['name']; ?>
			&nbsp;
		</dd>
		
		<dt><?php __('Jurisdicción'); ?></dt>
		<dd>
			<?php echo $instit['Jurisdiccion']['name']; ?>
			&nbsp;
		</dd>
		
		
		
		<dt><?php __('Nº de Institución'); ?></dt>
		<dd>
			<?php echo $instit['Instit']['nroinstit']; ?>
			&nbsp;
		</dd>
		<dt><?php __('Año de Creación'); ?></dt>
		<dd>
			<?php echo $instit['Instit']['anio_creacion']; ?>
			&nbsp;
		</dd>
	</dl>
		
		<h2>Datos Establecimiento</h2>
	<dl>
		<dt><?php __('Domicilio'); ?></dt>
		<dd>
			<?php echo $instit['Instit']['direccion']; ?>
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
		<dt><?php __('CP'); ?></dt>
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
			<?php echo ($instit['Instit']['ciclo_mod']>0)?$instit['Instit']['ciclo_mod']:''; ?>
			&nbsp;
		</dd>
	</dl>
<br />
<h2>Más Información</h2>
<ul id="listado_ofertas">
	<li><?= $html->link('Oferta Educativa',array('action'=>'planes_relacionados', $instit['Instit']['id'])) ?></li>
</ul>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Editar Institución', true), array('action'=>'edit', $instit['Instit']['id'])); ?> </li>
	</ul>
</div>
</div>


