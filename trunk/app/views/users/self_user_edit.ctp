<h1>Editar Usuario</h1>
<div class="users form">
<?php echo $form->create('User',array('action' => 'self_user_edit'));?>
	<fieldset>
	<?php
		echo $form->input('id');
		echo $form->input('username',array('label'=>'Usuario'));
		echo $form->input('nombre');
		echo $form->input('apellido');
		$opciones = array('admin'=>'Administrador', 'editor'=> 'Editor', 'invitado'=>'Usuario de Consulta');
		
		
		?><h2>Información Extra</h2><?
		echo $form->input('mail');
		echo $form->input('oficina');
		echo $form->input('interno');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
