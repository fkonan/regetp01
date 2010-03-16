<<<<<<< .mine
<div class="titulos view">
<h2><?php  __('Titulo');?></h2>
=======
<div class="orientaciones view">
<h2><?php  __('Orientacion');?></h2>
>>>>>>> .r290
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
<<<<<<< .mine
			<?php echo $titulo['Titulo']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nombre'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $titulo['Titulo']['name']; ?>
=======
			<?php echo $orientacion['Orientacion']['id']; ?>
>>>>>>> .r290
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Marco de referencia'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
<<<<<<< .mine
			<?php echo ($titulo['Titulo']['marcoref']==1)?"Con marco de referencia":"Sin marco de referencia"; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Oferta'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $titulo['Oferta']['name']; ?>
=======
			<?php echo $orientacion['Orientacion']['name']; ?>
>>>>>>> .r290
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
<<<<<<< .mine
		<li><?php echo $html->link(__('Edit Titulo', true), array('action'=>'edit', $titulo['Titulo']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Titulo', true), array('action'=>'delete', $titulo['Titulo']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $titulo['Titulo']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Titulos', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Titulo', true), array('action'=>'add')); ?> </li>
=======
		<li><?php echo $html->link(__('Edit Orientacion', true), array('action'=>'edit', $orientacion['Orientacion']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Orientacion', true), array('action'=>'delete', $orientacion['Orientacion']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $orientacion['Orientacion']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Orientacion', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Orientacion', true), array('action'=>'add')); ?> </li>
>>>>>>> .r290
	</ul>
</div>
