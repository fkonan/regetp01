<h1>Registro de Nuevo Usuario</h1>
<div class="users form">
<?php echo $form->create('User');?>
	<fieldset>
	<?php
		echo $form->input('username',array('label'=>'Nick'));
		echo $form->input('nombre');
		echo $form->input('apellido');
		echo $form->input('role');
		echo $form->input('group_id',array('type'=>'select','options'=>$grupos, array('empty'=>array(1=>'Invitados'))));
		echo $form->input('password');
		echo $form->input('password_check',array('label'=>'Reingrese Password','type'=>'password'));
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Users', true), array('action'=>'index'));?></li>
	</ul>
</div>
