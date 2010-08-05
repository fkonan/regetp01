<div class="trayectos form">
<?php echo $form->create('Trayecto');?>
	<fieldset>
 		<legend><?php __('Add Trayecto');?></legend>
	<?php
		echo $form->input('name');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Trayectos', true), array('action'=>'index'));?></li>
	</ul>
</div>
