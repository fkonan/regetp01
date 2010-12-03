<?php
echo $javascript->link(array(
            'jquery.autocomplete',
            'jquery.blockUI'
        ));

echo $html->css(array('jquery.autocomplete'));
?>
<script type="text/javascript">
        jQuery(document).ready(function() {
            jQuery.each(jQuery('#formPlanes input:checkbox'), function(key, value) {
                jQuery(value).attr("checked", false);
            });

            jQuery('#formPlanes').change(function() {
                jQuery.each(jQuery('#formPlanes'), function(key, value) {
                    if (jQuery(value).is(':checked')) {
                        jQuery('#plan-linea-'+jQuery(value).attr('numero')).attr('style', 'background:#EFFBEF');
                    }
                    else {
                        jQuery('#plan-linea-'+jQuery(value).attr('numero')).attr('style', 'background:white');
                    }
                });
            });

            jQuery('#titulo_id').change(seleccionarTitulosEnMasa);
            actualizarSelects();


            /*******/
            

            jQuery("#TituloName").autocomplete("<?echo $html->url(array('controller'=>'titulos','action'=>'ajax_search'));?>", {
                dataType: "json",
                delay: 200,
                max:30,
                cacheLength:0,
                extraParams: {
                    oferta_id: function() { return jQuery('#FPlanOfertaId').val(); },
                    sector_id: function() { return jQuery('#FPlanSectorId').val(); },
                    subsector_id: function() { return jQuery('#FPlanSubsectorId').val(); }
                } ,
                parse: function(data) {
                    return jQuery.map(data, function(titulo) {
                        return {
                            data: titulo,
                            value: titulo.id,
                            result: formatResult(titulo)
                        }
                    });
                },
                formatItem: function(item) {
                    return formatResult(item);
                }
            }).result(function(e, item) {
                if(item.type == 'Vacio'){
                    jQuery("#TituloName").val('');
                    jQuery("#titulo_id").val('');
                }
                else{
                    jQuery("#titulo_id").val(item.id);
                }
            });

            jQuery("#TituloName").attr('autocomplete','off');
        });


        function formatResult(titulo) {
            return titulo.name;
        }


	function checkAll(){
            jQuery.each(jQuery('#formPlanes input:checkbox'), function(key, value) {
                jQuery(value).attr("checked", true);
                jQuery('#plan-linea-'+jQuery(value).attr('numero')).attr('style', 'background:#EFFBEF');
            });
	}


	function unCheckAll(){
            jQuery.each(jQuery('#formPlanes input:checkbox'), function(key, value) {
                jQuery(value).attr("checked", false);
                jQuery('#plan-linea-'+jQuery(value).attr('numero')).attr('style', 'background:white');
            });
	}


	function cambiarTitulos(element){
            jQuery(element).select(jQuery('#titulo_id').val());
	}


        function seleccionarTitulosEnMasa() {
            jQuery.each(jQuery('.titulo'), function(key, value) {
                jQuery(value).val(jQuery('#titulo_id').val());
            });
        }


        function actualizarSelects() {
            var selectedText = jQuery('#titulo_id option:selected').text();

            jQuery.each(jQuery('.titulo'), function(key, value) {
                jQuery(value).val(jQuery('#titulo_id').val());
                jQuery(value).append(jQuery("<option></option>").attr("value",jQuery('#titulo_id').val()).text(selectedText));
            });
        }
</script>
<?
$paginator->options(array('url' => $url_conditions));
?>
<h1> ¡¡ vamos que faltan solo <?php echo $paginator->counter(array(
			'format' => '%count%'));?>!!</h1>

<!-- 	BUSQUEDA POR SU OFERTA  	-->

<div id="search-planes" style="font-size:9pt;">
    <?php echo $form->create('Form',array('url'=>'/titulos/corrector_de_planes','id'=>'Form'));?>
    <?
    echo $form->input('FPlan.oferta_id',array(
                        'options'=>$ofertas,
                        'empty'=>'Seleccione',
                        'label'=>'Oferta'));

    $meter = '<span class="ajax_update" id="ajax_indicator" style="display:none;">'.$html->image('ajax-loader.gif').'</span>';
    echo $form->input('FPlan.jurisdiccion_id', array(
                        'empty' => array('0'=>'Todas'),
                        'id'=>'jurisdiccion_id',
                        'label'=>'Jurisdicción',
                        'after'=>$meter,
                        'options'=>$jurisdicciones,

    ));
    ?>
    <?php
    echo $form->input('FPlan.sector_id',array(
                        'label'=>'Sector',
                        'options'=>$sectores,
                        'empty'=>'Seleccione'
    ));

    echo $form->input('FPlan.subsector_id', array(
                        'label'=>'Subsector',
                        'empty'=>'Seleccione',
            ));
    ?>
    <?php
    echo $form->input('FPlan.limit',array(
            'label'=>'Cantidad de planes por página',
            'options'=>array('10'=>10,'20'=>20,'40'=>40,'60'=>60)
         ));

    echo $form->input('FPlan.plan_nombre', array('label'=>'Nombre del Plan', 'after'=> '<cite>Realiza una búsqueda por parte del nombre del plan.<br>Ej: SOLDADURA</cite>'));?>

