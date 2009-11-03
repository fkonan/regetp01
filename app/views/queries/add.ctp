<div class="queries form">
<?php echo $form->create('Query');?>
	<fieldset>
 		<legend><?php __('Add Query');?></legend>
	<?php
		echo $form->input('name');
		echo $form->input('description');
		echo $form->input('query');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Queries', true), array('action'=>'index'));?></li>
	</ul>
</div>
