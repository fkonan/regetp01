<h1><?php  __('Oferta Educativa');?></h1>

<h2><?= $instit['cue'].' - '.$instit['nombre'] ?></h2>
<div class="planes view">
	<dl><?php $i = 0; $class = ' class="altrow"';?>

		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Oferta'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?= $plan['Oferta']['name']; ?>
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
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Duración Hs'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $plan['Plan']['duracion_hs']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Duración Semanas'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $plan['Plan']['duracion_semanas']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Duración Años'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $plan['Plan']['duracion_anios']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Matrícula'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $matricula[$plan['Plan']['id']] ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Observación'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $plan['Plan']['observacion']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Alta'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<? echo $plan['Plan']['ciclo_alta']?$plan['Plan']['ciclo_alta']:''; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modificación'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<? echo $plan['Plan']['ciclo_mod']?$plan['Plan']['ciclo_mod']:''; ?>
			&nbsp;
		</dd>

	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Editar Oferta', true), array('action'=>'edit', $plan['Plan']['id'])); ?> </li>
		<li><?php echo $html->link(__('¿Eliminar Oferta?', true), array('controller'=> 'planes', 'action'=>'delete', $plan['Plan']['id']), null, sprintf(__('Seguro que desea eliminar el Plan "%s"?', true), $plan['Plan']['nombre'])); ?></li>
	</ul>
</div>
<div class="related">
	<table>
		<tr>
			<th><?php __('Ciclo'); ?></th>
			<th><?php __('Matrícula'); ?></th>
			<th><?php __('Secciones'); ?></th>
			<th><?php __('Hs Taller'); ?></th>
			<th class="actions"><?php __('');?></th>
		</tr>
	<?php if (!empty($anios)):
	//reccorro por cada ciclo
		while (list($key,$ciclo) = each($anios)){
		$i = 0;
		
			foreach ($ciclo as $anio):
				$class = null;
				if ($i++ % 2 == 0) {
					$class = ' class="altrow"';
				}
			?>		
		
			<tr id="fila_plan_<?= $anio['ciclo_id'].'_'.$anio['anio']?>" <?php echo $class;?>>
				<th><?php echo $key //muestra el año, el ciclo ?></th>
				<td><?php echo $anio['matricula'];?></td>
				<td><?php echo $anio['secciones'];?></td>
				<td><?php echo $anio['hs_taller'];?></td>
				<td class="actions">
					<a href="<?= $html->url(array('controller'=> 'anios', 'action'=>'edit/'.$anio['id']))?>" onClick="window.open('<?= $html->url(array('controller'=> 'anios', 'action'=>'edit/'.$anio['id']))?>','_blank' , 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=310,height=380'); return false;">Editar</a>
					<?php echo $html->link(__('Borrar', true), array('controller'=> 'anios', 'action'=>'delete', $anio['id']), null, sprintf(__('Seguro que desea eliminar el año # %s? del ciclo # %s', true), $anio['anio'], $anio['ciclo_id'])); ?>
				</td>
			</tr>
			<?php endforeach; //el que recorre los anios del ciclo	?>
		
		<?php }// fin del WHILE...el que recorre los ciclos, los años?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<?php //echo $html->link(__('Agregar Nuevo Año', true), array('controller'=> 'anios', 'action'=>'add/'.$plan['Plan']['id']));?>
			<li><a href="<?= $html->url(array('controller'=> 'anios', 'action'=>'add/'.$plan['Plan']['id']))?>" onClick="window.open('<?= $html->url(array('controller'=> 'anios', 'action'=>'add/'.$plan['Plan']['id']))?>','_blank' , 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=310,height=380'); return false;">Agregar Nuevo Año</a></li>
		</ul>
	</div>
</div>
