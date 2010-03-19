<? 
$paginator->options(array('url' => $url_conditions));

?>

<h1> ¡¡ vamos que faltan solo <?php echo $paginator->counter(array(
			'format' => '%count%'));?>!!</h1>




<!--
				BUSQUEDA POR SU OFERTA
		-->

<div id="search-planes"><?php echo $form->create('Form',array('url'=>'/depuradores/depurar_titulos','id'=>'Form'));?>
<?php

echo $form->input('FPlan.limit',array(
						        'label'=>'Cantidad por hoja',
						        'options'=>array('10'=>10,'15'=>15,'20'=>20,'25'=>25)
       			 ));

echo $form->input('FPlan.oferta_id',array('options'=>$ofertas,
				        'empty'=>'Seleccione',
				        'label'=>'Con Oferta'));

$type = 'hidden';
// esto solo lo ven los editores y los administradores
if($session->read('Auth.User.role') == 'editor' || $session->read('Auth.User.role') == 'admin' || $session->read('Auth.User.role') == 'desarrollo') {
	$type = 'text'; //lo muestra como un imputo comun
}

echo $form->input('FPlan.sector_id',array(
        'label'=>'Sector',
        'options'=>$sectores,
        'empty'=>'Seleccione'
        ));

        if($session->read('Auth.User.role') == 'editor'||
        $session->read('Auth.User.role') == 'admin' ||
        $session->read('Auth.User.role') == 'desarrollo') {

        	echo $form->input('FPlan.subsector_id',
        	array(
						                'label'=>'Subsector',
						                'empty'=>'Seleccione',
        	));

        	echo $ajax->observeField('FPlanSectorId',
        	array(  'url' => '/subsectores/ajax_select_subsector_form_por_sector',
				            'update'=>'FPlanSubsectorId',
				            'loading'=>'$("FPlanSubsectorId").disable();',
				            'complete'=>'$("FPlanSubsectorId").enable();',
				            'onChange'=>true
        	));

        }
        
        // 		JURISDICCION
	    $meter = '<span class="ajax_update" id="ajax_indicator" style="display:none;">'.$html->image('ajax-loader.gif').'</span>';
	    echo $form->input('FPlan.jurisdiccion_id', array(	
	    											'empty' => array('0'=>'Todas'),
	    											'id'=>'jurisdiccion_id',
	    											'label'=>'Jurisdicción',
	    											'after'=>$meter,
	    											'options'=>$jurisdicciones,
	    
	    ));

      ?> 
      <?php echo $form->end('Buscar', array('style'=>' display: block;
													        width: 100px;
													        vertical-align: bottom;
													        margin-top: 7px;
													        margin-left: 4px;
													        border-color: #CEE3F6;
													        background-color: #DBEBF6;
													        color: #045FB4;
													        font-weight: bold;'
													        )
		        );
		?>
		
		
 </div>	


















<hr>




<script type="text/javascript">
<!--

	function checkAll(){
		checkboxes = $('formPlanes').getInputs('checkbox');
		checkboxes.each(function(e){ e.checked = 1 });
	}


	function unCheckAll(){
		checkboxes = $('formPlanes').getInputs('checkbox');
		checkboxes.each(function(e){ e.checked = 0 });
	}
	
	
	function activarCambios(){
		alert("Hola");
		$('formPlanes');
	}


	function cambiarTitulos(e){
		e.select($F('titulo_general'));
		
	}

	Event.observe(window, 'load', function(){
			$('titulo_general').observe('change', function(){
					$$('.titulo').each(function(e){
						e.value = $F('titulo_general');
					});
				});
		});
-->
</script>



<?php 
echo $form->create('Plan', array(
			'url'=>'/depuradores/depurar_titulos', 
			//'onsubmit'=>'activarCambios(); return false;',
			'id'=>'formPlanes'
));


echo $form->button('Seleccionar Todos', array('onclick'=>'checkAll()', 'style'=>'clear:none;float:left;width:144px;'));
echo $form->button('Deseleccionar Todos', array('onclick'=>'unCheckAll()', 'style'=>'clear:none;float:left;width:144px;'));

