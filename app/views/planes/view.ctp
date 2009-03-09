<div class="planes view">
<h2><?php  __('Plan');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $plan['Plan']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Instit'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($plan['Instit']['id'], array('controller'=> 'instits', 'action'=>'view', $plan['Instit']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Oferta'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($plan['Oferta']['name'], array('controller'=> 'ofertas', 'action'=>'view', $plan['Oferta']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Old Item'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $plan['Plan']['old_item']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Norma'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $plan['Plan']['norma']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nombre'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $plan['Plan']['nombre']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Perfil'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $plan['Plan']['perfil']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Sector'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $plan['Plan']['sector']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Duracion Hs'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $plan['Plan']['duracion_hs']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Duracion Semanas'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $plan['Plan']['duracion_semanas']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Duracion Anios'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $plan['Plan']['duracion_anios']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Matricula'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $plan['Plan']['matricula']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Observacion'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $plan['Plan']['observacion']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Ciclo Alta'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $plan['Plan']['ciclo_alta']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Ciclo Mod'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $plan['Plan']['ciclo_mod']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $plan['Plan']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $plan['Plan']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Plan', true), array('action'=>'edit', $plan['Plan']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Plan', true), array('action'=>'delete', $plan['Plan']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $plan['Plan']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Planes', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Plan', true), array('action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Instits', true), array('controller'=> 'instits', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Instit', true), array('controller'=> 'instits', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Ofertas', true), array('controller'=> 'ofertas', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Oferta', true), array('controller'=> 'ofertas', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Anios', true), array('controller'=> 'anios', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Anio', true), array('controller'=> 'anios', 'action'=>'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Anios');?></h3>
	<?php if (!empty($plan['Anio'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Plan Id'); ?></th>
		<th><?php __('Ciclo Id'); ?></th>
		<th><?php __('Old Item'); ?></th>
		<th><?php __('Anio'); ?></th>
		<th><?php __('Etapa Id'); ?></th>
		<th><?php __('Matricula'); ?></th>
		<th><?php __('Secciones'); ?></th>
		<th><?php __('Hs Taller'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($plan['Anio'] as $anio):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $anio['id'];?></td>
			<td><?php echo $anio['plan_id'];?></td>
			<td><?php echo $anio['ciclo_id'];?></td>
			<td><?php echo $anio['old_item'];?></td>
			<td><?php echo $anio['anio'];?></td>
			<td><?php echo $anio['etapa_id'];?></td>
			<td><?php echo $anio['matricula'];?></td>
			<td><?php echo $anio['secciones'];?></td>
			<td><?php echo $anio['hs_taller'];?></td>
			<td><?php echo $anio['created'];?></td>
			<td><?php echo $anio['modified'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller'=> 'anios', 'action'=>'view', $anio['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller'=> 'anios', 'action'=>'edit', $anio['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller'=> 'anios', 'action'=>'delete', $anio['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $anio['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('New Anio', true), array('controller'=> 'anios', 'action'=>'add'));?> </li>
		</ul>
	</div>
</div>
