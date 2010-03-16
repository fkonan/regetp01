<div class="titulos view">
<h2><?php  __('Titulo');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $titulo['Titulo']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nombre'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $titulo['Titulo']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Marco referencial'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo ($titulo['Titulo']['marcoref']==1)? "Con marco referencial":"Sin marco referencial"; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Oferta'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $titulo['Oferta']['name']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Titulo', true), array('action'=>'edit', $titulo['Titulo']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Titulo', true), array('action'=>'delete', $titulo['Titulo']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $titulo['Titulo']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Titulos', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Titulo', true), array('action'=>'add')); ?> </li>
	</ul>
</div>
