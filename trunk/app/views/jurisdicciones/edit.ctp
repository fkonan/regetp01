<div class="jurisdicciones form">
<h1>Editar Jurisdicción </h1>
<?php echo $form->create('Jurisdiccion');?>
	<fieldset>
	<?php
		echo $form->input('id');
		echo $form->input('name');
	?>
	</fieldset>
<?php echo $form->end('Guardar');?>
</div>
