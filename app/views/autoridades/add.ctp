<div class="autoridades form">
<?php echo $form->create('Autoridad');?>
	<fieldset>
 		<legend><?php __('Add Autoridad');?></legend>
	<?php
		echo $form->input('jurisdiccion_id');
		echo $form->input('nombre');
		echo $form->input('apellido');
		echo $form->input('fecha_asuncion');
		echo $form->input('titulo');
		echo $form->input('telefono_personal');
		echo $form->input('telefono_institucional');
		echo $form->input('email_personal');
		echo $form->input('email_institucional');
		echo $form->input('direccion');
		echo $form->input('localidad_id');
		echo $form->input('departamento_id');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Autoridades', true), array('action' => 'index'));?></li>
	</ul>
</div>
