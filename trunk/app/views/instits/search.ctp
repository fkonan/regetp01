
<h1><?= __('Buscar Institución')?></h1>

<? 
$paginator->options(array('url' => $url_conditions));
?>

<? if (sizeof($conditions)>0): ?>
	<H2>Criterios de búsqueda seleccionados</H2>
	<dl class="criterios_busq">
	<?
	
	 foreach($conditions as $key => $value){
		?><dt><?
			echo '- '.$key.': ';
		?></dt><?
		?><dd><?
			echo $value;
		?></dd><?
	}
	
	?>
	</dl>
<? endif; ?>

<h2>Ordenar los resultados por:</h2>
<ul class="lista_horizontal">
<? 
	$sort = 'cue';
	if(isset($this->passedArgs['sort'])){ 
		$sort = $this->passedArgs['sort'];
	}
	?>
	<? $class = ($sort == 'cue')?'marcada':'';?>
	<li class="<?= $class?>"><?php echo $paginator->sort('cue');?></li>
	
	<? $class = ($sort == 'jurisdiccion_id')?'marcada':'';?>
	<li class="<?= $class?>"><?php echo $paginator->sort('Jurisdicción','jurisdiccion_id');?></li>	
	
	<? $class = ($sort == 'Departamento.name')?'marcada':'';?>
	<li class="<?= $class?>"><?php echo $paginator->sort('Departamento','Departamento.name');?></li>
	
	<? $class = ($sort == 'Localidad.name')?'marcada':'';?>
	<li class="<?= $class?>"><?php echo $paginator->sort('Localidad','Localidad.name');?></li>
		
</ul>

<? 

/**
 * 
 *   MOSTRAR SI HAY ALGUN RESULTADO
 * 
 * 	Si hay algun resultado voy a mostrar los resultados.
 * 		En el caso de obtener solo 1 resultado, voy directamente ala 
 * 		vista de institucion, eso se hace desde el controller.
 * 
 * 	Para el caso de no encontrar resultados se va amostrar un link 
 * 	que permita agregar instituciones
 * 	Instits/add
 * 
 */
if ($paginator->counter(array('format' =>'%count%')) > 0) {?>
	
	<h2>Resultados (<? echo $paginator->counter(array('format' => __('Mostrando %current% Instituciones de %count% encontradas', true)
	)); ?>)</h2>
	<ul class="listado">
	<?php  
	foreach($instits as $instit){
	?>
	
	<? 
		//esto es porque ramiro quiere tratar a las escuelas que pertenecen a un ciclo por iguak
		// por ahora el criterio es hasta Julio (fecha_hasta)
		// lo que quiere decir que los formularios recibidos hasta julio, entran
		// dentro del mismo ciclo
		// por ahora esto no tiene utilidad
		// pero la idea es que mediante CSS se agregu algun colorcito a las instits
		// que fueron actualizadas para el ciclo actual
		$año_actual = date("Y");
		$fecha_hasta = "$año_actual-07-21"; //hasta julio
		$fecha_desde = "$año_actual-01-01"; //desde enero 
		
		
		
		
		
		
		//inicializo la clase CSS de la institucion
		// esto sirve para procesar y ver visualmente ciertos estados de la institucion
		$clase = ''; 	
		if($instit['Instit']['fecha_mod'] < $fecha_hasta && $instit['Instit']['fecha_mod']< $fecha_desde ){
			$clase = 'alertar_escuela_no_actualizada';
		}
		if($instit['Instit']['activo']){
			$clase .= ' escuela_activa';
		}else{
			$clase .= ' escuela_inactiva';
		}
		 ?>
	
	<li id="lista_instit_<?= $instit['Instit']['id']?>" class="lista_link <?=$clase ?>" 
		onclick="window.location='<?= $html->url(array('controller'=> 'Instits', 'action'=>'view/'.$instit['Instit']['id'])) ?>'"
		onmouseover="$('lista_instit_<?= $instit['Instit']['id']?>').addClassName('lista_link_hover');"
		onmouseout="$('lista_instit_<?= $instit['Instit']['id']?>').removeClassName('lista_link_hover');"
		title="<?= $instit['Instit']['nombre_completo']?>"
		>
		
		<div class="instit_link_list">
			<a href="#MasInfo">+ Info</a>
		</div>	
		<div class="instit_data_bs">
			<? 
			//el anexo viene con 1 solo digito por lo general. Pero para leerlo siempre hay que ponerlo
			// en formato de 2 digitos
			$armar_anexo = ($instit['Instit']['anexo']<10)?'0'.$instit['Instit']['anexo']:$instit['Instit']['anexo']; 
			?>
			<div class="instit_name"><b><?= "".($instit['Instit']['cue']*100)+$instit['Instit']['anexo']." - ". $instit['Instit']['nombre_completo']; ?></b></div>
			<div class="instit_atributte"><b>Domicilio: </b> <?= $instit['Instit']['direccion'] ?></div>
			<br />		
			<div class="instit_atributte"><b>Gestión: </b><?= $instit['Gestion']['name'] ?></div>
			<div class="instit_atributte"><b>Jurisdicción: </b> <?= $instit['Jurisdiccion']['name'] ?></div>
			<br />
			<div class="instit_atributte"><b>Departamento: </b><?= $instit['Departamento']['name'] ?></div>
			<div class="instit_atributte"><b>Localidad: </b><?= $instit['Localidad']['name'] ?></div>
		</div>
	</li>
	
		<?
	
	}
	?>
	</ul>
	
	
	<div id="paginator_prev_next_links">
	<?php	
		echo $paginator->prev('« Anterior ',null, null, array('class' => 'disabled'));
		echo " <---> ".$paginator->counter()." <---> ";
		echo $paginator->next(' Siguiente »', null, null, array('class' => 'disabled'));
	?> 
	</div>
	
	<p>
	<h3></h3>
	<? echo $html->image('/css/images/puntoverde.gif',array('title'=>'Ingresados a la Base de Datos')); ?>
	- Institución ingresada al RFIETP<br />
	<? echo $html->image('/css/images/puntorojo.gif',array('title'=>'NO Ingresados a la Base de Datos')); ?>
	- Institución NO ingresada al RFIETP
	<? echo "</p>"?>
	
	<p  class="paginate_msg">
	<?php
	echo $paginator->counter(array(
	'format' => __('Página %page% de %pages%<br />Mostrando %current% registros de %count% encontrados, visualizando registros desde el nº %start%, hasta el %end%', true)
	));
	?>
	</p>
<?
}else{
	?>
	<!--	No hubo resutados, entonces muestro un link que permita agregar uinstituciones -->
	<h2>No Obtuvieron Resultados</h2>
	<? 
	echo $html->link('¿Desea agregar una Nueva Institución?',array('controller'=>'Instits', 'action'=>'add'));
}
?>