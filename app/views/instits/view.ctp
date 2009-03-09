<div class="instits view">
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Editar Institución', true), array('action'=>'edit', $instit['Instit']['id'])); ?> </li>
		<li><?php echo $html->link(__('Eliminar Institución', true), array('action'=>'delete', $instit['Instit']['id']), null, sprintf(__('Si acepta eliminaria los datos de la institución definitivamente.\n ¿Esta seguro que desea borrar la intitución CUE # %s ?', true), $instit['Instit']['cue'].'-0'.$instit['Instit']['anexo'])); ?> </li>
	</ul>
</div>
<h2>|:::| <?php echo $instit['Instit']['nombre']; ?>&nbsp;&nbsp;<cite>[<?php echo $instit['Instit']['cue'].'-0'.$instit['Instit']['anexo']; ?>]</cite>&nbsp;&nbsp;<b  class="<? echo $instit['Instit']['activo']? '':'instit_inactiva';?>"><? echo $instit['Instit']['activo']? 'Activa':'Inactiva';?></b></h2>
	<dl>
		
		<dt><?php __('Tipoinstit'); ?></dt>
		<dd>
			<?php echo $html->link($instit['Tipoinstit']['name'], array('controller'=> 'tipoinstits', 'action'=>'view', $instit['Tipoinstit']['id'])); ?>
			&nbsp;
		</dd>
		
		<dt ><?php __('Gestion'); ?></dt>
		<dd>
			<?php echo $html->link($instit['Gestion']['name'], array('controller'=> 'gestiones', 'action'=>'view', $instit['Gestion']['id'])); ?>
			&nbsp;
		</dd>
		
		<dt><?php __('Dependencia'); ?></dt>
		<dd>
			<?php echo $html->link($instit['Dependencia']['name'], array('controller'=> 'dependencias', 'action'=>'view', $instit['Dependencia']['id'])); ?>
			&nbsp;
		</dd>
		
		<dt><?php __('Jurisdiccion'); ?></dt>
		<dd>
			<?php echo $html->link($instit['Jurisdiccion']['name'], array('controller'=> 'jurisdicciones', 'action'=>'view', $instit['Jurisdiccion']['id'])); ?>
			&nbsp;
		</dd>
		
		
		
		<dt><?php __('Nroinstit'); ?></dt>
		<dd>
			<?php echo $instit['Instit']['nroinstit']; ?>
			&nbsp;
		</dd>
		<dt><?php __('Anio Creacion'); ?></dt>
		<dd>
			<?php echo $instit['Instit']['anio_creacion']; ?>
			&nbsp;
		</dd>
	</dl>
		
		<h3>Datos Establecimiento</h3>
	<dl>
		<dt><?php __('Direccion'); ?></dt>
		<dd>
			<?php echo $instit['Instit']['direccion']; ?>
			&nbsp;
		</dd>
		<dt><?php __('Depto'); ?></dt>
		<dd>
			<?php echo $instit['Instit']['depto']; ?>
			&nbsp;
		</dd>
		<dt><?php __('Localidad'); ?></dt>
		<dd>
			<?php echo $instit['Instit']['localidad']; ?>
			&nbsp;
		</dd>
		<dt><?php __('Cp'); ?></dt>
		<dd>
			<?php echo $instit['Instit']['cp']; ?>
			&nbsp;
		</dd>
		<dt><?php __('Telefono'); ?></dt>
		<dd>
			<?php echo $instit['Instit']['telefono']; ?>
			&nbsp;
		</dd>
		<dt><?php __('Mail'); ?></dt>
		<dd>
			<?php echo $instit['Instit']['mail']; ?>
			&nbsp;
		</dd>
		<dt><?php __('Web'); ?></dt>
		<dd>
			<?php echo $instit['Instit']['web']; ?>
			&nbsp;
		</dd>
	</dl>
		
	<H3>Datos Director</H3>
	<dl>		
		<dt><?php __('Dir Nombre'); ?></dt>
		<dd>
			<?php echo $instit['Instit']['dir_nombre']; ?>
			&nbsp;
		</dd>
		<dt><?php __('Dir Tipodoc Id'); ?></dt>
		<dd>
			<?php echo $instit['Instit']['dir_tipodoc_id']; ?>
			&nbsp;
		</dd>
		<dt><?php __('Dir Nrodoc'); ?></dt>
		<dd>
			<?php echo $instit['Instit']['dir_nrodoc']; ?>
			&nbsp;
		</dd>
		<dt><?php __('Dir Telefono'); ?></dt>
		<dd>
			<?php echo $instit['Instit']['dir_telefono']; ?>
			&nbsp;
		</dd>
		<dt><?php __('Dir Mail'); ?></dt>
		<dd>
			<?php echo $instit['Instit']['dir_mail']; ?>
			&nbsp;
		</dd>
	</dl>
	
	<H3>Datos Vice Director</H3>
	<dl>
		<dt><?php __('Vice Nombre'); ?></dt>
		<dd>
			<?php echo $instit['Instit']['vice_nombre']; ?>
			&nbsp;
		</dd>
		<dt><?php __('Vice Tipodoc Id'); ?></dt>
		<dd>
			<?php echo $instit['Instit']['vice_tipodoc_id']; ?>
			&nbsp;
		</dd>
		<dt><?php __('Vice Nrodoc'); ?></dt>
		<dd>
			<?php echo $instit['Instit']['vice_nrodoc']; ?>
			&nbsp;
		</dd>
	</dl>
	
	<H3>Datos Extra</H3>
	<dl>
		<dt><?php __('Actualizacion'); ?></dt>
		<dd>
			<?php echo $instit['Instit']['actualizacion']; ?>
			&nbsp;
		</dd>
		<dt><?php __('Observacion'); ?></dt>
		<dd>
			<?php echo $instit['Instit']['observacion']; ?>
			&nbsp;
		</dd>
		<dt><?php __('Fecha Mod'); ?></dt>
		<dd>
			<?php echo $instit['Instit']['fecha_mod']; ?>
			&nbsp;
		</dd>
		

		<dt><?php __('Ciclo Alta'); ?></dt>
		<dd>
			<?php echo $instit['Instit']['ciclo_alta']; ?>
			&nbsp;
		</dd>
		<dt><?php __('Ciclo Mod'); ?></dt>
		<dd>
			<?php echo $instit['Instit']['ciclo_mod']; ?>
			&nbsp;
		</dd>
		<dt><?php __('Created'); ?></dt>
		<dd>
			<?php echo $instit['Instit']['created']; ?>
			&nbsp;
		</dd>
		<dt><?php __('Modified'); ?></dt>
		<dd>
			<?php echo $instit['Instit']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>

