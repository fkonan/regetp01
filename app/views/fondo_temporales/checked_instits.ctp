<div class="fondos index">
<h2><?php __('Fondos temporales');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Página %page% de %pages%, mostrando %current% registros de %count%, de %start% hasta %end%', true)
));

$paginator->options(array('url' => $this->passedArgs));
?>
<br /><br />

Ver instits: <select name="checkedInstit" onchange="Javascript: location.href='<?php echo $html->url('/fondo_temporales/checked_instits/');?>checkedInstit:'+this.value;">
    <option value="" <?=($checkedInstit==null?'selected':'')?>>Seleccione</option>
    <option value="0" <?=($checkedInstit=='0'?'selected':'')?>>No Confirmados</option>
    <option value="1" <?=($checkedInstit=='1'?'selected':'')?>>Confirmados</option>
    <option value="2" <?=($checkedInstit=='2'?'selected':'')?>>En duda</option>
</select>
<br /><br />
Ver totales: <select name="checkedTotals" onchange="Javascript: location.href='<?php echo $html->url('/fondo_temporales/checked_instits/');?>checkedTotals:'+this.value;">
    <option value="" <?=(($checkedTotals==null)?'selected':'')?>>Seleccione</option>
    <option value="0" <?=($checkedTotals=='0'?'selected':'')?>>No Confirmados</option>
    <option value="1" <?=($checkedTotals=='1'?'selected':'')?>>Confirmados</option>
    <option value="2" <?=($checkedTotals=='2'?'selected':'')?>>Diferencias Pequeñas</option>
    <option value="3" <?=($checkedTotals=='3'?'selected':'')?>>Diferencias Grandes</option>
</select>
</p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
        <th><?php echo $paginator->sort('anio');?></th>
        <th><?php echo $paginator->sort('trimestre');?></th>
        <th><?php echo $paginator->sort('instit_id');?></th>
	<th><?php echo $paginator->sort('Jurisdiccion','Jurisdiccion.name');?></th>
	<th><?php echo $paginator->sort('cuecompleto');?></th>
	<th><?php echo $paginator->sort('instit');?></th>
	<th><?php echo $paginator->sort('instit_name');?></th>
	<th><?php echo $paginator->sort('Instit.nombre');?></th>
        <th><?php echo $paginator->sort('Instit.nroinstit');?></th>
        <th><?php echo $paginator->sort('localidad');?></th>
        <th><?php echo $paginator->sort('Diferencia de totales');?></th>
        <th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($fondos as $fondo):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $fondo['FondoTemporal']['id']; ?>
		</td>
                <td>
			<?php echo $fondo['FondoTemporal']['anio']; ?>
		</td>
                <td>
			<?php echo $fondo['FondoTemporal']['trimestre']; ?>
		</td>
		<td>
			<?php echo $fondo['FondoTemporal']['instit_id']; ?>
		</td>
		<td>
			<?php echo $fondo['Jurisdiccion']['name']; ?>
		</td>
		<td>
			<?php echo $fondo['FondoTemporal']['cuecompleto']; ?>
		</td>
                <td>
			<?php echo $fondo['FondoTemporal']['instit']; ?>
		</td>
                <td>
			<?php echo $fondo['FondoTemporal']['instit_name']; ?>
		</td>
                <td>
			<?php echo $fondo['Instit']['nombre']; ?>
		</td>
                <td>
			<?php echo $fondo['Instit']['nroinstit']; ?>
		</td>
                <td>
			<?php if ($checkedInstit == '0')
                                echo $fondo['FondoTemporal']['localidad'];
                            else
                                echo $fondo['Instit']['localidad'];
                        ?>
		</td>
                <td>
			<?php echo abs($fondo['FondoTemporal']['f01'] +
                             $fondo['FondoTemporal']['f02a'] +
                             $fondo['FondoTemporal']['f02b'] +
                             $fondo['FondoTemporal']['f02c'] +
                             $fondo['FondoTemporal']['f03a'] +
                             $fondo['FondoTemporal']['f03b'] +
                             $fondo['FondoTemporal']['f04'] +
                             $fondo['FondoTemporal']['f05'] +
                             $fondo['FondoTemporal']['f06a'] +
                             $fondo['FondoTemporal']['f06b'] +
                             $fondo['FondoTemporal']['f06c'] +
                             $fondo['FondoTemporal']['f07a'] +
                             $fondo['FondoTemporal']['f07b'] +
                             $fondo['FondoTemporal']['f07c'] +
                             $fondo['FondoTemporal']['f08'] +
                             $fondo['FondoTemporal']['f09'] +
                             $fondo['FondoTemporal']['f10'] +
                             $fondo['FondoTemporal']['f10'] +
                             $fondo['FondoTemporal']['equipinf'] +
                             $fondo['FondoTemporal']['refaccion'] -
                             $fondo['FondoTemporal']['total']); ?>
		</td>

		<td class="actions">
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $fondo['FondoTemporal']['id'])); ?>
			<?
                        if($checkedInstit != null){
                            if ($checkedInstit == 1)
                                echo $html->link(__('Uncheck Instit', true), array('action'=>'uncheckInstit', $fondo['FondoTemporal']['id']), null, sprintf(__('Seguro deseas deschequear %s?', true), $fondo['FondoTemporal']['instit']));
                            else
                                echo $html->link(__('Check Instit', true), array('action'=>'checkInstit', $fondo['FondoTemporal']['id']), null, sprintf(__('Seguro deseas marcar como chequeado %s?', true), $fondo['FondoTemporal']['instit']));
                        }
                        ?>
                        <?
                        if($checkedTotals != null){
                            if ($checkedTotals == 1)
                                echo $html->link(__('Uncheck Total', true), array('action'=>'uncheckTotals', $fondo['FondoTemporal']['id']), null, sprintf(__('Seguro deseas deschequear?', true)));
                            else
                                echo $html->link(__('Check Total', true), array('action'=>'checkTotals', $fondo['FondoTemporal']['id']), null, sprintf(__('Seguro deseas marcar como chequeado?', true)));
                        }
                        ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class'=>'disabled'));?>
</div>
<div class="actions">
        <ul>
                <li><?php echo $html->link(__('Ejecutar Validacion de CUEs', true), array('controller'=>'fondo_temporales','action'=>'validar_instits'));?></li>
	</ul>
	<ul>
                <li><?php echo $html->link(__('Ejecutar Validacion de Totales', true), array('controller'=>'fondo_temporales','action'=>'validar_totales'));?></li>
	</ul>
        <ul>
                <li><?php echo $html->link(__('Generar Reporte de Errores', true), array('controller'=>'fondo_temporales','action'=>'error_report'));?></li>
	</ul>
        <ul>
                <li><?php echo $html->link(__('Generar Reporte de Observaciones Finales', true), array('controller'=>'fondo_temporales','action'=>'observacion_report'));?></li>
	</ul>
</div>