$i = 0;
foreach ($planes as $p) {
	
	$div_id = "plan-id-".$p['Plan']['id']; 
	?>
	
	
	<div style="font-size: 12px;">
		<?php echo $form->input("Plan.$i.id",array('value' =>$p['Plan']['id']));?>
		<?php echo $form->checkbox("Plan.$i.selected");?>
		<?php echo $form->input("Plan.$i.titulo_id", array('class'=>'titulo dep_titulo', 'div'=>false, 'label'=>false, 'style'=>'clear: none;'));?>
		<a style="font-size: 10px;" href="javascript:" onclick="$('<? echo $div_id?>').toggle(); return false;"><?= $p['Plan']['nombre']?></a>		
	</div>
	<div style="display: none; background-color: beige;" id="<? echo $div_id?>">
		
		<?php echo $html->link('ir al plan','/Planes/view/'.$p['Plan']['id'],array('style'=> 'float: right;'))?>
		<dl>
			<?php $nombre = (empty($p['Instit']['nombre']))? 'SIN NOMBRE':$p['Instit']['nombre'];?>
			<dt>Institución:</dt>			<dd><?php echo $html->link($nombre,'/instits/view/'.$p['Instit']['id']);?>&nbsp;</dd>
			<dt>Oferta:</dt>				<dd><?php echo $p['Oferta']['name']?>&nbsp;</dd>
			<dt>Sector:</dt>				<dd><?php echo $p['Sector']['name']?>&nbsp;</dd>
			<dt>Subsector:</dt>				<dd><?php echo $p['Subsector']['name']?>&nbsp;</dd>
			<dt>Duracion:</dt>				<dd><?php echo " - ";?>&nbsp;</dd>
			<dt>&nbsp;&nbsp;-- Horas:</dt>	<dd><?php echo $p['Plan']['duracion_hs'];?>&nbsp;</dd>
			<dt>&nbsp;&nbsp;-- Semanas:</dt><dd><?php echo $p['Plan']['duracion_semanas'];?>&nbsp;</dd>
			<dt>&nbsp;&nbsp;-- Años:</dt>	<dd><?php echo $p['Plan']['duracion_anios'];?>&nbsp;</dd>
			<dt>matricula:</dt>				<dd><?php echo $p['Plan']['matricula']?>&nbsp;</dd>
			<dt>Observación:</dt>			<dd><?php echo $p['Plan']['observacion']?>&nbsp;</dd>
			<dt>Alta:</dt>					<dd><?php echo date('d/m/Y',strtotime($p['Plan']['created']))?>&nbsp;</dd>
			<dt>Modificación:</dt>			<dd><?php echo date('d/m/Y',strtotime($p['Plan']['modified']))?>&nbsp;</dd>
			
			<?php
				foreach ($p['Anio'] as $anio):
					$ciclos[$anio['ciclo_id']] = $anio['ciclo_id'];
				endforeach;
				
				$texto = '';
				foreach ($ciclos as $c):
					$texto .= " - ".$c;
				endforeach;
			?>
			<dt>Ciclos con información</dt><dd><?php echo $texto?>&nbsp;</dd>
			
		</dl> 
	</div>

<?php 
	$i++;
}

echo $form->input('Plan.titulo_id', array('label'=>'Asignar título en masa','id'=>'titulo_general', 'default'=>'Seleccione'));

echo $form->button('Seleccionar Todos', array('onclick'=>'checkAll()', 'style'=>'clear:none;float:left;width:144px;'));
echo $form->button('Deseleccionar Todos', array('onclick'=>'unCheckAll()', 'style'=>'clear:none;float:left;width:144px;'));


echo $form->end('Guardar Cambios'); 

?>

<div>
<?php 
echo $paginator->prev('<< '.__('Anterior', true), array(), null, array('class'=>'disabled'));
//echo $paginator->numbers();
echo $paginator->next(__('Siguiente', true).' >>', array('style'=>'float:right;'), null, array('class'=>'disabled'));
?>
</div>







