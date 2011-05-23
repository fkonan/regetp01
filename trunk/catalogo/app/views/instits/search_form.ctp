<?
echo $javascript->link(array(
    'jquery.loadmask.min',
    'views/instits/search_form',
        ), false);

echo $html->css(array('jquery.loadmask', 'smoothness/jquery-ui-1.8.6.custom'));
?>
<div class="grid_12 instits search_form">

    <h1><? __('Búsqueda de Instituciones')?></h1>

    <div class="grid_12 boxblanca boxform">
        <?php
        echo $form->create('Instit', array(
            'action' => 'search',
            'name'=>'InstitSearchForm',
            'id' =>'InstitSearchForm',
            )
        );

        echo $form->hidden('form_name',array('value'=>'buscador rapido'));
        ?>
        <div style="margin-right: 0px; margin-left: 20px;">
            <?php
            echo $form->input('jurisdiccion_id',array(
                    'label'=> 'Jurisdicción<br />',
                    'empty'=> 'Todas',
                    'div' => false,
                    'div'  => array('style' => 'float:left; clear: none;'),
                    'after' => '<cite>(Opcional. Si no selecciona una Jurisdicción se realizará una búsqueda en todo el Registro)</cite>'
                    ));
            ?>
        </div>
        <div class="clear" style="height: 8px;"></div>
        <div class="grid_6 alpha">
            <div style="margin-left: 20px;">
            <?php
            echo $form->input('busqueda_libre', array(
                    'id' => 'InstitCue',
                    'label' => 'Criterios de Búsqueda<br />',
                    'style' => 'width: 400px;',
                    'div' => false
                    ));
            ?>
            </div>
        </div>
        <div class="grid_3 suffix_3 omega" >
        <?php
            echo $form->button('Buscar', array(
                'class' => 'boton-buscar',
                'div' => false,
                'onclick' => 'autoSubmit(true)',
                 ));
            ?>
            <a href="javascript: abrirVentanaAyuda()" style="margin: 22px;" title="Ayuda sobre el buscador">
            <?php
            echo $html->image('help.png', array(
                'alt' => 'Ayuda: ¿Cómo utilizar el buscador?',
                'id' => 'littleHelpers',
                'style' => 'border:0;',
                ));
            ?>
                <span style="margin-left: 0px;">Ayuda</span>
            </a>
        </div>
        <div class="clear" style="height: 8px;"></div>
        <div class="grid_2" style="margin-left: 20px;" >
            <a class="mas_info_gris_small"></a> 
            <?php
            echo $html->link('Búsqueda avanzada','advanced_search_form',array(
                'class'=>'link_right small',
            ));
            ?>
        </div>
        <?php
        echo $form->end();
        ?>
    </div>

    <div class="clear" style="height: 30px;"></div>

    <?php echo $this->element('boxBuscadorAyuda'); ?>
    
    <!-- Aca se muestran los resultados de la busqueda-->
    <div id='consoleResultWrapper'>
        <div id='consoleResult' style="min-height: 200px; margin-bottom: 20px;"></div>
    </div>
    
</div>
