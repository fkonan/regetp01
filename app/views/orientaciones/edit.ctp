<div class="orientaciones form">
<?php echo $form->create('Orientacion');?>
	<fieldset>
 		<legend><?php __('Editar Orientación');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('name', array('label'=>'Nombre'));
	?>
	</fieldset>
<?php echo $form->end('Guardar');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Borrar', true), array('action'=>'delete', $form->value('Orientacion.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Orientacion.id'))); ?></li>
		<li><?php echo $html->link(__('Listar Orientaciones', true), array('action'=>'index'));?></li>
	</ul>
</div>