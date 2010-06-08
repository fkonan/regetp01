<div class="related">
	<?php if (!empty($anios)){
	//reccorro por cada ciclo
		while (list($key,$ciclo) = each($anios)){
		$i = 0;
		?>			
			<h2><?php echo "Ciclo $key" ?></h2>
			<table cellpadding = "0" cellspacing = "0">
			<tr>
				<th><?php __('Año'); ?></th>
				<th><?php __('Etapa'); ?></th>
				<th><?php __('Matrícula'); ?></th>
				<th><?php __('Secciones'); ?></th>
				<th><?php __('Horas Taller'); ?></th>
				<th class="actions"><?php __('');?></th>
			</tr>
		<?php	
			$tot_matricula = 0;
			$tot_secciones = 0;
			foreach ($ciclo as $anio):
				$class = null;
				if ($i++ % 2 == 0) {
					$class = ' class="altrow"';
				}
			?>		
		
			<tr id="fila_plan_<?= $anio['ciclo_id'].'_'.$anio['anio']?>" <?php echo $class;?>>
				
				<td><?php echo $anio['anio']."º";?></td>
				<td><?php echo $this->requestAction('/Etapas/dame_nombre/'.$anio['etapa_id']);?></td>
				<td><?php echo $anio['matricula'];$tot_matricula += $anio['matricula']; ?></td>
				<td><?php echo $anio['secciones'];$tot_secciones += $anio['secciones'];?></td>
				<td><?php echo $anio['hs_taller'];?></td>
				<td class="actions">
					<a href="<?= $html->url(array('controller'=> 'anios', 'action'=>'edit/'.$anio['id']))?>" onClick="window.open('<?= $html->url(array('controller'=> 'anios', 'action'=>'edit/'.$anio['id']))?>','_blank' , 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=310,height=500'); return false;">Editar</a>
					<?php echo $html->link(__('Borrar', true), array('controller'=> 'anios', 'action'=>'delete', $anio['id']), null, sprintf(__('Seguro que desea eliminar el año # %s? del ciclo # %s', true), $anio['anio'], $anio['ciclo_id'])); ?>
				</td>
			</tr>
			<?php endforeach; //el que recorre los anios del ciclo	?>
			<tr <?php echo $class;?> >				
				<td style="border-top: 1px silver solid;"><?php echo '';?></td>
				<td style="border-top: 1px silver solid;"><?php echo '<b>Totales</b>';?></td>
				<td style="border-top: 1px silver solid;"><b><?php echo $tot_matricula;?></b></td>
				<td style="border-top: 1px silver solid;"><b><?php echo $tot_secciones;?></b></td>
				<td style="border-top: 1px silver solid;"><?php echo '';?></td>
				<td class="actions" style="border-top: 1px silver solid;"><?php echo '';?></td>
			</tr>
		</table>
		<?php }// fin del WHILE...el que recorre los ciclos, los años?>
	
<?php }else{?>
	<h2>No Hay Ciclos</h2>
	<?
} ?>
	</div>