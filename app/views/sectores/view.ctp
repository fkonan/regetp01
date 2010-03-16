<div class="orientaciones view">
<h2><?php  __('Orientacion');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $orientacion['Orientacion']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $orientacion['Orientacion']['name']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Orientacion', true), array('action'=>'edit', $orientacion['Orientacion']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Orientacion', true), array('action'=>'delete', $orientacion['Orientacion']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $orientacion['Orientacion']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Orientacion', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Orientacion', true), array('action'=>'add')); ?> </li>
	</ul>
</div>
