<script type="text/javascript">
init('<?echo $html->url(array('controller'=>'localidades','action'=>'ajax_search_localidades'));?>');
</script>
<div class="titulos search">
<h1><?php __('Búsqueda de Títulos de Referencia');?></h1>
<?php
echo $javascript->link(array(
            'jquery.autocomplete',
            'jquery.loadmask.min',
            'jquery-ui-1.8.12.custom.min',
        ));
echo $html->css(array('jquery.loadmask', 'ui-redmond/jquery-ui-1.8.12.custom'));
?>
<?php 
        echo $form->create('Titulo', array(
            'action' => 'ajax_search_results',
            'name'=>'TituloSearchForm',
            'id' =>'TituloSearchForm',
            )
        );

        echo $form->input(
        'oferta_id',
        array(
            'div'=>array('style'=>'width:200px;float:left;clear:none;'),
            'class' => 'autosubmit',
            'label'=> 'Oferta',
            'id' => 'ofertaId',
            'empty' => 'Todas',
            ));

        $meter = '<span class="ajax_update" id="ajax_indicator" style="display:none;">'.$html->image('ajax-loader.gif').'</span>';
        echo $form->input('sector_id', array(
            'div'=>array('style'=>'width:200px;float:left;clear:none;'),
            'class' => 'autosubmit',
            'type'=>'select','empty'=>'Seleccione','options'=>$sectores,'label'=>'Sector','id'=>'sectorId','after'=>$meter)
        );
        echo $form->input('subsector_id', array(
            'div'=>array('style'=>'width:200px;float:left;clear:none;'),
            'class' => 'autosubmit',
            'empty' => 'Seleccione','type'=>'select','label'=>'Subsector', 'id'=>'subsectorId','after'=> $meter)
        );

        echo $ajax->observeField('sectorId',
                                   array(
                                       'url' => '/subsectores/ajax_select_subsector_form_por_sector',
                                        'update'=>'subsectorId',
                                        'loading'=>'jQuery("#ajax_indicator").show();jQuery("#subsectorId").attr("disabled","disabled")',
                                        'complete'=>'jQuery("#ajax_indicator").hide();jQuery("#subsectorId").removeAttr("disabled")',
                                        'onChange'=>true
                                   ));

        echo $form->input(
            'tituloName',
            array(
                'label'=> 'Nombre del Título de Referencia',
                'id' => 'TituloName',
                'style'=>'width: 450px; clear:none; float:left;',
                ));


         echo $form->input('jurisdiccion_id', array(
        'label'=>'Jurisdicción',
        'div'=>array('style'=>'float: left;  clear: none; width: 175px;'),
        'style'=> 'display: block; clear: both;',
        'class' => 'autosubmit',
        'empty' => array('0'=>'Todas'),
        'id'=>'jurisdiccion_id'));
        echo '<span class="ajax_update" id="ajax_indicator" style="display:none; margin-top: -32px; float: right; clear: none">'.$html->image('ajax-loader.gif').'</span>';

        ?>
        <fieldset id="search-ubicacion" class="search-div" >
            <legend>Por Ubicación</legend>
            <?php echo $form->input('jur_dep_loc', array('label'=>'Departamento/Localidad', 'style'=>'width:92%;','title'=>'Ingrese al menos 3 letras para que comience la busqueda de Departamentos y Localidades.')); ?>
        </fieldset>
        <?php

        echo $form->button('Limpiar búsqueda', array(
                'class' => 'boton-buscar',
                'style' => 'clear:both; float:left; width:130px;',
                'onclick' => 'location.href="'.$html->url("search").'/limpiar:1"',
         ));

        echo $form->input('bysession', array('type'=>'hidden', 'value'=>$bySession));
        echo $form->input('busquedanueva', array('type'=>'hidden', 'value'=>'1'));

        echo $form->end();
?>

<!-- Aca se muestran los resultados de la busqueda-->
<div id='consoleResultWrapper'  style="clear:both; margin-top: 20px;">
    <div id='consoleResult' style="min-height: 200px; margin-bottom: 20px;">

    </div>
</div>

</div>

<script type="text/javascript">
jQuery(document).ready(function() {
    <?php
    if ($bySession) {
    ?>
        jQuery("#TituloSearchForm").submit();
    <?php
    }
    ?>
});
</script>