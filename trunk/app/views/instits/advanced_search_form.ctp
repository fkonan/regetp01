<?
echo $javascript->link(array(
'jquery.autocomplete',
//'jquery.tooltip.min',

'jquery.blockUI',
));

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

    function iniciarTooltip(){
        jQuery.tools.tooltip.conf.events.input = 'focus,blur';
        jQuery.tools.tooltip.conf.events.tooltip = '';
        jQuery.tools.tooltip.conf.events.widget = 'focus, blur';
        jQuery("#InstitSearchForm :input[title]").tooltip({ effect: 'fade', offset:[12,0]});
        
    }

    jQuery(document).ready(function() {

        //jQuery("#search *").tooltip({



        iniciarTooltip();


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

    function borrarDatos(nombreElemento){
     jQuery(nombreElemento).css({backgroundColor:"#FFFFE0"}).animate(
                   {width:'544px'},
                    200,
                    'linear',
                    function(){
                        jQuery(nombreElemento).delay(100).animate(
                            {width:'544px'},
                            200,
                            function(){
                                jQuery(nombreElemento).css({background:"#FFF"});
                        });
                    });
}


    function onSeleccionDeJurisdiccionDo(){
        
        jQuery("#ajax_indicator").hide();
        jQuery("#InstitTipoinstitId").removeAttr("disabled");

//console.debug(jQuery('#InstitJurDepLoc').css);

       borrarDatos('#InstitJurDepLoc');
       borrarDatos('#InstitTipoinstitId');

       //jQuery('#InstitJurDepLoc').delay(1900).css({borderColor:"black"});


//    jQuery("#InstitJurDepLoc").css({borderColor:"#000000",borderWidth:'6px'});
//    jQuery("#InstitJurDepLoc").delay("99999900").css({borderColor:"#BBBBBB",borderWidth:'1px'});

        jQuery("#hiddenLocDepId").remove();
        jQuery("#InstitJurDepLoc").val("");
        jQuery("#label-tipoinstit").html('Mostrando Tipo de Instituciones de '+jQuery('#jurisdiccion_id :selected').text());
    }

</script>
<h1><? __('Búsqueda Avanzada de Institución')?></h1>
<style>
    .label {color:#444444;}

</style>
<div>
    <?= $form->create('Instit',array('action' => 'search','name'=>'InstitSearchForm'));?>

    <fieldset id="search" class="search-div" >
        <legend>General</legend>

        <?php
        echo $form->input('cue', array(
        'label'=>'CUE',
        'div'=>array('style'=>'width:90px; float: left; clear: none'),
        'style'=> 'width:80px; float: left',
        'maxlength'=>9 ,
        'title'=> 'Ej: 600118 o 5000216. También puede buscar con el n° de anexo, Ej: 60011800'));

        echo $form->input('nombre_completo', array(
        'label'=>'Nombre',
        'div'=>array('style'=>'width:270px; float: left; clear: none'),
        //'style'=> 'width:260px',
        'title'=> 'Realiza una búsqueda por tipo de establecimiento, número y nombre propio de la institución.<br>Ej: Escuela 3 San Martín'));

        echo $form->input('jurisdiccion_id', array(
        'label'=>'Jurisdicción',
        'div'=>array('style'=>'float: left;  clear: none'),
        'class'=> 'display: block; clear: both;',
        'empty' => array('0'=>'Todas las Jurisdicciones'),
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
        'label'=>array('text'=>'Tipo','id'=>'label-tipoinstit'),
        //'div'=>false,
        'style'=> 'display:inline;width:550px;vertical-align:bottom',
        'empty' => 'Todos',
        'type'=>'select',
        'title'=> 'Para activar este campo, seleccione primero una jurisdicción'));

        echo $ajax->observeField('jurisdiccion_id',
        array('url' => '/tipoinstits/ajax_select_form_por_jurisdiccion',
        'update'=>'InstitTipoinstitId',
        'loading'=>'jQuery("#ajax_indicator").show();jQuery("#InstitTipoinstitId").attr("disabled","disabled")',
        'complete'=>'onSeleccionDeJurisdiccionDo();',
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
        echo $form->input('Plan.oferta_id',array(
        'options'=>$ofertas,
        'div'=>array('style'=>'float: left;  clear: none'),
        'style'=> 'display:inline;width:181px;vertical-align:bottom',
        'empty'=>'Seleccione',
        'label'=>'Con Oferta'));


        echo $form->input('Plan.titulo_id',array(
        'label'=> 'Título de Referencia',
        'div'=>array('style'=>'float: left;  clear: right'),
        'style'=> 'display:inline;width:181px;vertical-align:bottom',
        'options'=>$titulos,
        'empty'=>'Seleccione',
        ));


        echo $form->input('Plan.sector_id',array(
        'label'=>'Sector',
        'div'=>array('style'=>'float: left;  clear: left'),
        'style'=> 'display:inline;width:277px;vertical-align:bottom',
        'options'=>$sectores,
        'empty'=>'Seleccione'
        ));

        echo $form->input('Plan.subsector_id',array(
        'label'=>'Subsector',
        'div'=>array('style'=>'float: left;  clear: none'),
        'style'=> 'display:inline;width:267px;vertical-align:bottom',
        'empty'=>'Seleccione',
        ));

        echo $ajax->observeField('PlanSectorId',
        array('url' => '/subsectores/ajax_select_subsector_form_por_sector',
        'update'=>'PlanSubsectorId',
        'loading'=>'jQuery("#PlanSubsectorId").attr("disabled","disabled");',
        'complete'=>'jQuery("#PlanSubsectorId").removeAttr("disabled");',
        'onChange'=>true
        ));



        echo $form->input('Plan.norma',array(
        'label'=>'Normativa',
        'div'=>array('style'=>'float: left;  clear: left'),
        'style'=> 'display:inline;width:544px;vertical-align:bottom',
        ));
        ?>

    </fieldset>


    <!--
            BUSQUEDA POR OTRAS CARACTERISTICAS
    -->

    <fieldset id="search-otros"  class="search-div" >
        <legend>Por Otras Caracteristicas</legend>
        <?php
        echo $form->input('Instit.orientacion_id',array(
        'label'=> 'Orientación',
        'div'=>array('style'=>'float: left;  clear: none'),
        'style'=> 'display:inline;width:272px;vertical-align:bottom',
        'empty'=>'Seleccione',
        ));

        echo $form->input('claseinstit_id', array(
        'empty' => 'Todas',
        'label'=> 'Tipo de Institución de ETP',
        'div'=>array('style'=>'float: left;  clear: none'),
        'style'=> 'display:inline;width:270px;vertical-align:bottom',
        ));


        echo $form->input('etp_estado_id', array(
        'empty' => 'Todas',
        'label'=>'Relación con ETP',
        'div'=>array('style'=>'float: left;  clear: left'),
        'style'=> 'display:inline;width:272px;vertical-align:bottom',
        ));

        echo $form->input('gestion_id', array(
        'empty' => 'Todas',
        'label'=> 'Ámbito de Gestión',
        'div'=>array('style'=>'float: left;  clear: none'),
        'style'=> 'display:inline;width: 270px;vertical-align:bottom',
        ));


        echo $form->input('dependencia_id', array(
        'empty' => 'Todas',
        'label'=> 'Tipo de Dependencia',
        'div'=>array('style'=>'float: left;  clear: left'),
        'style'=> 'display:inline;width:272px;vertical-align:bottom',));


        // no hay busqueda por anexo
        //$array_anexo = array('-1'=>'Buscar Todas','0'=>'No','1'=>'Si');
        //echo $form->input('esanexo',array('options'=> $array_anexo,'label'=>'Anexo'));

        $array_activa = array('-1'=>'Buscar Todas','0'=>'No','1'=>'Si');
        echo $form->input('activo',array(
        'options'=> $array_activa,
        'label'=> 'Institución Ingresada al RFIETP',
        'div'=>array('style'=>'float: left;  clear: none'),
        'style'=> 'display:inline;width:270px;vertical-align:bottom',
        ));
        ?>

    </fieldset>

    <?php echo $form->button('Buscar',array('style'=>'float:right; margin-bottom:10px','onclick'=>'enviar()'));?>
    <?php echo $form->end(); ?>

</div>

