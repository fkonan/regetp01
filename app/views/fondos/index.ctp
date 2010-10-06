<div class="fondos index">
<h2><?php __('Fondos');?></h2>
<?php
$trimestres=array(''=>'Todos','1'=>'1º','2'=>'2º','3'=>'3º','4'=>'4º');
?>

<div style="margin-bottom: 20px">
    <?php
    echo $form->create('Fondo',array('url'=>array('action'=>'index')));

    echo $form->input('tipo',array(
        'label'=>'Tipo',
        'div'=> array('style'=>'float:left; clear: none'),
        'options'=>array('i'=>'Institucional','j'=>'Jurisdiccional'),
        'empty'=>'Seleccione'
        )
            );

    echo $form->input('jurisdiccion_id',array(
        'label'=>'Jurisdicción',
        'div'=> array('style'=>'float:left; clear: none'),
    ));

    echo $form->input('anio',array(
        'label'=>'Año',
        'div'=> array('style'=>'float:left; clear: none'),
        'options'=>$anios));
    
    echo $form->input('trimestre', array(
        'label'=>'Trimestre',
        'div'=> array('style'=>'float:left; clear: none'),
        'options'=>$trimestres, 'style'=>'width:100px'
        ));
    
    echo $form->end('Buscar',array('style'=>'float:right'));
    ?>
</div>
<p>
<?php
echo $paginator->counter(array(
'format' => __('<b>%count%</b> fondos encontrados, los cuales suman <b>$'.$total.'</b>.<br>Página %page% de %pages%, mostrando %current% fondos. ', true)
));
?></p>

<?
if (count($fondos)) {
?>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('Institución','instit_id');?></th>
	<th><?php echo $paginator->sort('jurisdiccion_id');?></th>
	<th><?php echo $paginator->sort('Año', 'anio');?></th>
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
			<?php
                        if (!empty($fondo['Instit']['nombre'])) {
                            echo $fondo['Instit']['nombre'];
                        } else {
                        ?>
                            <i>Jurisdiccional</i>
                        <?php }?>
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
                        $<?=number_format($fondo['Fondo']['total'],2,",",".");?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('Editar', true), array('action' => 'add', $fondo['Fondo']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
    <?
    $paginator->options(array('url' => $this->passedArgs));

    if ($paginator->numbers()) {
    ?>
    <div class="paging">
            <?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
     | 	<?php echo $paginator->numbers();?>
            <?php echo $paginator->next(__('next', true).' >>', array(), null, array('class' => 'disabled'));?>
    </div>
<?
    }
}
?>
