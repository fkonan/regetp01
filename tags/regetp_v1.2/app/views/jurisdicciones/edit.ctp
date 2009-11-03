<div class="jurisdicciones form">
<?php echo $form->create('Jurisdiccion');?>
	<fieldset>
 		<legend><?php __('Edit Jurisdiccion');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('name');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Jurisdiccion.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Jurisdiccion.id'))); ?></li>
		<li><?php echo $html->link(__('List Jurisdicciones', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List Tipoinstits', true), array('controller'=> 'tipoinstits', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Tipoinstit', true), array('controller'=> 'tipoinstits', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Instits', true), array('controller'=> 'instits', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Instit', true), array('controller'=> 'instits', 'action'=>'add')); ?> </li>
	</ul>
</div>
