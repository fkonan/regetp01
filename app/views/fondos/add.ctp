<div class="fondos form">
<?php echo $form->create('Fondo');?>
	<fieldset>
 		<legend><?php __('Add Fondo');?></legend>
	<?php
		echo $form->input('instit_id');
		echo $form->input('jurisdiccion_id');
		echo $form->input('total');
		echo $form->input('anio');
		echo $form->input('trimestre');
		echo $form->input('memo');
		echo $form->input('resolucion');
		echo $form->input('description');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Fondos', true), array('action' => 'index'));?></li>
	</ul>
</div>
