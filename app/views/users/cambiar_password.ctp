<h1>Cambiar su password</h1>
<div class="users form">
<?php echo $form->create('User',array('action' => 'cambiarPassword'));?>
	<fieldset>
	<?php
		echo $form->input('password',array('label'=>'Ingrese una nueva contraseņa'));
		?><cite>(Borre previamente los asteriscos)</cite><br /><?php 
		echo $form->input('password_check',array('label'=>'Reingrese su contraseņa','type'=>'password'));

	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
