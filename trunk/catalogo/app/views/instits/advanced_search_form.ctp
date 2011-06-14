<?
echo $javascript->link(array(
'jquery.autocomplete',
'jquery.blockUI',
'jquery.bgiframe'
));

echo $html->css('jquery.autocomplete.css', false);
echo $html->css('catalogo.advanced_search', false);
?>
<script type="text/javascript" language="javascript">
    init__AdvancedSearchFormJs("<?echo $html->url(array('controller'=>'localidades','action'=>'ajax_search_localidades'));?>","<?echo $html->url(array('controller'=>'titulos','action'=>'ajax_search'));?>");
</script>


<h1 class="grid_12"><? __('Búsqueda Avanzada de Instituciones')?></h1>
<?= $form->create('Instit',array('action' => 'search','name'=>'InstitSearchForm'));?>
<div class="grid_12 boxblanca">

    

    <fieldset id="search" class="">
        <legend>General</legend>
        <?php
        echo $form->input('cue', array(
        'label'=>'CUE',
        'div'=>array('style'=>'width:30%; float: left; clear: none'),
        'style'=> 'width:90%; float: left',
        'maxlength'=>9 ,
        'title'=> 'Ej: 600118 o 5000216. También puede buscar con el n° de anexo, Ej: 60011800'));

        echo $form->input('nombre_completo', array(
        'label'=>'Nombre',
        'div'=>array('style'=>'width:40%; float: left; clear: none'),
        'style'=> 'width:90%',
        'title'=> 'Realiza una búsqueda por tipo de establecimiento, número y nombre propio de la institución.<br>Ej: Escuela 3 San Martín'));

        echo $form->input('jurisdiccion_id', array(
        'label'=>'Jurisdicción',
        'div'=>array('style'=>'float: left;  clear: none; width: 30%'),
        'class'=> 'display: block; clear: both;',
        'empty' => array('0'=>'Todas'),
        'id'=>'jurisdiccion_id'));
        echo '<span class="ajax_update" id="ajax_indicator" style="display:none; margin-top: -32px; float: right; clear: none">'.$html->image('ajax-loader.gif').'</span>';
        ?>
    </fieldset>


    <!--
				BUSQUEDA POR SU UBICACION
		-->
    <fieldset id="search-ubicacion" class="">
        <legend>Por Ubicación</legend>
        <?php echo $form->input('jur_dep_loc',
        array('label'=>'Departamento/Localidad',
        'style'=>'width:90%;',
        'title'=>'Ingrese al menos 3 letras para que comience la busqueda de Departamentos y Localidades.',
        'div'=>array('style'=>'width:50%;clear: none;float:left'))); ?>
        <?php echo $form->input('direccion',
        array('label'=>'Domicilio',
        'style'=>'width:90%;',
        'div'=>array('style'=>'width:50%;clear: none;float:left'))); ?>
    </fieldset>


    <!--
				BUSQUEDA POR SU NOMBRE
		-->
    <fieldset id="search-denominacion"  class="" >
        <legend>Por Nombre</legend>
        <?php
        echo $form->input('tipoinstit_id', array(
        'label'=>array('text'=>'Tipo','id'=>'label-tipoinstit'),
        'div'=>array('style'=>'clear: none;float:left;width:30%'),
        'style' => 'width: 90%',
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
        'style'=> 'width:90%; float: left',
        'div'=>array('style'=>'float: left; width:20%; clear: none'),
        'class'=> 'display: block; clear: both;',
        'empty' => array('0'=>'Todas'),
        ));
        ?>
        <?php
        echo $form->input('nombre', array(
        'label'=>'Nombre',
        'style'=> 'width:92%; float: left',
        'div'=>array('style'=>'float: left;  clear: none; width: 50%'),
        'title'=> 'Ej: "Sarmiento" o "Gral. Belgrano". No confundir el nombre con el tipo de establecimiento'));
        ?>
    </fieldset>


    <!--
				BUSQUEDA POR SU OFERTA
		-->
    <fieldset id="search-planes"  class="" >
        <legend>Por Oferta</legend>
        <?php
        echo $form->input('Plan.oferta_id',array(
        'options'=>$ofertas,
        'id'=>'OfertaId',
        'div'=>array('style'=>'float: left; width:50%; clear: none'),
        'style'=> 'display:inline;width:90%;vertical-align:bottom',
        'empty'=>'Seleccione',
        'label'=>'Con Oferta'));

        echo $form->input('Plan.norma',array(
        'label'=>'Normativa',
        'div'=>array('style'=>'float: left; width: 50%;  clear: none'),
        'style'=> 'display:inline;vertical-align:bottom;  width: 90%;',
        ));

        echo $form->input('SectoresTitulo.sector_id',array(
        'label'=>'Sector',
        'id'=>'SectorId',
        'div'=>array('style'=>'float: left; width:50%; clear: left'),
        'style'=> 'display:inline;width:90%;vertical-align:bottom',
        'options'=>$sectores,
        'empty'=>'Seleccione'
        ));

        echo $form->input('SectoresTitulo.subsector_id',array(
        'type' => 'select',
        'id'=>'SubsectorId',
        'label'=>'Subsector',
        'div'=>array('style'=>'float: left;  clear: none; width: 50%'),
        'style'=> 'display:inline;vertical-align:bottom; width: 90%',
        'empty'=>'Seleccione',
        ));

        echo $ajax->observeField('SectorId',
        array('url' => '/subsectores/ajax_select_subsector_form_por_sector',
        'update'=>'SubsectorId',
        'loading'=>'jQuery("#SubsectorId").attr("disabled","disabled");',
        'complete'=>'jQuery("#SubsectorId").removeAttr("disabled");',
        'onChange'=>true
        ));

        echo $form->input(
        'tituloName',
        array(
        'label'=> 'Título de Referencia',
        'id' => 'PlanTituloName',
        'style'=>'max-width: 515px; width:95%;',
        'div'=>array('id'=>'divPlanTituloName', 'style'=>'width: 100%')));

        echo $form->input('Plan.titulo_id',array('id'=>'PlanTituloId','type'=>'hidden'));

        ?>

    </fieldset>


    <!--
            BUSQUEDA POR OTRAS CARACTERISTICAS
    -->
    <fieldset id="search-otros"  class="" style="margin-top: -65px;">
        <legend>Por Otras Características</legend>
        <?php
        echo $form->input('Instit.orientacion_id',array(
        'label'=> 'Orientación',
        'div'=>array('style'=>'float: left; width:50%; clear: none'),
        'style'=> 'display:inline;width:90%;vertical-align:bottom',
        'empty'=>'Seleccione',
        ));

        echo $form->input('Instit.claseinstit_id', array(
        'empty' => 'Todas',
        'label'=> 'Tipo de Institución de ETP',
        'div'=>array('style'=>'float: left; width:50%; clear: none'),
        'style'=> 'display:inline;width:90%;vertical-align:bottom',
        ));


        echo $form->input('Instit.etp_estado_id', array(
        'empty' => 'Todas',
        'label'=>'Relación con ETP',
        'div'=>array('style'=>'float: left; width:50%; clear: none'),
        'style'=> 'display:inline;width:90%;vertical-align:bottom',
        ));

        echo $form->input('Instit.gestion_id', array(
        'empty' => 'Todas',
        'label'=> 'Ámbito de Gestión',
        'div'=>array('style'=>'float: left; width:50%; clear: left'),
        'style'=> 'display:inline;width: 90%;vertical-align:bottom',
        ));


        echo $form->input('Instit.dependencia_id', array(
        'empty' => 'Todas',
        'label'=> 'Tipo de Dependencia',
        'div'=>array('style'=>'float: left; width:50%; clear: none'),
        'style'=> 'display:inline;width:90%;vertical-align:bottom',));


        // no hay busqueda por anexo
        //$array_anexo = array('-1'=>'Buscar Todas','0'=>'No','1'=>'Si');
        //echo $form->input('esanexo',array('options'=> $array_anexo,'label'=>'Anexo'));

//        $array_activa = array('-1'=>'Buscar Todas','0'=>'No','1'=>'Si');
//        echo $form->input('activo',array(
//        'options'=> $array_activa,
//        'label'=> 'Institución Ingresada al RFIETP',
//        'div'=>array('style'=>'float: left; width:50%; clear: none'),
//        'style'=> 'display:inline;width:90%;vertical-align:bottom',
//        ));
        ?>

    </fieldset>

    
    <div style="width: 50%; float: left; margin-top: 55px;">
        <?php echo $form->button('Buscar',array(
        'class'=>'boxgris',
        'style' => 'margin: auto; margin-left: 13px;',
        'onclick'=>'enviar()'));
        ?>
    </div>

    <?php echo $form->end(); ?>

</div>