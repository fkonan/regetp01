<div class="instits view">

<?
$cue_instit = ($instit['Instit']['cue']*100)+$instit['Instit']['anexo'];
?>
<br>
<div id="escuela_estado" class="<? echo $instit['Instit']['activo']? 'instit_activa':'instit_inactiva';?>"><? echo $instit['Instit']['activo']? 'Instituci�n Ingresada al RFIETP':'Instituci�n NO Ingresada al RFIETP';?></div>
<h1><?= $cue_instit ?>
	 - <?= $instit['Instit']['nombre_completo']?>
</h1>
	<?php
	// por ahora no quiero que se muestre porque viene sucio este campo
	//echo $this->element('div_observaciones', array("observacion" => $instit['Instit']['observacion']));

	?>
	
	
	<?php 
	/*---********************************
	 * 
	 * 			HISTORIAL DE CUES
	 * 
	 ********************************----*/	
	?><?php if(count($instit['HistorialCue'])>0):?>
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
		<?php 	$fechamod = "<cite>(utilizado hasta el: ".date("d/m/y",strtotime($cueant['created'])).")</cite>";?>
		<?php   $observacion = $cueant['observaciones'];?>
		<?php 	echo "<b title='$observacion' class='msg-info'>".($cueant['cue']*100+$cueant['anexo'])." ".$fechamod."</b>";?>
		<?php endforeach;?>
		</span>
	</p>
	<?php endif;?>	
	
	
	
	
	
	<h2>Datos de Instituci�n</h2>
		<?php if($con_programa_de_etp){
			echo "<p class='msg-atencion'>$relacion_etp</p>";
		}?>
	<dl>
	
		<?php 
			if(!$con_programa_de_etp){	?>
			<b>
				&nbsp;<?php echo $relacion_etp; ?>
				
			</b>
		<?php }?>
	
		
		<?php 
			if($instit['Instit']['claseinstit_id']){	?>
			<dt><?php __('Tipo de Instituci�n'); ?></dt>
			<dd>
				<?php echo $instit['Claseinstit']['name']; ?>
				&nbsp;
			</dd>
		<?php }?>
		
		<dt ><?php __('�mbito de Gesti�n'); ?></dt>
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
		
		<dt><?php __('Jurisdicci�n'); ?></dt>
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
		
		
		<dt><?php __('C�digo Postal'); ?></dt>
		<dd>
			<?php echo $instit['Instit']['cp']; ?>
			&nbsp;
		</dd>
		
		
		<?php if($instit['Instit']['telefono']): ?>
		<dt><?php __('Tel�fono'); ?></dt>
		<dd>
			<?php echo $instit['Instit']['telefono']; ?>
			&nbsp;
		</dd>
		<?php endif;?>
		
		
		<?php if($instit['Instit']['telefono_alternativo']): ?>
		<dt><?php __('Tel�fono Alternativo'); ?></dt>
		<dd>
			<?php echo $instit['Instit']['telefono_alternativo']; ?>
			&nbsp;
		</dd>
		<?php endif;?>
		
		
		
		<?php if($instit['Instit']['mail']): ?>
		<dt><?php __('E-Mail'); ?></dt>
		<dd>
			<?php echo $instit['Instit']['mail']; ?>
			&nbsp;
		</dd>
		<?php endif;?>
		
		
		<?php if($instit['Instit']['mail_alternativo']): ?>
		<dt><?php __('E-Mail Alternativo'); ?></dt>
		<dd>
			<?php echo $instit['Instit']['mail_alternativo']; ?>
			&nbsp;
		</dd>
		<?php endif;?>
		
		
		<?php if($instit['Instit']['web']): ?>
		<dt><?php __('Web'); ?></dt>
		<dd>
			<?php echo $instit['Instit']['web']; ?>
			&nbsp;
		</dd>
		<?php endif;?>
		

		<dt><?php __('A�o de Creaci�n'); ?></dt>
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
		<dt><?php __('Tipo y N� de Documento'); ?></dt>
		<dd>
			<?php 
			if($instit['Instit']['dir_nrodoc']>0){
				echo $this->requestAction('/tipodocs/tipodoc_nombre/'.$instit['Instit']['dir_tipodoc_id']); 
				echo ' '.$instit['Instit']['dir_nrodoc'];
			}
			?>
			&nbsp;
		</dd>
		
		
		<dt><?php __('Tel�fono'); ?></dt>
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
		<dt><?php __('Tipo y N� de Documento'); ?></dt>
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
	
		<dt><?php __('Actualizaci�n o Ingreso'); ?></dt>
		<dd>
			<?php echo $instit['Instit']['actualizacion']; ?>
			&nbsp;
		</dd>

		
		<dt><?php __('Observaci�n'); ?></dt>
		<dd>
			<?php echo $instit['Instit']['observacion']; ?>
			&nbsp;
		</dd>
		
		<dt><?php __('Alta'); ?></dt>
		<dd>
			<?php echo ($instit['Instit']['ciclo_alta']>0)?$instit['Instit']['ciclo_alta']:''; ?>
			&nbsp;
		</dd>
		<dt><?php __('Modificaci�n'); ?></dt>
		<dd>
			<?php //echo ($instit['Instit']['modified']>0)?$instit['Instit']['modified']:''; ?>
			 
			<?php echo ($instit['Instit']['modified']>0)?date("d/m/Y",strtotime($instit['Instit']['modified'])):''; ?>
			&nbsp;
		</dd>
	</dl>
<br />

<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Editar Instituci�n', true), array('action'=>'edit', $instit['Instit']['id'])); ?> </li>
		<?php if($session->read('Auth.User.role') == 'desarrollo'){?>
			<li><?php echo $html->link(__('Eliminar Instituci�n', true), array('action'=>'delete', $instit['Instit']['id']), null, sprintf(__('�Seguro que desea eliminar la instituci�n? CUE: "%s"', true), $instit['Instit']['cue']. "0".$instit['Instit']['anexo'])); ?></li>
			<li><?php echo $html->link('ABM CUE Hist�rico', array('controller'=>'HistorialCues','action'=>'index', $instit['Instit']['id'])); ?></li>
		<?php }?>
	</ul>
</div>

	<h2>M�s Informaci�n</h2>
	<ul id="instits-mas-info">
		<li><?= $html->link('Oferta Educativa '.date('Y',strtotime('now')).' ('.$cantOfertas.')',array('controller'=>'Planes','action'=>'index', $instit['Instit']['id'])) ?></li>
	</ul>

</div>

