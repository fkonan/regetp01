<?php
    echo $javascript->link(array(
    'jquery.autocomplete',
    'jquery.loadmask.min',
    ));
    echo $html->css(array('jquery.loadmask', 'jquery.autocomplete', 'catalogo.advanced_search', 'catalogo.titulos'));
?>
<script type="text/javascript">
    init('<?echo $html->url(array('controller'=>'localidades','action'=>'ajax_search_localidades'));?>');
</script>
<div class="grid_12 titulos search">
    
    <h1><?php __('Búsqueda de Títulos');?></h1>

    <div class="grid_12 boxblanca boxform">
        <?php
        echo $form->create('Titulo', array(
        'action' => 'ajax_search_results2',
        'name'=>'TituloSearchForm',
        'id' =>'TituloSearchForm',
        )
        );
        ?>
        <div style="margin-right: 0px; padding-left: 20px; float: left; width: 200px;">
            <?php

            echo $form->input(
            'oferta_id',
            array(
            'div' => false,
            'class' => 'autosubmit ',
            'label'=> 'Oferta',
            'id' => 'ofertaId',
            'empty' => 'Todas',
            ));

            $meter = '<span class="ajax_update" id="ajax_indicator" style="display:none;">'.$html->image('ajax-loader.gif').'</span>';
            ?>
        </div>
        <div style="float: left; padding-left: 7px; width: 251px;">
            <?php
            echo $form->input('sector_id', array(
            'div' => false,
            'class' => 'autosubmit ',
            'type'=>'select','empty'=>'Seleccione','options'=>$sectores,'label'=>'Sector','id'=>'sectorId','after'=>$meter)
            );
            ?>
        </div>
        <div style="float: left; padding-left: 35px; width: 400px;">
            <?php
            echo $form->input('subsector_id', array(
            'div' => false,
            'class' => 'autosubmit ',
            'empty' => 'Seleccione','type'=>'select', 'style'=>'width:400px;' ,'label'=>'Subsector', 'id'=>'subsectorId','after'=> $meter)
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

        <div class="clear" style="height: 8px;"></div>

        <div style="margin-right: 0px; padding-left: 20px; float: left; width: 200px;">
            <?php
            echo $form->input(
            'tituloName',
            array(
            'label'=> 'Nombre del Título',
            'div' => false,
            'class' => '',
            'id' => 'TituloName',
            ));
            ?>
        </div>
        <div style="float: left; padding-left: 7px; width: 251px;">
            <?php

            echo $form->input('Instit.jurisdiccion_id', array(
            'label'=>'Jurisdicción',
            'div' => false,
            'style'=> 'display: block; clear: both;',
            'class' => 'autosubmit ',
            'empty' => array('0'=>'Todas'),
            'id'=>'jurisdiccion_id'));
            echo '<span class="ajax_update" id="ajax_indicator" style="display:none; margin-top: -32px; float: right; clear: none">'.$html->image('ajax-loader.gif').'</span>';

            ?>
        </div>
        <div id="search-ubicacion" style="float: left; padding-left: 35px; width: 400px;">
            <?php echo $form->input('jur_dep_loc', array(
            'label'=>'Departamento/Localidad',
            'div'=>false,
            'style' => 'width: 395px;',
            'class' => '',
            'after'=>'<br /><i>Ingrese al menos 3 letras para que comience la búsqueda</i>')); ?>
            <?php
            $name = $val = '';
            if (!empty($this->data['Instit']['localidad_id'])) {
                $name = "data[Instit][localidad_id]";
                $val = $this->data['Instit']['localidad_id'];
            }
            elseif (!empty($this->data['Instit']['departamento_id'])) {
                $name = "data[Instit][departamento_id]";
                $val = $this->data['Instit']['departamento_id'];
            } ?>
            <input id="hiddenLocDepId" name="<?php echo $name?>" type="hidden" value="<?php echo $val?>" />
        </div>

        <div class="clear" style="height:15px;"></div>
        
        <div class="grid_2 prefix_10" >
            <?php
            /*echo $form->button('Limpiar búsqueda', array(
            'class' => 'boton-buscar',
            'style' => 'cursor: pointer;',
            'div' => false,
            'onclick' => 'location.href="'.$html->url("search").'/limpiar:1"',
            ));**/
            echo $form->submit('Buscar', array(
            'class' => 'boton-buscar',
            'style' => 'cursor: pointer;',
            'div' => false
            ));
            ?>
        </div>
        <?php
        echo $form->input('bysession', array('type'=>'hidden', 'value'=>$bySession));
        echo $form->input('busquedanueva', array('type'=>'hidden', 'value'=>'1'));

        echo $form->end();
        ?>
    </div>
    
    <!-- Aca se muestran los resultados de la busqueda-->
    <div id="consoleResult" style="min-height:200px; margin-top:30px; padding-bottom:20px;"></div>

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