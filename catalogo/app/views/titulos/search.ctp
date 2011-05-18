<?php echo $this->element('jqueryui'); ?>

<script type="text/javascript">
    init('<?echo $html->url(array('controller'=>'localidades','action'=>'ajax_search_localidades'));?>');
</script>
<div class="titulos search">
    <h1><?php __('Búsqueda de Títulos de Referencia');?></h1>
    <?php
    echo $javascript->link(array(
    'jquery.autocomplete',
    'jquery.loadmask.min',
    ));
    echo $html->css(array('jquery.loadmask', 'jquery.autocomplete', 'catalogo.titulos'));
    ?>
    <?php
    echo $form->create('Titulo', array(
    'action' => 'ajax_search_results',
    'name'=>'TituloSearchForm',
    'id' =>'TituloSearchForm',
    )
    );
    ?>
    <div class="grid_3">
        <?php

        echo $form->input(
        'oferta_id',
        array(
        'div' => false,
        'class' => 'autosubmit ui-widget ui-state-default ui-corner-all',
        'label'=> 'Oferta<br />',
        'id' => 'ofertaId',
        'empty' => 'Todas',
        ));

        $meter = '<span class="ajax_update" id="ajax_indicator" style="display:none;">'.$html->image('ajax-loader.gif').'</span>';
        ?>
    </div>
    <div class="grid_4">
        <?php
        echo $form->input('sector_id', array(
        'div' => false,
        'class' => 'autosubmit ui-widget ui-state-default ui-corner-all',
        'type'=>'select','empty'=>'Seleccione','options'=>$sectores,'label'=>'Sector<br />','id'=>'sectorId','after'=>$meter)
        );
        ?>
    </div>
    <div class="grid_5">
        <?php
        echo $form->input('subsector_id', array(
        'div' => false,
        'class' => 'autosubmit ui-widget ui-state-default ui-corner-all',
        'empty' => 'Seleccione','type'=>'select', 'style'=>'width:350px;' ,'label'=>'Subsector<br />', 'id'=>'subsectorId','after'=> $meter)
        );

        echo $ajax->observeField('sectorId',
        array(
        'url' => '/subsectores/ajax_select_subsector_form_por_sector',
        'update'=>'subsectorId',
        'loading'=>'jQuery("#ajax_indicator").show();jQuery("#subsectorId").attr("disabled","disabled")',
        'complete'=>'jQuery("#ajax_indicator").hide();jQuery("#subsectorId").removeAttr("disabled")',
        'onChange'=>true
        ));
        ?>
    </div>
    <div class="clear"></div>
    <div class="grid_3">
        <?php
        echo $form->input(
        'tituloName',
        array(
        'label'=> 'Nombre del Título de Referencia',
        'div' => false,
        'class' => 'ui-widget ui-state-default ui-corner-all',
        'id' => 'TituloName',
        ));
        ?>
    </div>
    <div class="grid_4">
        <?php

        echo $form->input('Instit.jurisdiccion_id', array(
        'label'=>'Jurisdicción',
        'div' => false,
        'style'=> 'display: block; clear: both;',
        'class' => 'autosubmit ui-widget ui-state-default ui-corner-all',
        'empty' => array('0'=>'Todas'),
        'id'=>'jurisdiccion_id'));
        echo '<span class="ajax_update" id="ajax_indicator" style="display:none; margin-top: -32px; float: right; clear: none">'.$html->image('ajax-loader.gif').'</span>';

        ?>
    </div>
    <div id="search-ubicacion" class="grid_5" >
        <?php echo $form->input('jur_dep_loc', array(
        'label'=>'Departamento/Localidad<br />',
        'div'=>false,
        'style' => 'width: 350px;',
        'class' => 'ui-widget ui-state-default ui-corner-all',
        'after'=>'<i>Ingrese al menos 3 letras para que comience la búsqueda</i>')); ?>
    </div>
    <div class="clear" style="height:15px;"></div>
    <div class="grid_2 prefix_10" >
        <?php
        echo $form->button('Limpiar búsqueda', array(
        'class' => 'boton-buscar ui-state-default ui-corner-all',
        'style' => 'cursor: pointer;',
        'div' => false,
        'onclick' => 'location.href="'.$html->url("search").'/limpiar:1"',
        ));
        ?>
    </div>
    <?php
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