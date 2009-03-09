<div class="anios form">
<?php echo $form->create('Anio');?>
	<fieldset>
 		<legend><?php __('Edit Anio');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('plan_id');
		echo $form->input('ciclo_id');
		echo $form->input('anio');
		echo $form->input('etapa_id');
		echo $form->input('matricula');
		echo $form->input('secciones');
		echo $form->input('hs_taller');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Anio.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Anio.id'))); ?></li>
		<li><?php echo $html->link(__('List Anios', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List Planes', true), array('controller'=> 'planes', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Plan', true), array('controller'=> 'planes', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Ciclos', true), array('controller'=> 'ciclos', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Ciclo', true), array('controller'=> 'ciclos', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Etapas', true), array('controller'=> 'etapas', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Etapa', true), array('controller'=> 'etapas', 'action'=>'add')); ?> </li>
	</ul>
</div>
