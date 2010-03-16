<div class="titulos form">
<?php echo $form->create('Titulo');?>
	<fieldset>
 		<legend><?php __('Edit Titulo');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('name');
		echo $form->input('marcoref', array('label'=>'Marco de referencia', 'type'=>'radio', 'options'=>array(1=>'Con', 0=>'Sin')));
		echo $form->input('oferta_id');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Titulo.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Titulo.id'))); ?></li>
		<li><?php echo $html->link(__('List Titulos', true), array('action'=>'index'));?></li>
	</ul>
</div>