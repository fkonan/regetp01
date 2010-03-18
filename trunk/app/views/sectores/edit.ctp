<div class="titulos form"> 
<?php echo $form->create('Titulo');?>
	<fieldset>
 		<legend><?php __('Nuevo Título');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('name', array('label'=>'Nombre del Título'));
		echo $form->input('marco_ref', array('legend'=>false, 
											'type'=>'radio', 
											'options'=>array(1=>'Con Marco de Referencia', 0=>'Sin Marco de Referencia'),
			)
		);
		echo $form->input('oferta_id');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Titulos', true), array('action'=>'index'));?></li>
	</ul>
</div>