<?php
    echo $ajax->observeField(
            'FPlanSectorId', array(
                'url' => '/subsectores/ajax_select_subsector_form_por_sector',
                'update'=>'FPlanSubsectorId',
                'loading'=>'jQuery("#FPlanSubsectorId").attr("disabled", true);',
                'complete'=>'jQuery("#FPlanSubsectorId").attr("disabled", false);',
                'onChange'=>true
    ));

   
   echo $form->end('Buscar', array(
                    'style'=>'  display: block;
                                width: 100px;
                                vertical-align: bottom;
                                margin-top: 7px;
                                margin-left: 4px;
                                border-color: #CEE3F6;
                                background-color: #DBEBF6;
                                color: #045FB4;
                                font-weight: bold;'
       ));
?>

 </div>



<hr>

<?php
echo $form->create('Plan', array(
			'url'=>'/titulos/corrector_de_planes',
			//'onsubmit'=>'activarCambios(); return false;',
			'id'=>'formPlanes'
));


echo $form->button('Seleccionar Todos', array('onclick'=>'checkAll()', 'style'=>'clear:none;float:left;width:144px;'));
echo $form->button('Deseleccionar Todos', array('onclick'=>'unCheckAll()', 'style'=>'clear:none;float:left;width:144px;'));

$i = 0;
foreach ($planes as $p) {

	$div_id = "plan-id-".$p['Plan']['id'];
	?>


	<div style="font-size: 12px;" id="plan-linea-<?= $i?>">
		<?php echo $form->input("Plan.$i.id",array('value' =>$p['Plan']['id']));?>

                <?php echo $form->checkbox("Plan.$i.selected", array(
                            'id'=>"checkbox-$i",
                            'numero'=>$i,
                    ));
                ?>

                <?php echo $form->input("Plan.$i.titulo_id", array(
                        'class'=>'titulo dep_titulo',
                        'div'=>false,
                        'label'=>false,
                        'default'=>'seleccione',
                        'empty'=>'seleccione',
                        'style'=>'clear: none;',
                        'onchange'=> 'jQuery("#checkbox-'.$i.'").attr("checked", true)',
                    ));
                ?>
		<a style="font-size: 10px;" href="javascript:" onclick="jQuery('#<? echo $div_id?>').toggle(); return false;"><?= $p['Plan']['nombre']?></a>
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

echo $form->input(
'tituloName',
array(
    'label'=> 'Asignar Título en masa',
    'id' => 'TituloName',
    'after'=> '<span class="ajax_update" id="ajax_indicator" style="display:none;">'.$html->image('ajax-loader.gif').'</span>',
    'style'=>'max-width: 550px;',
    'div'=>array('id'=>'divTituloName')));
 echo $form->input('titulo_id', array(
    'type'=>'hidden',
    'id'=>'titulo_id',
    'value'=>$titulo_id
    ));



//echo $form->button('Seleccionar Todos', array('onclick'=>'checkAll()', 'style'=>'clear:none;float:left;width:144px;'));
//echo $form->button('Deseleccionar Todos', array('onclick'=>'unCheckAll()', 'style'=>'clear:none;float:left;width:144px;'));

?>

<div>
<?php
echo $paginator->prev('<< '.__('Anterior', true), array(), null, array('class'=>'disabled'));
echo $paginator->numbers(array('modulus'=>13));
echo $paginator->next(__('Siguiente', true).' >>', array('style'=>'float:right;'), null, array('class'=>'disabled'));
?>
</div>


<?php

echo $form->button('Seleccionar Todos', array('onclick'=>'checkAll()', 'style'=>'clear:none;float:left;width:144px;'));
echo $form->button('Deseleccionar Todos', array('onclick'=>'unCheckAll()', 'style'=>'clear:none;float:left;width:144px;'));



echo $form->hidden('FPlan.limit');
echo $form->hidden('FPlan.oferta_id');
echo $form->hidden('FPlan.sector_id');
echo $form->hidden('FPlan.subsector_id');
echo $form->hidden('FPlan.jurisdiccion_id');
echo $form->hidden('FPlan.plan_nombre');

if (strlen($paginator->counter(array('format' => '%page%'))))
    echo $form->hidden('FPlan.last_page', array('value' => $paginator->counter(array('format' => '%page%'))));

echo $form->end('Guardar Cambios');


?>
<br>
<a href="javascript:" onclick="jQuery('#formularioNuevoTitulo').toggle()" style="background-color: gray; color: white; text-decoration: none">Agregar Nuevo Título de Referencia</a>
<div id="formularioNuevoTitulo" style="display: none; background-color: gray">
<?
echo $ajax->form(array('type' => 'post',
    'options' => array(
        'model'=>'Titulo',
        'url' => array(
            'controller' => 'titulos',
            'action' => 'add_and_give_me_select_options'
        ),
        'id'=> "formAltaTitulo",
        'complete'=>'jQuery("#formAltaTitulo").reset(); actualizarSelects();',
        'update'=> 'divTituloGral',
    )
));
echo $form->hidden('marco_ref', array('value'=>0));
echo $form->input(
        'oferta_id',
        array(
            'options'=>$ofertas,
            'label'=>false,
            'empty' => 'Seleccione',
            'default' => $this->data['FPlan']['oferta_id'],
        )
     );
echo $form->input('name', array('style'=>'clear:none;'));
echo $form->end('Guardar Título');
?>
</div>

<br>


