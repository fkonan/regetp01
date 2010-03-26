<div class="titulos form">
<?php echo $form->create('Titulo');?>
	<fieldset>
 		<legend><?php __('Nuevo Título');?></legend>
	<?php
                echo $form->input('id');
		echo $form->input('name', array('label'=>'Nombre del Título'));
		echo $form->input('marco_ref', array(//'label'=>'',
                                                    'legend'=>'Marco de Referencia',
                                                    //'div'=>'',
                                                   // 'style' => 'float: left',
                                                    'type'=>'radio',
                                                    'options'=>array(1=>'Con Marco de Referencia', 0=>'Sin marco de Referencia'))
		);
		echo $form->hidden('old_oferta_id');
		echo $form->input('oferta_id');
	?>
	</fieldset>
<?php echo $form->end('guardar');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Listar Títulos', true), array('action'=>'index'));?></li>
	</ul>
</div>