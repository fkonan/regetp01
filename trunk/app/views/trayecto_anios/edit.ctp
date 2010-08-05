<div class="trayectoAnios form">
<?php echo $form->create('TrayectoAnio');?>
	<fieldset>
 		<legend><?php __('Edit TrayectoAnio');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('trayecto_id');
		echo $form->input('edad_teorica');
		echo $form->input('anio');
		echo $form->input('etapa_id');
		echo $form->input('anio_escolaridad');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('TrayectoAnio.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('TrayectoAnio.id'))); ?></li>
		<li><?php echo $html->link(__('List TrayectoAnios', true), array('action'=>'index'));?></li>
	</ul>
</div>
