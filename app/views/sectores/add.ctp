<div class="orientaciones form">
<?php echo $form->create('Sector');?>
	<fieldset>
 		<legend><?php __('Add Orientacion');?></legend>
	<?php
		echo $form->input('name');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Orientaciones', true), array('action'=>'index'));?></li>
	</ul>
</div>
