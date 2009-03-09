<div class="anios view">
<h2><?php  __('Anio');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $anio['Anio']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Plan'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($anio['Plan']['id'], array('controller'=> 'planes', 'action'=>'view', $anio['Plan']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Ciclo'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($anio['Ciclo']['name'], array('controller'=> 'ciclos', 'action'=>'view', $anio['Ciclo']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Old Item'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $anio['Anio']['old_item']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Anio'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $anio['Anio']['anio']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Etapa'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($anio['Etapa']['name'], array('controller'=> 'etapas', 'action'=>'view', $anio['Etapa']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Matricula'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $anio['Anio']['matricula']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Secciones'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $anio['Anio']['secciones']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Hs Taller'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $anio['Anio']['hs_taller']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $anio['Anio']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $anio['Anio']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Anio', true), array('action'=>'edit', $anio['Anio']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Anio', true), array('action'=>'delete', $anio['Anio']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $anio['Anio']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Anios', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Anio', true), array('action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Planes', true), array('controller'=> 'planes', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Plan', true), array('controller'=> 'planes', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Ciclos', true), array('controller'=> 'ciclos', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Ciclo', true), array('controller'=> 'ciclos', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Etapas', true), array('controller'=> 'etapas', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Etapa', true), array('controller'=> 'etapas', 'action'=>'add')); ?> </li>
	</ul>
</div>
