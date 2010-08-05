<div class="trayectos view">
<h2><?php  __('Trayecto');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $trayecto['Trayecto']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $trayecto['Trayecto']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $trayecto['Trayecto']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $trayecto['Trayecto']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Trayecto', true), array('action'=>'edit', $trayecto['Trayecto']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Trayecto', true), array('action'=>'delete', $trayecto['Trayecto']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $trayecto['Trayecto']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Trayectos', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Trayecto', true), array('action'=>'add')); ?> </li>
	</ul>
</div>
