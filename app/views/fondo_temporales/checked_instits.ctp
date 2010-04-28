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
Ver instits: <select name="checked" onchange="Javascript: location.href='/fondo_temporales/checked_instits/checked:'+this.value">
    <option value="1" <?=($checked=='1'?'selected':'')?>>Confirmados</option>
    <option value="2" <?=($checked=='2'?'selected':'')?>>En duda</option>
</select>
</p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
        <th><?php echo $paginator->sort('totales_checked');?></th>
        <th><?php echo $paginator->sort('instit_id');?></th>
	<th><?php echo $paginator->sort('Jurisdiccion','Jurisdiccion.name');?></th>
	<th><?php echo $paginator->sort('cuecompleto');?></th>
	<th><?php echo $paginator->sort('instit');?></th>
	<th><?php echo $paginator->sort('instit_name');?></th>
	<th><?php echo $paginator->sort('Instit.nombre');?></th>
        <th><?php echo $paginator->sort('localidad');?></th>
        <th><?php echo $paginator->sort('observacion');?></th>
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
			<?php echo $fondo['FondoTemporal']['totales_checked']; ?>
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
			<?php if ($checked == '1')
                                echo $fondo['Instit']['localidad'];
                            else
                                echo $fondo['FondoTemporal']['localidad'];
                        ?>
		</td>
                <td>
			<?php echo $fondo['FondoTemporal']['observacion']; ?>
		</td>

		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $fondo['FondoTemporal']['id'])); ?>
			<?
                        if ($checked == 1)
                            echo $html->link(__('Uncheck', true), array('action'=>'uncheck', $fondo['FondoTemporal']['id']), null, sprintf(__('Seguro deseas deschequear %s?', true), $fondo['FondoTemporal']['instit']));
                        else
                            echo $html->link(__('Check', true), array('action'=>'check', $fondo['FondoTemporal']['id']), null, sprintf(__('Seguro deseas marcar como chequeado %s?', true), $fondo['FondoTemporal']['instit']));
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