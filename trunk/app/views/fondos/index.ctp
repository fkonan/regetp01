<div class="fondos index">
<h2><?php __('Fondos');?></h2>

<div style="margin-bottom: 20px">
    <?php echo $form->create('Fondos',array('url'=>array('action'=>'index'))) ?>
        <div>
            <span>Año</span>
            <span style="padding-left:30px">Trimestre</span>
            <span style="padding-left:30px">Jurisdicción</span>
        </div>
        <span><?php echo $form->input('anio',array('label'=>false,'options'=>$anios, 'div'=>false)) ?></span>
        <span><?php echo $form->input('trimestre', array('label'=>false,'options'=>array(1,2,3,4), 'style'=>'width:100px','div'=>false)) ?></span>
        <span><?php echo $form->input('jurisdiccion_id',array('label'=>false,'div'=>false)) ?></span>
    <?php echo $form->end('Search',array('style'=>'float:right')); ?>
</div>

<?
if (count($fondos)) {
?>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('instit_id');?></th>
	<th><?php echo $paginator->sort('jurisdiccion_id');?></th>
	<th><?php echo $paginator->sort('anio');?></th>
	<th><?php echo $paginator->sort('trimestre');?></th>
	<th><?php echo $paginator->sort('memo');?></th>
	<th><?php echo $paginator->sort('total');?></th>
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
			<?php echo $fondo['Instit']['nombre']; ?>
		</td>
		<td>
			<?php echo $fondo['Jurisdiccion']['name']; ?>
		</td>

		<td>
			<?php echo $fondo['Fondo']['anio']; ?>
		</td>
		<td>
			<?php echo $fondo['Fondo']['trimestre']; ?>
		</td>
		<td>
			<?php echo $fondo['Fondo']['memo']; ?>
		</td>
		<td>
			<?php echo $fondo['Fondo']['total']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('ver', true), array('action' => 'index_x_instit', $fondo['Instit']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
    <?
    if ($paginator->numbers()) {
    ?>
    <div class="paging">
            <?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
     | 	<?php echo $paginator->numbers(array('url'=>array($url)));?>
            <?php echo $paginator->next(__('next', true).' >>', array(), null, array('class' => 'disabled'));?>
    </div>
<?
    }
}
?>
