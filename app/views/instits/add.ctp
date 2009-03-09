<div class="instits form">
<?php echo $form->create('Instit');?>
	<fieldset>
 		<legend><?php __('Nueva Institución');?></legend>
	<?php
		echo $form->input('id');		
		echo $form->input('activo',array('type'=> 'checkbox'));		
		echo $form->input('cue');
		echo $form->input('anexo');
		echo $form->input('esanexo',array('type'=> 'checkbox'));
						
		echo $form->input('nombre');
		echo $form->input('nroinstit');		
				
		echo $form->input('gestion_id');
		echo $form->input('dependencia_id');
		echo $form->input('anio_creacion');		
		echo $form->input('direccion');
		echo $form->input('localidad');		
		echo $form->input('depto');	
		echo $form->input('jurisdiccion_id');
		echo $form->input('tipoinstit_id');					
		echo $form->input('cp');
		
		echo $form->input('telefono');				
		echo $form->input('web');
		echo $form->input('mail');	
		
		?><H3>Datos Director</H3><?		
		echo $form->input('dir_nombre');
		echo $form->input('dir_tipodoc_id');
		echo $form->input('dir_nrodoc');
		echo $form->input('dir_telefono');
		echo $form->input('dir_mail');
		
		?><H3>Datos Vice Director</H3><?
		echo $form->input('vice_nombre');
		echo $form->input('vice_tipodoc_id');
		echo $form->input('vice_nrodoc');		
		
		?><H3>Datos Extra</H3><?
		echo $form->input('actualizacion',array('label'=>'Ingresar solo el año de actualización'));
		echo $form->input('observacion',array('type'=>'textarea'));
		echo $form->input('fecha_mod');
		$ciclos = array('2006','2007','2008','2009','2010','2011');
		echo $form->input('ciclo_alta', array("type" => "select", 
											  "options" => $ciclos));
		echo $form->input('ciclo_mod', array("type" => "select", 
											  "options" => $ciclos,
											  "label" => 'Ciclo Modificación'));
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Instits', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List Gestiones', true), array('controller'=> 'gestiones', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Gestion', true), array('controller'=> 'gestiones', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Dependencias', true), array('controller'=> 'dependencias', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Dependencia', true), array('controller'=> 'dependencias', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Tipoinstits', true), array('controller'=> 'tipoinstits', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Tipoinstit', true), array('controller'=> 'tipoinstits', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Jurisdicciones', true), array('controller'=> 'jurisdicciones', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Jurisdiccion', true), array('controller'=> 'jurisdicciones', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Planes', true), array('controller'=> 'planes', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Plan', true), array('controller'=> 'planes', 'action'=>'add')); ?> </li>
	</ul>
</div>
