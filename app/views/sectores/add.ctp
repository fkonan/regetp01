<<<<<<< .mine
<div class="titulos form">
<?php echo $form->create('Titulo');?>
=======
<div class="orientaciones form">
<?php echo $form->create('Sector');?>
>>>>>>> .r290
	<fieldset>
<<<<<<< .mine
 		<legend><?php __('Add Titulo');?></legend>
=======
 		<legend><?php __('Add Orientacion');?></legend>
>>>>>>> .r290
	<?php
		echo $form->input('name');
<<<<<<< .mine
		echo $form->input('marcoref', array('label'=>'Marco de referencia', 
											'type'=>'radio', 
											'options'=>array(1=>'Con', 0=>'Sin'))
		);
		echo $form->input('oferta_id');
=======
>>>>>>> .r290
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
<<<<<<< .mine
		<li><?php echo $html->link(__('List Titulos', true), array('action'=>'index'));?></li>
=======
		<li><?php echo $html->link(__('List Orientaciones', true), array('action'=>'index'));?></li>
>>>>>>> .r290
	</ul>
</div>
