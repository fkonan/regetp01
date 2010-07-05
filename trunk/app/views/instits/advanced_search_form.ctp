<?
echo $javascript->link('jquery.autocomplete');
echo $javascript->link('jquery.blockUI');
echo $html->css('jquery.autocomplete.css');
?>


<style>
    INPUT, TEXTAREA, SELECT, option{
        font-size: 10pt;
        
        letter-spacing: normal;
        line-height: normal;
        margin: 0em;
        text-indent: 0px;
        text-shadow: none;
        text-transform: none;
        word-spacing: normal;
    }


    input[type="text"], input.text, input.title, textarea, select{
        background-color: white;
        border: 1px solid #BBB;
    }

    label{
        font-size: 8pt;
    }


</style>

<script language="javascript">
jQuery(document).ready(function() {
    jQuery("#InstitJurDepLoc").autocomplete("<?echo $html->url(array('controller'=>'localidades','action'=>'ajax_search_localidades'));?>", {
		dataType: "json",
                delay: 200,
                max:30,
                minChars: 3,
                cacheLength:1,
                extraParams: {
                  jur: function() { return jQuery('#jurisdiccion_id').val(); }
                } ,
		parse: function(data) {
			return jQuery.map(data, function(loc_dep) {
				return {
					data: loc_dep,
					value: loc_dep.id,
					result: formatResult(loc_dep)
				}
			});
		},
		formatItem: function(item) {
			return formatResult(item);
		}
     }).result(function(e, item) {
                jQuery("#hiddenLocDepId").remove();
                jQuery("#InstitSearchForm #search-ubicacion").append("<input id='hiddenLocDepId' name='data[" + item.type + "][id]' type='hidden' value='" + item.id + "' />");
     });

    jQuery("#InstitSearchForm :input[title]").tooltip({
        position: "right center",
        offset: [-10, 130],
        effect: "fade",
        opacity: 0.7
    });
});

function formatResult(loc_dep) {
    if(loc_dep.type == 'Localidad'){
        return loc_dep.localidad + ', ' + loc_dep.departamento + ' (' + loc_dep.jurisdiccion + ')';
    }
    else{
        return loc_dep.departamento + ' (' + loc_dep.jurisdiccion + ')';
    }
    
}

function enviar()
{
    //jQuery('#InstitSearchForm input[type=button]').attr('disabled', 'disabled');
    jQuery('#InstitSearchForm').submit();
}

