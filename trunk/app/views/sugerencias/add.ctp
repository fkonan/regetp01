<div class="sugerencias form">
<h1>
<?php echo $html->image('bulbIcon_normal.png', array(
                            'height'=>'40px',
                            'align'=>'absmiddle',
                            'style'=>'botom: -5px;',
                            'alt'=>'idea',
                            'title'=>'Idea')); ?>
                           <?php __('Sugerencias');?></h1>
Esperamos que su visita sea de su agrado, cualquier sugerencia o mejora para nuestra web, por favor háganosla llegar completando el siguiente formulario.
<?php echo $form->create('Sugerencia');?>
	<fieldset>
	<?php
		// echo $form->input('asunto');
		//echo $form->hidden( 'asunto' );
		echo $form->hidden('asunto', array('value'=>'Sugerencia por medio Web'));
		echo $form->input('mensaje', array('label'=>''));
		echo $form->hidden('remitente', array('value'=>$session->read('Auth.User.id')));
		echo $form->hidden('email', array('value'=>$session->read('Auth.User.mail')));
		echo $form->hidden('IP', array('value'=>$_SERVER['REMOTE_ADDR']));
		// echo $form->input('leido');
	?>
	</fieldset>
<?php echo $form->end('Enviar Sugerencia');?>
</div>

