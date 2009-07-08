<div class="localidades form">
<?php echo $form->create('Localidad');?>
	<fieldset>
 		<legend><?php __('Add Localidad');?></legend>
	<?php
		echo $form->input('departamento_id');
		echo $form->input('name');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Localidades', true), array('action'=>'index'));?></li>
	</ul>
</div>
