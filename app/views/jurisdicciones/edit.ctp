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
