<?
if(isset($script)){
	echo $script;
}
?>
	
<h1 align="center"> <?= "Editar Datos" ?></h1>
<div class="anios form">
<?php echo $form->create('Ticket');?>
	<fieldset>
	<?php
		echo $form->input('id');
		echo $form->input('user_name', array('readonly'=>true, 'type'=>'text','label'=>'Usuario responsable', 'value'=>$user['nombre']." ".$user['apellido']));
		echo $form->input('modified', array('readonly'=>true, 'type'=>'text','label'=>'Última modificación'));				
		echo $form->input('observacion', array('label'=>'Observación'));
		
		echo $form->input('estado',array('type'=> 'checkbox','checked'=>false,'label'=>'Resuelto.'));
	?>
	</fieldset>
<?php echo $form->end('Guardar');?>
</div>