<div class="related">
	<h3><?php __('Related Planes');?></h3>
	<?php if (!empty($instit['Plan'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Instit Id'); ?></th>
		<th><?php __('Oferta Id'); ?></th>
		<th><?php __('Old Item'); ?></th>
		<th><?php __('Norma'); ?></th>
		<th><?php __('Nombre'); ?></th>
		<th><?php __('Perfil'); ?></th>
		<th><?php __('Sector'); ?></th>
		<th><?php __('Duracion Hs'); ?></th>
		<th><?php __('Duracion Semanas'); ?></th>
		<th><?php __('Duracion Anios'); ?></th>
		<th><?php __('Matricula'); ?></th>
		<th><?php __('Observacion'); ?></th>
		<th><?php __('Ciclo Alta'); ?></th>
		<th><?php __('Ciclo Mod'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($instit['Plan'] as $plan):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $plan['id'];?></td>
			<td><?php echo $plan['instit_id'];?></td>
			<td><?php echo $plan['oferta_id'];?></td>
			<td><?php echo $plan['old_item'];?></td>
			<td><?php echo $plan['norma'];?></td>
			<td><?php echo $plan['nombre'];?></td>
			<td><?php echo $plan['perfil'];?></td>
			<td><?php echo $plan['sector'];?></td>
			<td><?php echo $plan['duracion_hs'];?></td>
			<td><?php echo $plan['duracion_semanas'];?></td>
			<td><?php echo $plan['duracion_anios'];?></td>
			<td><?php echo $plan['matricula'];?></td>
			<td><?php echo $plan['observacion'];?></td>
			<td><?php echo $plan['ciclo_alta'];?></td>
			<td><?php echo $plan['ciclo_mod'];?></td>
			<td><?php echo $plan['created'];?></td>
			<td><?php echo $plan['modified'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller'=> 'planes', 'action'=>'view', $plan['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller'=> 'planes', 'action'=>'edit', $plan['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller'=> 'planes', 'action'=>'delete', $plan['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $plan['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('New Plan', true), array('controller'=> 'planes', 'action'=>'add'));?> </li>
		</ul>
	</div>
</div>
