<div class="tipoinstits form">
<?php echo $form->create('Tipoinstit');?>
	<fieldset>
 		<legend><?php __('Edit Tipoinstit');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('jurisdiccion_id');
		echo $form->input('name');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Tipoinstit.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Tipoinstit.id'))); ?></li>
		<li><?php echo $html->link(__('List Tipoinstits', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List Jurisdicciones', true), array('controller'=> 'jurisdicciones', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Jurisdiccion', true), array('controller'=> 'jurisdicciones', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Instits', true), array('controller'=> 'instits', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Instit', true), array('controller'=> 'instits', 'action'=>'add')); ?> </li>
	</ul>
</div>
