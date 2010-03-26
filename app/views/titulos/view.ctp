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
			<?php echo ($titulo['Titulo']['marco_ref']==1)? "Con marco referencial":"Sin marco referencial"; ?>
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
		<li><?php echo $html->link(__('Editar', true), array('action'=>'edit', $titulo['Titulo']['id'])); ?> </li>
		<li><?php echo $html->link(__('Borrar', true), array('action'=>'delete', $titulo['Titulo']['id']), null, sprintf(__('Borrar %s?', true), $titulo['Titulo']['name'])); ?> </li>
		<li><?php echo $html->link(__('Listar Títulos', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('Nuevo Título', true), array('action'=>'add')); ?> </li>
	</ul>
</div>
