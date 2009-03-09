<div class="planes form">
<?php echo $form->create('Plan');?>
	<fieldset>
 		<legend><?php __('Edit Plan');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('instit_id');
		echo $form->input('oferta_id');
		echo $form->input('old_item');
		echo $form->input('norma');
		echo $form->input('nombre');
		echo $form->input('perfil');
		echo $form->input('sector');
		echo $form->input('duracion_hs');
		echo $form->input('duracion_semanas');
		echo $form->input('duracion_anios');
		echo $form->input('matricula');
		echo $form->input('observacion');
		echo $form->input('ciclo_alta');
		echo $form->input('ciclo_mod');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Plan.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Plan.id'))); ?></li>
		<li><?php echo $html->link(__('List Planes', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List Instits', true), array('controller'=> 'instits', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Instit', true), array('controller'=> 'instits', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Ofertas', true), array('controller'=> 'ofertas', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Oferta', true), array('controller'=> 'ofertas', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Anios', true), array('controller'=> 'anios', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Anio', true), array('controller'=> 'anios', 'action'=>'add')); ?> </li>
	</ul>
</div>
