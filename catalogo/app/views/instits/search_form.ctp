<?
echo $javascript->link(array(
    'jquery.loadmask.min',
        ), false);

echo $html->css(array(  'jquery.loadmask',
                        'smoothness/jquery-ui-1.8.6.custom',
                        'catalogo.advanced_search',
                        'catalogo.instits'), $inline=false);
?>
<div class="grid_12 instits search_form">

    <h1><? __('Búsqueda de Instituciones')?></h1>
    <p>
        Desde aquí obtendrás un listado de instituciones del Registro Nacional Educación Técnico Profesional según los criterios de búsqueda ingresados. 
        Para obtener ayuda sobre el uso del buscador, haga click aqui
        <a href="#boxAyuda" title="Ayuda sobre el buscador">
        Ayuda
        </a>
        <?php
        echo $html->image('help.png', array(
            'alt' => 'Ayuda: ¿Cómo utilizar el buscador?',
            'id' => 'littleHelpers',
            'style' => 'border:0; margin-left:0;',
            ));
        ?>
    </p>
    <div class="boxblanca boxform">
        <?php
        echo $form->create('Instit', array(
            'action' => 'search',
            'name'=>'InstitSearchForm',
            'id' =>'InstitSearchForm',
            )
        );
        echo $form->hidden('form_name',array('value'=>'buscador rapido'));
        ?>
        <div class="grid_12 alpha omega">
            <div style="margin-left: 20px;">
                <?php
                echo $form->input('jurisdiccion_id',array(
                        'label'=> 'Jurisdicción',
                        'empty'=> 'Todas',
                        'div'=>array('class'=>'grid_4 alpha'),
                        'style' =>'width:100%'
                        ));
                echo $form->input('busqueda_libre', array(
                        'id' => 'InstitCue',
                        'label' => 'CUE o Nombre de la Institución',
                        'div'=>array('class'=>'grid_6 alpha'),
                        'style' =>'width:100%'
                        ));

                echo $form->button('Buscar', array(
                    'type' => 'submit',
                    'class' => 'boton-buscar',
                    'div'=>false,
                    'style'=> 'width:80px; float: right;margin-top:23px;margin-right:20px',
                     ));
                ?>
            </div>
        </div>
        <div style="float:right; margin-right: 8px; margin-top: 5px">
            <?php
                echo $html->link('Búsqueda avanzada','advanced_search_form',array(
                    'class'=>'link_right small',
                ));
            ?>
        </div>
        <?php
        echo $form->end();
        ?>
        <div class="clear"></div>
    </div>

    <?php echo $this->element('boxBuscadorAyuda'); ?>
    
    <!-- Aca se muestran los resultados de la busqueda-->
    <div id='consoleResult' style="min-height: 200px; margin-bottom: 20px;margin-top: 20px;">
    </div>
    
</div>
