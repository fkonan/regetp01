<div class="sugerencias view">
<h2><?php  __('Sugerencia');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $sugerencia['Sugerencia']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Asunto'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $sugerencia['Sugerencia']['asunto']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Mensaje'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $sugerencia['Sugerencia']['mensaje']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Remitente'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $sugerencia['Sugerencia']['user_id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('IP'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $sugerencia['Sugerencia']['IP']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $sugerencia['Sugerencia']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Leido'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $sugerencia['Sugerencia']['leido']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Sugerencia', true), array('action' => 'edit', $sugerencia['Sugerencia']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Sugerencia', true), array('action' => 'delete', $sugerencia['Sugerencia']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $sugerencia['Sugerencia']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Sugerencias', true), array('action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Sugerencia', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
