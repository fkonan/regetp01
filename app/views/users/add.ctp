<h1>Registro de Nuevo Usuario</h1>
<div class="users form">
<?php echo $form->create('User');?>
	<fieldset>
	<?php
		echo $form->input('username',array('label'=>'Usuario'));
		echo $form->input('nombre');
		echo $form->input('apellido');
		//$opciones = array('admin'=>'Administrador', 'editor'=> 'Editor', 'invitado'=>'Usuario de Consulta');
		//echo $form->input('role',array('options'=>$opciones));
                echo $form->input('grupo', array('options'=>$aros));
                echo $form->input('jurisdiccion_id', array('empty' => array('0'=>' -- '),'id'=>'jurisdiccion_id','label'=>'Jurisdicción'));
		echo $form->input('password');
		echo $form->input('password_check',array('label'=>'Reingrese Password','type'=>'password'));
		
		echo $form->input('role',array('type'=>'hidden'));
		?><h2>Información Extra</h2><?
		echo $form->input('mail');
		echo $form->input('oficina');
		echo $form->input('interno');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Users', true), array('action'=>'index'));?></li>
	</ul>
</div>
