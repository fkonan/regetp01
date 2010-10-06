<div class="estructuraPlanesAnios form">
<?php echo $form->create('EstructuraPlanesAnio');?>
	<fieldset>
 		<legend><?php __('Edit EstructuraPlanesAnio');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('estructura_planes_anio_id');
		echo $form->input('edad_teorica');
		echo $form->input('anio');
		echo $form->input('anio_escolaridad');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('EstructuraPlanesAnio.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('EstructuraPlanesAnio.id'))); ?></li>
		<li><?php echo $html->link(__('List estructuraPlanesAnios', true), array('action'=>'index'));?></li>
	</ul>
</div>