</script>
<h1><?= __('Buscar Institución')?></h1>
<style>
.label {color:#444444;}

</style>
<div>
    <?= $form->create('Instit',array('action' => 'search','name'=>'InstitSearchForm'));?>

    <fieldset id="search" class="search-div" >
        <legend style="float:right;border-bottom: 0px">General</legend>
        
            <?= $form->input('cue', array(
                'label'=>'CUE',
                'div'=>array('style'=>'width:110px; float: left; clear: none'),
                'style'=> 'width:90px; float: left',
                'maxlength'=>9 ,
                'title'=> 'Ej: 600118 o 5000216. También puede buscar con el n° de anexo, Ej: 60011800')); ?>
            <!--JURISDICCION-->
            <?php echo $form->input('nombre_completo', array(
                'label'=>'Nombre',
                'div'=>array('style'=>'width:270px; float: left; clear: none'),
                //'style'=> 'width:260px',
                'title'=> 'Realiza una búsqueda por tipo de establecimiento, número y nombre propio de la institución.<br>Ej: Escuela 3 San Martín'));
            ?>
            <?php
                echo $form->input('jurisdiccion_id', array(
                    'label'=>'Jurisdicción',
                    'div'=>array('style'=>'float: left;  clear: none'),
                    'class'=> 'display: block; clear: both;',
                    'empty' => array('0'=>'Todas'),
                    'id'=>'jurisdiccion_id'));
                echo '<span class="ajax_update" id="ajax_indicator" style="display:none; float: left; clear: none">'.$html->image('ajax-loader.gif').'</span>';
            ?>
    </fieldset>
    

    <!--
				BUSQUEDA POR SU UBICACION
		-->
    <fieldset id="search-ubicacion" class="search-div" >
        <legend>Por Ubicación</legend>
            <?php echo $form->input('jur_dep_loc', array('label'=>'Departamento/Localidad','title'=>'Ingrese al menos 3 letras para que comience la busqueda de Departamentos y Localidades.')); ?>
            <?php echo $form->input('direccion', array('label'=>'Domicilio')); ?>
    </fieldset>


    <!--
				BUSQUEDA POR SU NOMBRE
		-->
    <fieldset id="search-denominacion"  class="search-div" >
        <legend>Por Nombre</legend>
                    <?php
                    echo $form->input('tipoinstit_id', array(
                        'label'=>'Tipo',
                        //'div'=>false,
                        'style'=> 'display:inline;width:550px;vertical-align:bottom',
                        'empty' => 'Todos',
                        'type'=>'select',
                        'title'=> 'Para activar este campo, seleccione primero una jurisdicción'));

                    echo $ajax->observeField('jurisdiccion_id',
                    array('url' => '/tipoinstits/ajax_select_form_por_jurisdiccion',
                    'update'=>'InstitTipoinstitId',
                    'loading'=>'jQuery("#ajax_indicator").show();jQuery("#InstitTipoinstitId").attr("disabled","disabled")',
                    'complete'=>'jQuery("#ajax_indicator").hide();jQuery("#InstitTipoinstitId").removeAttr("disabled")',
                    'onChange'=>true
                    ));
                    ?>
                <?php
                echo $form->input('nroinstit', array(
                    'label'=>'Número',
                    'style'=> 'width:90px; float: left',
                    'div'=>array('style'=>'float: left;  clear: none'),
                    'class'=> 'display: block; clear: both;',
                    'empty' => array('0'=>'Todas'),
                   ));
                ?>
                <?php
                echo $form->input('nombre', array(
                    'label'=>'Nombre',
                    'style'=> 'width:441px; float: left',
                    'div'=>array('style'=>'float: left;  clear: none'),
                    'title'=> 'Ej: "Sarmiento" o "Gral. Belgrano". No confundir el nombre con el tipo de establecimiento'));
                ?>
    </fieldset>


    <!--
				BUSQUEDA POR SU OFERTA
		-->
    <fieldset id="search-planes"  class="search-div" >
        <legend>Por Oferta</legend>
        <?php
        echo $form->input('Plan.oferta_id',array('options'=>$ofertas,
        'empty'=>'Seleccione',
        'label'=>'Con Oferta'));
        ?>
        <div>
                <span class="label">Sector</span>
                <span class="label" style="padding-left:202px">Subsector</span>
        </div>
        <?php
                echo $form->input('Plan.sector_id',array(
                    'label'=>false,
                    'div'=>array('style'=>'float:left;'),
                    'style'=> 'display:inline;width:40%',
                    'options'=>$sectores,
                    'empty'=>'Seleccione'
                ));
        ?>
        <span>
        <?php
                echo $form->input('Plan.subsector_id',array(
                    'label'=>false,
                    'div'=>false,
                    'style'=> 'display:inline;width:40%',
                    'empty'=>'Seleccione',
                ));
        ?>
        </span>
        <?php
                echo $ajax->observeField('PlanSectorId',
                    array('url' => '/subsectores/ajax_select_subsector_form_por_sector',
                        'update'=>'PlanSubsectorId',
                        'loading'=>'jQuery("#PlanSubsectorId").attr("disabled","disabled");',
                        'complete'=>'jQuery("#PlanSubsectorId").removeAttr("disabled");',
                        'onChange'=>true
                ));
        ?>
        <div>
                <span class="label">Orientación</span>
                <span class="label" style="padding-left:85px">Título de Referencia</span>
        </div>
        <span>
        <?php
                echo $form->input('Instit.orientacion_id',array(
                'label'=>false,
                'div'=>false,
                'style'=> 'display:inline;width:25%',
                'empty'=>'Seleccione',
                ));
        ?>
        </span>
        <span>
        <?php

                 echo $form->input('Plan.titulo_id',array(
                    'label'=>false,
                    'div'=>false,
                    'style'=> 'display:inline;width:55%',
                    'options'=>$titulos,
                    'empty'=>'Seleccione',
                ));
        
        ?>
        </span>
        <?php
                echo $form->input('Plan.norma',array(
                    'label'=>'Normativa'
                ));
        ?>

    </fieldset>


    <!--
				BUSQUEDA POR OTRAS CARACTERISTICAS
		-->

    <div id="search-otros"  class="search-div" >
        <legend style="float:right;border-bottom: 0px">Por Otras Caracteristicas</legend>
        <div>
                <span class="label">Relación con ETP</span>
                <span class="label" style="padding-left:202px">Tipo de Institución de ETP</span>      
        </div>
        <span>
        <?php
        echo $form->input('etp_estado_id', array('empty' => 'Todas', 'label'=>false,'div'=>false,'style'=> 'display:inline;width:50%'));
        ?>
            
        </span>
        <span>
        <?php
        echo $form->input('claseinstit_id', array('empty' => 'Todas', 'label'=>false,'div'=>false,'style'=> 'display:inline;width:40%',));
        ?>
        </span>
        <div>
                <span class="label">Ámbito de Gestión</span>
                <span class="label" style="padding-left:10px">Tipo de Dependencia</span>
                <span class="label" style="padding-left:120px">Institución Ingresada al RFIETP</span>
        </div>
        <span>
        <?php
        echo $form->input('gestion_id', array('empty' => 'Todas', 'label'=>false,'div'=>false,'style'=> 'display:inline;width:20%'));
        ?>
        </span>
        <span>
        <?php
        echo $form->input('dependencia_id', array('empty' => 'Todas','label'=>false,'div'=>false,'style'=> 'display:inline;width:40%'));
        ?>
        </span>
        <span>
        <?php
        // no hay busqueda por anexo
        //$array_anexo = array('-1'=>'Buscar Todas','0'=>'No','1'=>'Si');
        //echo $form->input('esanexo',array('options'=> $array_anexo,'label'=>'Anexo'));

        $array_activa = array('-1'=>'Buscar Todas','0'=>'No','1'=>'Si');
        echo $form->input('activo',array('options'=> $array_activa,'label'=>false,'div'=>false,'style'=> 'display:inline;width:30%'));
        ?>
        </span>
    </div>

    <?php echo $form->button('Buscar',array('style'=>'float:right; margin-bottom:10px','onclick'=>'enviar()'));?>
    <?php echo $form->end(); ?>

</div>

