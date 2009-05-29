<h1>Cambiar su password</h1>
<div class="users form">
<?php echo $form->create('User',array('action' => 'cambiarPassword'));?>
	<fieldset>
	<?php
		echo $form->input('password',array('Ingrese una nueva contraseña'));
		echo $form->input('password_check',array('label'=>'Reingrese su contraseña','type'=>'password'));

	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
