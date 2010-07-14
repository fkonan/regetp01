<h1>Editar datos de usuario <b><?=$this->data['User']['username']?></b></h1>
<div class="users form">
<?php echo $form->create('User',array('action' => 'self_user_edit'));?>
	<fieldset>
	<?php
		echo $form->input('id');
		
		echo $form->input('nombre');
		echo $form->input('apellido');
		$opciones = array('admin'=>'Administrador', 'editor'=> 'Editor', 'invitado'=>'Usuario de Consulta');
		
		
		?><h2>Información de Contacto</h2><?
		echo $form->input('mail');
		echo $form->input('oficina');
		echo $form->input('interno');
	?>
	</fieldset>
<?php echo $form->end('Guardar');?>
</div>
