<? //pr($paginator->options(array('url' => $this->passedArgs))); 
//pr($url_conditions);
$paginator->options(array('url' => $url_conditions));
?>

<H4>Los Criterios de búsqueda son los siguientes</H4>
<dl>
<?

 foreach($conditions as $key => $value){

	?><dd><?
		echo '- '.$key.': ';
	?></dd><?
	?><dt><?
		echo $value;
	?></dt><?
}

?>
</dl>

<h4>Ordenar los resultados por:</h4>
<ul class="lista_horizontal">
	<li><?php echo $paginator->sort('Gestión','gestion_id');?></li>
	<li><?php echo $paginator->sort('dependencia_id');?></li>
	<li><?php echo $paginator->sort('Tipo Instit.','tipoinstit_id');?></li>
	<li><?php echo $paginator->sort('jurisdiccion_id');?></li>
	<li><?php echo $paginator->sort('cue');?></li>
	<li><?php echo $paginator->sort('anexo');?></li>
	<li><?php echo $paginator->sort('esanexo');?></li>
	<li><?php echo $paginator->sort('nombre');?></li>
	<li><?php echo $paginator->sort('anio_creacion');?></li>
	<li><?php echo $paginator->sort('depto');?></li>
	<li><?php echo $paginator->sort('localidad');?></li>
	<li><?php echo $paginator->sort('actualizacion');?></li>
	<li><?php echo $paginator->sort('fecha_mod');?></li>
	<li><?php echo $paginator->sort('ciclo_alta');?></li>
	<li><?php echo $paginator->sort('ciclo_mod');?></li>
</ul>



<ul class="listado">

<?php  
//echo "11111<BR>";
//pr($instits);

foreach($instits as $instit){
?>

<? 
	$año_actual = date("Y");
	$fecha_hasta = "$año_actual-07-21"; //hasta julio
	$fecha_desde = "$año_actual-01-01"; //desde enero     
	//echo "alalalal------->>_>_>_->_>_-<->_-> $fecha_hasta y fecha mod:::".$instit['Instit']['fecha_mod'];
	
	if($instit['Instit']['fecha_mod'] < $fecha_hasta && $instit['Instit']['fecha_mod']< $fecha_desde ){
		$clase = 'class="alertar_escuela_no_actualizada"';
	}else  $clase = '';
	 ?>

<li <?=$clase ?>>
	<div class="instit_data_bs">
		<div class="instit_name"><?= $instit['Instit']['nombre'].' <cite>['.$instit['Instit']['cue'].']</cite>'; ?></div>
		<div class="instit_atributte"><b>Jurisdiccion:</b> <?= $instit['Jurisdiccion']['name'] ?></div>
		<div class="instit_atributte"><b>Gestion:</b><?= $instit['Gestion']['name'] ?></div>
	</div>
	<div class="instit_link_list">
		<?=$html->link('Ver Datos escuela',array('controller'=> 'Instits', 'action'=>'view/'.$instit['Instit']['id'])) ?>
	</div>
</li>

	<?

}
?>
</ul>

<p id="paginator_prev_next_links">
<?php

	
	echo $paginator->prev('« Anterior ',null, null, array('class' => 'disabled'));
	echo " <---> ".$paginator->counter()." <---> ";
	echo $paginator->next(' Siguiente »', null, null, array('class' => 'disabled'));
?> 
</p>

<p  class="paginate_msg">
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?>
</p>
